<x-layout title="Books Library">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col gap-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white">Library Books</h1>
                    <p class="mt-2 text-sm text-slate-200">Manage book records for your library catalog.</p>
                </div>
                <a href="/books/create" class="inline-flex items-center rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-emerald-500 transition">
                    Add New Book
                </a>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
                <form id="books-filter-form" method="GET" action="/books" class="border-b border-slate-200 p-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="grid w-full gap-4 sm:grid-cols-[minmax(0,1fr)_240px]">
                        <div class="relative">
                            <label for="search" class="sr-only">Search books</label>
                            <input
                                id="search"
                                name="search"
                                type="search"
                                value="{{ $search }}"
                                placeholder="Search by title or author"
                                autocomplete="off"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                            />
                            <div id="search-suggestions" class="absolute z-20 mt-2 hidden w-full rounded-2xl border border-slate-200 bg-white shadow-lg">
                                <ul id="search-suggestions-list" class="max-h-64 overflow-auto py-2"></ul>
                            </div>
                        </div>
                        <div class="relative">
                            <label for="genre" class="sr-only">Filter by genre</label>
                            <select
                                id="genre"
                                name="genre"
                                onchange="this.form.submit()"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200"
                            >
                                <option value="">All genres</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre }}" {{ $selectedGenre === $genre ? 'selected' : '' }}>{{ $genre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="inline-flex items-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-500">Search</button>
                        <a href="/books" class="inline-flex items-center rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Clear</a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-fixed divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="w-1/4 px-6 py-3 text-left font-semibold text-slate-700">Title</th>
                                <th class="w-1/4 px-6 py-3 text-left font-semibold text-slate-700">Author</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-700">Genre</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-700">Price</th>
                                <th class="w-40 px-4 py-3 text-left font-semibold text-slate-700">Availability</th>
                                <th class="w-40 px-4 py-3 text-left font-semibold text-slate-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($books as $book)
                                <tr>
                                    <td class="w-1/4 px-6 py-3 text-slate-900">{{ $book->title }}</td>
                                    <td class="w-1/4 px-6 py-3 text-slate-700">{{ $book->author }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $book->genre }}</td>
                                    <td class="px-4 py-3 text-slate-700">₱{{ number_format($book->price, 2) }}</td>
                                    <td class="w-40 px-4 py-3 text-slate-700">{{ $book->is_available ? 'Yes' : 'No' }}</td>
                                    <td class="w-40 px-4 py-3 text-left space-x-2 whitespace-nowrap">
                                        <a href="/books/{{ $book->id }}" class="text-sky-600 hover:text-sky-800">View</a>
                                        <a href="/books/{{ $book->id }}/edit" class="text-amber-600 hover:text-amber-800">Edit</a>
                                        <form method="POST" action="/books/{{ $book->id }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-10 text-center text-slate-500">
                                        No books match your search.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script>
    (() => {
        const form = document.getElementById('books-filter-form');
        const searchInput = document.getElementById('search');
        const suggestionsContainer = document.getElementById('search-suggestions');
        const suggestionsList = document.getElementById('search-suggestions-list');
        const suggestions = @json($searchSuggestions);

        if (!form || !searchInput || !suggestionsContainer || !suggestionsList) {
            return;
        }

        let debounceTimer;
        let lastSubmittedValue = searchInput.value.trim();

        const hideSuggestions = () => {
            suggestionsContainer.classList.add('hidden');
            suggestionsList.innerHTML = '';
        };

        const showSuggestions = (currentValue) => {
            if (!currentValue || currentValue.length < 2) {
                hideSuggestions();
                return;
            }

            const normalizedValue = currentValue.toLowerCase();
            const matches = suggestions
                .filter((item) => item && item.toLowerCase().includes(normalizedValue))
                .slice(0, 6);

            if (!matches.length) {
                hideSuggestions();
                return;
            }

            suggestionsList.innerHTML = matches.map((match) => `
                <li>
                    <button
                        type="button"
                        class="w-full px-4 py-2 text-left text-sm text-slate-700 hover:bg-sky-50"
                        data-suggestion="${match.replace(/"/g, '&quot;')}"
                    >
                        ${match}
                    </button>
                </li>
            `).join('');

            suggestionsContainer.classList.remove('hidden');
        };

        searchInput.addEventListener('input', (event) => {
            clearTimeout(debounceTimer);

            const currentValue = event.target.value.trim();
            showSuggestions(currentValue);

            // Avoid interrupting typing for very short, in-progress terms.
            if (currentValue.length > 0 && currentValue.length < 3) {
                return;
            }

            debounceTimer = setTimeout(() => {
                if (currentValue === lastSubmittedValue) {
                    return;
                }

                lastSubmittedValue = currentValue;
                hideSuggestions();
                form.submit();
            }, 900);
        });

        suggestionsList.addEventListener('click', (event) => {
            const target = event.target.closest('[data-suggestion]');

            if (!target) {
                return;
            }

            searchInput.value = target.dataset.suggestion ?? '';
            lastSubmittedValue = searchInput.value.trim();
            hideSuggestions();
            form.submit();
        });

        searchInput.addEventListener('blur', () => {
            setTimeout(hideSuggestions, 150);
        });

        searchInput.addEventListener('focus', () => {
            showSuggestions(searchInput.value.trim());
        });
    })();
</script>
