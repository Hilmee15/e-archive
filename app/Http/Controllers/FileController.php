<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Handle the file upload
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:51200', // max 50MB (51200 KB)
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

    /**
     * Securely download the file
     */
    public function download(File $file)
    {
        // 1. Security Check: Does this user own this file?
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // 2. Build the exact absolute path to the file
        $absolutePath = storage_path('app/' . $file->file_path);

        // 3. Check if it actually exists on the hard drive
        if (!file_exists($absolutePath)) {
            abort(404, 'File not found on server.');
        }

        // 4. Force the download using the response helper
        return response()->download($absolutePath, $file->name);
    }
    
    /**
     * Delete the file
     */
    public function destroy(File $file)
    {
        // 1. Security Check
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // 2. Delete the physical file from the local disk
        Storage::disk('local')->delete($file->file_path);
        
        // 3. Delete the database record
        $file->delete();

        return back()->with('success', 'File deleted.');
    }
}
