<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UL1M</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="border-b">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="bg-black text-white px-6 py-3 font-bold text-2xl hover:bg-gray-800 transition">
                        UL1M
                    </a>
                    <h1 class="text-2xl font-semibold">Fast Embed Robotics Workshops</h1>
                </div>
                <div class="flex gap-6 text-lg">
                    <a href="{{ route('home') }}" class="hover:text-gray-600">Home</a>
                    <a href="#" class="hover:text-gray-600">About</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-6 py-16">
        <div class="max-w-md mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-center">Login to Admin Panel</h2>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white border-2 border-gray-200 rounded-lg p-8">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-black @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-black @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember"
                                   class="rounded border-gray-300 text-black focus:ring-black">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-black underline"
                               href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <button type="submit"
                                class="bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition font-semibold">
                            Log in
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-black font-semibold hover:underline">Register</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
