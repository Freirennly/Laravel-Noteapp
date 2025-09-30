<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_date', $request->date);
        }

        $notes = $query->orderByDesc('is_pinned')
                        ->orderBy('created_date', 'desc')
                        ->paginate(10);

        $categories = Category::all();

        return view('notes.index', compact('notes', 'categories'));
    }

    // Form tambah catatan
    public function create()
    {
        $categories = Category::all();
        return view('notes.create', compact('categories'));
    }

    // Simpan catatan baru
    public function store(NoteStoreRequest $request)
    {
        $data = $request->validated();

        Note::create($data);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dibuat');
    }

    // Form edit catatan
    public function edit(Note $note)
    {
        $categories = Category::all();
        return view('notes.edit', compact('note', 'categories'));
    }

    // Update catatan
    public function update(NoteUpdateRequest $request)
    {
        $data = $request->validated();

        Note::update($data);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diupdate');
    }

    // Hapus catatan
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus');
    }
}
