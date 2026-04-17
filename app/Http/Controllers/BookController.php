<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::orderBy('created_at', 'desc');
        $searchSuggestions = Book::query()
            ->select(['title', 'author'])
            ->get()
            ->flatMap(function (Book $book) {
                return [$book->title, $book->author];
            })
            ->filter()
            ->unique()
            ->sort()
            ->values();

        if ($search = $request->query('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($genre = $request->query('genre')) {
            $query->where('genre', $genre);
        }

        return view('books.index', [
            'books' => $query->get(),
            'genres' => Book::select('genre')->distinct()->orderBy('genre')->pluck('genre'),
            'searchSuggestions' => $searchSuggestions,
            'search' => $request->query('search', ''),
            'selectedGenre' => $request->query('genre', ''),
        ]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'published_year' => 'required|integer|min:0|max:' . date('Y'),
            'isbn' => 'required|string|max:255|unique:books,isbn',
            'pages' => 'required|integer|min:1',
            'language' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|max:2048',
            'is_available' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $attributes['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $attributes['is_available'] = $request->has('is_available');

        Book::create($attributes);

        return redirect('/books');
    }

    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        $attributes = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'published_year' => 'required|integer|min:0|max:' . date('Y'),
            'isbn' => 'required|string|max:255|unique:books,isbn,' . $book->id,
            'pages' => 'required|integer|min:1',
            'language' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|max:2048',
            'is_available' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $attributes['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $attributes['is_available'] = $request->has('is_available');

        $book->update($attributes);

        return redirect('/books');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }
}
