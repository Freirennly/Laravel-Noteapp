@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Catatan</h1>

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notes.update', $note->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $note->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Isi Catatan</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content', $note->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $note->category_id)==$category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="created_date" class="form-label">Tanggal</label>
            <input type="date" name="created_date" class="form-control" value="{{ old('created_date', $note->created_date) }}" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_pinned" class="form-check-input" id="is_pinned" value="1" {{ $note->is_pinned ? 'checked' : '' }}>
            <label for="is_pinned" class="form-check-label">Pin Catatan</label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
