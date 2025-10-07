@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">➕ Tambah Catatan</h2>

    <form action="{{ route('notes.store') }}" method="POST" class="space-y-4 bg-white shadow rounded-lg p-6">
        @csrf

        <!-- Judul -->
        <div>
            <label class="block font-medium mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200"
                    required>
        </div>

        <!-- Kategori -->
        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block font-medium mb-1">Tanggal</label>
            <input type="date" name="created_date" value="{{ old('created_date') }}"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200"
                    required>
        </div>

        <!-- Konten -->
        <div>
            <label class="block font-medium mb-1">Konten</label>
            <textarea name="content" rows="4"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200"
                        required>{{ old('content') }}</textarea>
        </div>

        <!-- Pinned -->
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_pinned" value="1" {{ old('is_pinned') ? 'checked' : '' }}
                    class="rounded border-gray-300">
            <label class="font-medium">Pinned</label>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-3 mt-4">
            <a href="{{ route('notes.index') }}" 
                class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">Batal</a>
            <button type="submit" 
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
