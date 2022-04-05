<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="container mx-auto text-center content-center mt-2">
        <form class="w-full mt-5" action="{!! $userViewModel->getStoreRoute() !!}" method="POST">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        First Name
                    </label>
                    {!! $userViewModel->getNameInput() !!}
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        E-mail
                    </label>
                    {!! $userViewModel->getEmailInput() !!}
                    @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        Password
                    </label>
                    {!! $userViewModel->getPasswordInput() !!}
                    <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
                    @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        Repeat Password
                    </label>
                    {!! $userViewModel->getRepeatPasswordInput() !!}
                </div>
            </div>
            <button type="submit" class="text-white bg-green-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">
                create
            </button>
        </form>
    </div>
</x-app-layout>
