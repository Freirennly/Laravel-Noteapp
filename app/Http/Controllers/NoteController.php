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
        $notes = Note::with('category') // eager loading
                    ->when($request->filled('search'), fn($q) => 
                        $q->where(fn($query) => 
                            $query->where('title', 'like', "%{$request->search}%")
                                ->orWhere('content', 'like', "%{$request->search}%")
                        )
                    )
                    ->when($request->filled('category_id'), fn($q) => 
                        $q->where('category_id', $request->category_id)
                    )
                    ->when($request->filled('date'), fn($q) => 
                        $q->whereDate('created_date', $request->date)
                    )
                    ->orderByDesc('is_pinned')
                    ->orderByDesc('created_date')
                    ->paginate(10)
                     ->withQueryString(); // mempertahankan filter saat pagination

        $categories = Category::all();

        return view('notes.index', compact('notes', 'categories'));
    }

    public function create()
    {
        $categories = Category::all(); // untuk select box lebih ringkas
        return view('notes.create', compact('categories'));
    }

    public function store(NoteStoreRequest $request)
    {
        Note::create($request->validated());
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dibuat');
    }

    public function edit(Note $note)
    {
        $categories = Category::pluck('name', 'id');
        return view('notes.edit', compact('note', 'categories'));
    }

    public function update(NoteUpdateRequest $request, Note $note)
    {
        $note->update($request->validated());
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diupdate');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus');
    }
}
