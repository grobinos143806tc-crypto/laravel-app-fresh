<x-layout title="Book Details">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="/books" class="text-sky-600 hover:text-sky-800 text-sm font-semibold">&larr; Back to Book List</a>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <h1 class="text-3xl font-bold text-slate-900">{{ $book->title }}</h1>
            <p class="mt-2 text-sm text-slate-500">by {{ $book->author }}</p>

            <div class="mt-8 grid gap-6 sm:grid-cols-2">
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Genre</h2>
                    <p class="mt-2 text-slate-900">{{ $book->genre }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Published</h2>
                    <p class="mt-2 text-slate-900">{{ $book->published_year }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">ISBN</h2>
                    <p class="mt-2 text-slate-900">{{ $book->isbn }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Pages</h2>
                    <p class="mt-2 text-slate-900">{{ $book->pages }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Language</h2>
                    <p class="mt-2 text-slate-900">{{ $book->language }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Publisher</h2>
                    <p class="mt-2 text-slate-900">{{ $book->publisher }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Description</h2>
                <p class="mt-2 text-slate-900 leading-7">{{ $book->description }}</p>
            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-3">
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Price</h2>
                    <p class="mt-2 text-slate-900">₱{{ number_format($book->price, 2) }}</p>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Cover Image</h2>
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }} cover" class="mt-2 h-40 w-full object-cover rounded-2xl border border-slate-200" />
                    @else
                        <p class="mt-2 text-slate-900">No cover uploaded.</p>
                    @endif
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Available</h2>
                    <p class="mt-2 text-slate-900">{{ $book->is_available ? 'Yes' : 'No' }}</p>
                </div>
            </div>

            <div class="mt-10 flex flex-wrap gap-3">
                <a href="/books/{{ $book->id }}/edit" class="inline-flex items-center rounded-full bg-amber-500 px-5 py-3 text-sm font-semibold text-white hover:bg-amber-400">Edit Book</a>
                <a href="/books" class="inline-flex items-center rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Back to list</a>
            </div>
        </div>
    </div>
</x-layout>
