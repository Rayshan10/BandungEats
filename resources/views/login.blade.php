<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="assets/img/logobdg.png" rel="icon">
        <title>BandungEats - Login</title>
        @vite(['resources/css/app.css'])
    </head>
    <body>
        <div class="flex min-h-full flex-col justify-center px-6 py-10 lg:px-8">
            
    
            <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm bg-white rounded-lg shadow dark:border dark:bg-white dark:border-gray-500 sm:p-10">
                <form class="space-y-8" action="{{ route('login.auth') }}" method="POST">
                    @csrf
                    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                        <img class="mx-auto h-10 w-auto" src="{{ asset('assets/img/logobdg.png') }}" alt="Your Company">
                        <h2 class="text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
                    </div>
                    
                
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
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <div class="mt-1 text-sm">
                                <a href="/forgot" class="font-semibold text-sky-600 hover:text-sky-500">Forgot password?</a>
                            </div>
                        </div>
                        <div>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                    </div>
                
                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">Sign in</button>
                    </div>
                </form>
                
                <p class="mt-10 text-center text-sm/6 text-gray-500">
                    Belum punya akun?
                    <a href="/register" class="font-semibold text-sky-600 hover:text-sky-500">Buat di sini!</a>
                </p>
            </div>
        </div>
    </body>
</html>