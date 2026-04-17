<x-layout title="Create Book">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <a href="/books" class="text-sky-600 hover:text-sky-800 text-sm font-semibold">&larr; Back to Book List</a>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <h1 class="text-3xl font-bold text-slate-900">Add a New Book</h1>
            <p class="mt-2 text-sm text-slate-500">Fill in the book details below, including availability and cover image path.</p>

            <form method="POST" action="/books" enctype="multipart/form-data" class="mt-8 grid gap-6 sm:grid-cols-2">
                @csrf

                <div class="space-y-2">
                    <label for="title" class="block text-sm font-semibold text-slate-700">Title</label>
                    <input id="title" name="title" type="text" value="{{ old('title') }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="author" class="block text-sm font-semibold text-slate-700">Author</label>
                    <input id="author" name="author" type="text" value="{{ old('author') }}" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="sm:col-span-2 space-y-2">
                    <label for="description" class="block text-sm font-semibold text-slate-700">Description</label>
                    <textarea id="description" name="description" required rows="4" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900">{{ old('description') }}</textarea>
                </div>

                <div class="space-y-2">
                    <label for="genre" class="block text-sm font-semibold text-slate-700">Genre</label>
                    <select id="genre" name="genre" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900 bg-white">
                        <option value="">Select a genre</option>
                        <option value="Fiction" {{ old('genre') === 'Fiction' ? 'selected' : '' }}>Fiction</option>
                        <option value="Sci-Fi" {{ old('genre') === 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                        <option value="Fantasy" {{ old('genre') === 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                        <option value="Biography" {{ old('genre') === 'Biography' ? 'selected' : '' }}>Biography</option>
                        <option value="History" {{ old('genre') === 'History' ? 'selected' : '' }}>History</option>
                        <option value="Mystery" {{ old('genre') === 'Mystery' ? 'selected' : '' }}>Mystery</option>
                        <option value="Non-Fiction" {{ old('genre') === 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="published_year" class="block text-sm font-semibold text-slate-700">Published Year</label>
                    <input id="published_year" name="published_year" type="number" required min="0" max="{{ date('Y') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="isbn" class="block text-sm font-semibold text-slate-700">ISBN</label>
                    <input id="isbn" name="isbn" type="text" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="pages" class="block text-sm font-semibold text-slate-700">Pages</label>
                    <input id="pages" name="pages" type="number" required min="1" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="language" class="block text-sm font-semibold text-slate-700">Language</label>
                    <input id="language" name="language" type="text" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="publisher" class="block text-sm font-semibold text-slate-700">Publisher</label>
                    <input id="publisher" name="publisher" type="text" required class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="space-y-2">
                    <label for="price" class="block text-sm font-semibold text-slate-700">Price</label>
                    <input id="price" name="price" type="number" required step="0.01" min="0" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="sm:col-span-2 space-y-2">
                    <label for="cover_image" class="block text-sm font-semibold text-slate-700">Cover Image</label>
                    <input id="cover_image" name="cover_image" type="file" accept="image/*" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-slate-900" />
                </div>

                <div class="sm:col-span-2 flex items-center gap-3 mt-2">
                    <input id="is_available" name="is_available" type="checkbox" class="h-4 w-4 text-sky-600 border-slate-300 rounded" checked />
                    <label for="is_available" class="text-sm font-semibold text-slate-700">Available now</label>
                </div>

                <div class="sm:col-span-2 mt-6 flex justify-end gap-3">
                    <a href="/books" class="inline-flex items-center rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-500">Save Book</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
