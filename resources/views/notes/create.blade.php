@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Catatan Baru</h1>

    <form action="{{ route('notes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Isi Catatan</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="created_date">Tanggal</label>
            <input type="date" name="created_date" id="created_date" class="form-control" required>
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_pinned" id="is_pinned" class="form-check-input">
            <label for="is_pinned" class="form-check-label">Pin Catatan</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
