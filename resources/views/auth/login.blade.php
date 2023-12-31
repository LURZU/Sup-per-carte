<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <a href="/" class="d-flex justify-content-center mb-3">
                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                        </a>
                        <form style="margin-top: 70px" method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />

                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="form-group mt-4">
                                <x-input-label for="password" :value="__('Mot de passe')" />

                                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('Mot de passe')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mt-4">
                                <label for="remember_me" class="form-check-label">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir de moi') }}</span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                        {{ __('Vous avez oubliez?') }}
                                    </a>
                                @endif

                                <x-primary-button class="ml-3 btn btn-primary">
                                    {{ __('Se connecter') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
