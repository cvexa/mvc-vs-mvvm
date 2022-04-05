<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="container mb-2 mt-2 text-center mx-auto">
        <a href="{{route('users.create')}}">
            <button type="button" class="text-white bg-green-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">
                create
            </button>
        </a>
    </div>
    <div class="container mx-auto mt-5">
        @if (session()->has('success'))
            <div class="mx-auto text-center mb-2 mt-2 bg-green-400">{{session()->get('success')}}</div>
        @endif
        <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
            <thead>
            <tr class="text-center font-bold">
                <td class="border px-6 py-4">Name</td>
                <td class="border px-6 py-4">Email</td>
                <td class="border px-6 py-4">Actions</td>
            </tr>
            </thead>
            @foreach($userViewModel->getAllUsers() as $user)
                <tr class="text-center">
                    <td class="border px-6 py-4">{{$userViewModel->uppercaseNameOf($user)}}</td>
                    <td class="border px-6 py-4">{{$user->email}}</td>
                    <td class="border px-6 py-4">
                        {!! $userViewModel->getActions($user) !!}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
