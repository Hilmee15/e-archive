<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:51200',
            'folder_id' => 'nullable|exists:folders,id'
        ]);

        $uploadedFile = $request->file('file'); 
        
        $path = $uploadedFile->store('user_files', 'public');

        File::create([
            'name' => $uploadedFile->getClientOriginalName(),
            'file_path' => $path,
            'folder_id' => $request->folder_id,
            'user_id' => Auth::id(),
            'file_size' => $uploadedFile->getSize(), 
        ]);

        return back()->with('success', 'File berhasil diunggah!');
    }

    public function download(File $file)
    {
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $absolutePath = storage_path('app/' . $file->file_path);

        if (!file_exists($absolutePath)) {
            abort(404, 'File not found on server.');
        }

        return response()->download($absolutePath, $file->name);
    }
    
    public function destroy(File $file)
    {
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        Storage::disk('public')->delete($file->file_path);
        
        $file->delete();

        return back()->with('success', 'File deleted.');
    }
}