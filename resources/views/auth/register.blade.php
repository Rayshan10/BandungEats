<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/img/logobdg.png" rel="icon">
    <title>BandungEats - Register</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg dark:border w-96 dark:border-gray-700">
            <img class="mx-auto h-10 w-auto" src="{{ asset('assets/img/logobdg.png') }}" alt="Your Company">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Register</h2>
            
            <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Your name</label>
                    <input type="text" name="name"  
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('name') }}" required>
                </div>
                
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Your email</label>
                    <input type="email" name="email" 
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('email') }}" required>
                </div>
                
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Password</label>
                    <input type="password" name="password" 
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                
                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Confirm password</label>
                    <input type="password" name="password_confirmation" 
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                
                <button type="submit" 
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Register
                </button>

                <p class="text-center text-gray-600 text-sm">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600">Login here</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>