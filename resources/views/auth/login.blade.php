<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('github.auth.login') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold
                   text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none
                   focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ml-4"
                >
                    Login with GitHub
                </a>
                <a href="{{ route('google.auth.login') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold
                   text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none
                   focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ml-4"
                >
                    Login with Google
                </a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
