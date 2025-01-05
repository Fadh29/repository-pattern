<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tambahkan CSS atau JS di sini -->
</head>
<body>
    <header>
        <!-- Header bagian atas di sini -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer bagian bawah di sini -->
    </footer>

    <!-- Tambahkan JS di sini -->
</body>
</html>
