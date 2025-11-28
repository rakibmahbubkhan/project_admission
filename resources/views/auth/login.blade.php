<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Login</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen flex items-center justify-center p-6">

    <div class="py-6 px-4 w-full">
        <div class="grid lg:grid-cols-2 items-center gap-6 max-w-6xl w-full mx-auto">

            <!-- LEFT CARD -->
            <div class="border border-slate-300 rounded-lg p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] bg-white max-lg:mx-auto">

                <!-- Login Title -->
                <div class="mb-8 text-center">
                    <img src="{{ asset('assets/img/logo.png') }}" width="200" style="justify-self: anchor-center;" alt="">
                    <h1 class="text-3xl font-bold text-slate-900">Agent Login</h1>
                    <p class="text-slate-600 text-sm mt-2">
                        Welcome back! Login to continue.
                    </p>
                </div>

                <!-- Laravel Success Message -->
                @if (session('status'))
                    <div class="mb-4 text-center text-green-600 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Laravel Errors -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded-lg text-sm">
                        <ul class="list-disc ml-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="text-slate-900 text-sm font-medium mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input name="email" type="email"
                                value="{{ old('email') }}" required
                                class="w-full text-sm text-slate-900 border border-slate-300 pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                placeholder="Enter email" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input name="password" type="password" required
                                class="w-full text-sm text-slate-900 border border-slate-300 pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                placeholder="Enter password" />
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox"
                                class="h-4 w-4 shrink-0 text-blue-600 border-slate-300 rounded" />
                            <label for="remember-me" class="ml-3 block text-sm text-slate-900">
                                Remember me
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}"
                                    class="text-blue-600 hover:underline font-medium">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Submit -->
                    <div class="!mt-8">
                        <button type="submit"
                            class="w-full shadow-xl py-2.5 px-4 text-[15px] font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700">
                            Log In
                        </button>

                        <p class="text-sm !mt-6 text-center text-slate-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline ml-1">
                                Register here
                            </a>
                        </p>
                    </div>

                </form>
            </div>

            <!-- RIGHT IMAGE -->
            <div class="max-lg:mt-8">
                <img src="https://readymadeui.com/login-image.webp"
                    class="w-full aspect-[71/50] max-lg:w-4/5 mx-auto block object-cover rounded-lg shadow-lg"
                    alt="login img" />
            </div>

        </div>
    </div>

</body>
</html>
