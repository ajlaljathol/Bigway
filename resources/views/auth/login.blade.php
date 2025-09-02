<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            </div>

            <!-- Buttons Section -->
            <div class="flex flex-col sm:flex-row justify-between gap-3">
                <!-- Login Button -->
                <button type="submit"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    Login
                </button>

                <!-- Redirect to Register -->
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto text-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Don’t have an account? Register
                </a>
            </div>
        </form>
    </div>
</body>

</html>