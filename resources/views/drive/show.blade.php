<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <!-- Dynamic Back Button -->
            <a href="{{ $folder->parent_id ? route('folders.show', $folder->parent_id) : route('drive.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-800 transition font-semibold bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back
            </a>
            <span class="text-gray-300">|</span>
            <span class="font-bold text-gray-800 tracking-wide">{{ $folder->name }}</span>
        </div>
    </x-slot>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded shadow-sm flex items-center">
            <span class="mr-2">✅</span> {{ session('success') }}
        </div>
    @endif

    <!-- Floating Action Bar -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">
        
        <form action="{{ route('folders.store') }}" method="POST" class="flex w-full md:w-auto gap-2">
            @csrf
            <!-- Hidden input for nested folder -->
            <input type="hidden" name="parent_id" value="{{ $folder->id }}">
            <input type="text" name="name" placeholder="New Folder Name" required class="flex-1 border-gray-200 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-5 rounded-lg transition shadow-md hover:shadow-lg">
                + Folder
            </button>
        </form>

        <div class="hidden md:block w-px h-8 bg-gray-200"></div> <!-- Divider -->

        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="flex w-full md:w-auto gap-2">
            @csrf
            <!-- Hidden input for file upload -->
            <input type="hidden" name="folder_id" value="{{ $folder->id }}">
            <input type="file" name="upload" required class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer">
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2 px-5 rounded-lg transition shadow-md hover:shadow-lg">
                Upload File
            </button>
        </form>
    </div>

    <!-- Folders Grid -->
    @if($folders->count() > 0)
        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Folders</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
            @foreach($folders as $f)
                <a href="{{ route('folders.show', $f->id) }}" class="group bg-gradient-to-br from-indigo-500 to-purple-600 p-5 rounded-2xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition duration-200 flex items-center space-x-4">
                    <div class="bg-white/20 p-3 rounded-xl text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    </div>
                    <span class="font-semibold text-white truncate text-lg group-hover:text-indigo-50 transition">{{ $f->name }}</span>
                </a>
            @endforeach
        </div>
    @endif

    <!-- Files Grid -->
    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Files</h3>
    @if($files->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($files as $file)
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:border-indigo-300 hover:shadow-lg transform hover:-translate-y-1 transition duration-200 flex flex-col justify-between h-40">
                    
                    <div class="flex items-start space-x-3 mb-2">
                        <div class="bg-blue-50 text-blue-500 p-2 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="font-medium text-gray-700 leading-tight line-clamp-2 mt-1" title="{{ $file->name }}">{{ $file->name }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-50">
                        <span class="text-xs text-gray-400 font-medium">{{ number_format($file->file_size / 1024, 2) }} KB</span>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('files.download', $file->id) }}" class="text-indigo-500 hover:text-indigo-700 transition" title="Download">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                            <form action="{{ route('files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Delete this file?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-12 text-center text-gray-500 font-medium">
            No files found in {{ $folder->name }}.
        </div>
    @endif
</x-app-layout>