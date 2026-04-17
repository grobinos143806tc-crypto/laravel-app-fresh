@props([
    'title' => 'My Laravel App',
])
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <nav class="app-nav flex items-center justify-center gap-2 shadow-md">
        <a href="/" class="px-3 py-2 hover:bg-gray-200 transition-colors duration-200">Home</a>
        <a href="/about" class="px-3 py-2 hover:bg-gray-200 transition-colors duration-200">About</a>
        <a href="/contact" class="px-3 py-2 hover:bg-gray-200 transition-colors duration-200">Contact</a>
        <a href="/posts" class="px-3 py-2 hover:bg-gray-200 transition-colors duration-200">Posts</a>
        <a href="/books" class="px-3 py-2 hover:bg-gray-200 transition-colors duration-200">Books</a>
        <a href="/register" class="px-3 py-2 hover:bg-gray-200 transition-colors duration-200">User Registration</a>
    </nav>
    <main class="min-h-[calc(100vh-60px)]">
        {{ $slot }}
    </main>
</body>
</html>
