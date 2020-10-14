<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('assets/images/favicon.ico') }}" style="max-height: 110px; display: block; margin-left: auto; margin-right: auto;">
            <br>
            <h4>Sistem Informasi Pengelolaan Cuti dan Izin Pengadilan Tinggi Banten</h4>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Username') }}" />
                <x-jet-input class="block mt-1 w-full" type="username" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
