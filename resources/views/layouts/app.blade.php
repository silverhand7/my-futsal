<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="min-w-site text-sm font-medium min-h-full text-gray-500  bg-gray-100 ">
    <header class="bg-white flex items-center h-14 shadow-b">
        <nav class="flex justify-between container m-auto items-center">
            <div class="flex space-x-6">
                <a href="#" class="text-blue-500 hover:text-blue-300">Home</a>
                <a href="#" class="text-blue-500 hover:text-blue-300">Lapangan</a>
            </div>
            <div class="flex space-x-6 items-center">
                <a href="#" class="btn-primary">Login</a>
                <a href="#" class="btn-primary-outline ">Daftar</a>
            </div>
        </nav>
    </header>
    @yield('content')
</body>
</html>