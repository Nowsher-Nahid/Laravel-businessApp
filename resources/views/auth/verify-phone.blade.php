<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Please enter the verification code sent to your phone number to verify your account.') }}
    </div>

    @if (session('status') == 'phone-verified')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Your phone number has been verified!') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('verify.phone') }}">
        @csrf

        <div class="mb-4">
            <label for="code" class="block text-sm font-medium text-gray-700">
                {{ __('Verification Code') }}
            </label>
            <input type="text" id="code" name="code" class="mt-1 block w-full" required>
        </div>

        <div>
            <x-primary-button>
                {{ __('Verify Phone Number') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
