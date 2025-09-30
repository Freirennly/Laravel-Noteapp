@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Catatan</h1>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form pencarian --}}
    <form method="GET" action="{{ route('notes.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari catatan...">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-control">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id')==$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="date" value="{{ request('date') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <a href="{{ route('notes.create') }}" class="btn btn-success mb-3">+ Tambah Catatan</a>

    {{-- Daftar catatan --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Pinned</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($notes as $note)
            <tr>
                <td>{{ $note->title }}</td>
                <td>{{ $note->category->name ?? '-' }}</td>
                <td>{{ $note->created_date }}</td>
                <td>{{ $note->is_pinned ? '📌' : '-' }}</td>
                <td>
                    <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus catatan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada catatan</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $notes->links() }}
</div>
@endsection
