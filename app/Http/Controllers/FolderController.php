<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
    public function index()
    {
        $folders = Folder::where('user_id', Auth::id())->whereNull('parent_id')->get();
        $files = File::where('user_id', Auth::id())->whereNull('folder_id')->get();

        return view('drive.index', compact('folders', 'files'));
    }

    public function show(Folder $folder)
    {
        if ($folder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $folders = $folder->children;
        $files = $folder->files;

        return view('drive.show', compact('folder', 'folders', 'files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id'
        ]);

        Folder::create([
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Folder created successfully!');
    }

    public function destroy(Folder $folder)
    {
        if ($folder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $files = File::where('folder_id', $folder->id)->get();
        
        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete(); // Hapus data file dari database
        }

        $folder->delete();

        return redirect()->route('drive.index')->with('success', 'Folder deleted successfully!');
    }
}
