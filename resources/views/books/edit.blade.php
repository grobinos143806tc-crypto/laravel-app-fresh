<x-layout title="Edit Book">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <a href="/books" class="text-sky-600 hover:text-sky-800 text-sm font-semibold">&larr; Back to Book List</a>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <h1 class="text-3xl font-bold text-slate-900">Edit Book</h1>
            <p class="mt-2 text-sm text-slate-500">Update the book details below.</p>

            <form method="POST" action="/books/{{ $book->id }}" enctype="multipart/form-data" class="mt-8 grid gap-6 sm:grid-cols-2">
                @csrf
                @method('PATCH')

                <div class="space-y-2">
                    <label for="title" class="block text-sm font-semibold text-slate-700">Title</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="author" class="block text-sm font-semibold text-slate-700">Author</label>
                    <input id="author" name="author" type="text" value="{{ old('author', $book->author) }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="sm:col-span-2 space-y-2">
                    <label for="description" class="block text-sm font-semibold text-slate-700">Description</label>
                    <textarea id="description" name="description" required rows="4" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900">{{ old('description', $book->description) }}</textarea>
                </div>

                <div class="space-y-2">
                    <label for="genre" class="block text-sm font-semibold text-slate-700">Genre</label>
                    <input id="genre" name="genre" type="text" value="{{ old('genre', $book->genre) }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="published_year" class="block text-sm font-semibold text-slate-700">Published Year</label>
                    <input id="published_year" name="published_year" type="number" value="{{ old('published_year', $book->published_year) }}" required min="0" max="{{ date('Y') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="isbn" class="block text-sm font-semibold text-slate-700">ISBN</label>
                    <input id="isbn" name="isbn" type="text" value="{{ old('isbn', $book->isbn) }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="pages" class="block text-sm font-semibold text-slate-700">Pages</label>
                    <input id="pages" name="pages" type="number" value="{{ old('pages', $book->pages) }}" required min="1" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="language" class="block text-sm font-semibold text-slate-700">Language</label>
                    <input id="language" name="language" type="text" value="{{ old('language', $book->language) }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="publisher" class="block text-sm font-semibold text-slate-700">Publisher</label>
                    <input id="publisher" name="publisher" type="text" value="{{ old('publisher', $book->publisher) }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="price" class="block text-sm font-semibold text-slate-700">Price</label>
                    <input id="price" name="price" type="number" value="{{ old('price', $book->price) }}" required step="0.01" min="0" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="sm:col-span-2 space-y-2">
                    <label for="cover_image" class="block text-sm font-semibold text-slate-700">Cover Image</label>
                    <input id="cover_image" name="cover_image" type="file" accept="image/*" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                    @if ($book->cover_image)
                        <p class="text-xs text-slate-500">Current file: {{ $book->cover_image }}</p>
                    @endif
                </div>

                <div class="sm:col-span-2 flex items-center gap-3 mt-2">
                    <input id="is_available" name="is_available" type="checkbox" {{ old('is_available', $book->is_available) ? 'checked' : '' }} class="h-4 w-4 text-sky-600 border-slate-300 rounded" />
                    <label for="is_available" class="text-sm font-semibold text-slate-700">Available now</label>
                </div>

                <div class="sm:col-span-2 mt-6 flex justify-end gap-3">
                    <a href="/books" class="inline-flex items-center rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-500">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
