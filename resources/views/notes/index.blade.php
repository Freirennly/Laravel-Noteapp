@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2">
            📒 Daftar Catatan
        </h2>
        <a href="{{ route('notes.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
            + Tambah Catatan
        </a>
    </div>

    <!-- Filter -->
    <form action="{{ route('notes.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <input type="text" name="search" placeholder="Cari catatan..."
               value="{{ request('search') }}"
               class="border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200">

        <select name="category_id" class="border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}"
               class="border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200">

        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            Filter
        </button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Pinned</th>
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Konten</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notes as $note)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">
                            @if($note->is_pinned)
                                <span class="text-red-500">📌</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 font-medium">{{ $note->title }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded">
                                {{ $note->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $note->created_date }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ Str::limit($note->content, 40) }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('notes.edit', $note) }}" 
                               class="text-indigo-600 hover:underline">Edit</a>
                            <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin hapus catatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Belum ada catatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $notes->links() }}
    </div>
</div>
@endsection
