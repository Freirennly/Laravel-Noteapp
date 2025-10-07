@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Kategori</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $category->name) }}" required>
        </div>
        <div class="flex justify-between">
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
        </div>
    </form>
</div>
@endsection
