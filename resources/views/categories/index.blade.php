@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Daftar Kategori</h1>
    <a href="{{ route('categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Tambah Kategori</a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-100">
            <th class="text-left px-4 py-2">No</th>
            <th class="text-left px-4 py-2">Nama Kategori</th>
            <th class="text-left px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $category->name }}</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-4 py-2 text-center text-gray-500">Belum ada kategori</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection
