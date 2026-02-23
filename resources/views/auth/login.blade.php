<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Suffa Islamic Center</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        .login-bg {
            background-color: #084D3C;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="login-bg p-6 text-center">
            <h2 class="text-2xl font-bold text-white">Suffa Islamic Center</h2>
            <p class="text-green-100 mt-2">Admin Login</p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#084D3C] @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#084D3C]">
                </div>

                <button type="submit"
                    class="w-full bg-[#084D3C] text-white py-2 px-4 rounded-lg hover:bg-[#063328] transition duration-200 font-medium">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>

</html>