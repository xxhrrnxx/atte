<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<header>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <nav class="navbar navbar-expand-sm navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h2 class="navbar-brand">Atte</h2>
        
    </nav>

                </div>
            </header>
<x-guest-layout class="position-relative">
    <x-auth-card>
    <p class="text-center fs-4 fw-bold mb-4">ログイン</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="パスワード" />
            </div>

            <div class="text-center mt-4">
                <x-button class="w-full">
                    {{ __('ログイン') }}
                </x-button>

                @if (Route::has('password.request'))
                    <p class="text-sm text-gray-600">アカウントをお持ちでない方はこちらから</p>
                    <a class="text-primary" href="{{ route('register') }}">
                        {{ __('会員登録') }}
                    </a>
                @endif


            </div>
        </form>
    </x-auth-card>
    <nav class="bg-white position-absolute bottom-0 w-100 text-center py-3 fw-bold">
    <h2 class="">Atte,inc.</h2>
  </nav>
</x-guest-layout>
