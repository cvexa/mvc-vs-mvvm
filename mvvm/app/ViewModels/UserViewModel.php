<?php

namespace App\ViewModels;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\PseudoTypes\Numeric_;
use Spatie\ViewModels\ViewModel;

class UserViewModel extends ViewModel
{
    public ?User $user;
    private const MSG = 'Successfully %s user ';

    public function __construct(?User $user = null)
    {
        $this->user = $user?:null;
    }

    /**
     * Getting route for storing users
     *
     * @return string
     */
    public function getStoreRoute(): string
    {
        return URL::to('users');
    }

    /**
     * Getting route for edit users
     *
     * @param User $user
     * @return string
     */
    public function getEditRoute(User $user): string
    {
        return URL::to('users/'.$user->id.'/edit');
    }

    /**
     * Getting route for updating users
     *
     * @param User $user
     * @return string
     */
    public function getUpdateRoute(User $user): string
    {
        return URL::to('users/'.$user->id);
    }

    /**
     * Getting route for deleting users
     *
     * @param User $user
     * @return string
     */
    public function getDeleteRoute(User $user): string
    {
        return URL::to('users/'.$user->id);
    }

    /**
     * Getting the action buttons for a user actions
     *
     * @param User $user
     * @return string
     */
    public function getActions(User $user):string
    {
        return '<a href="'.$this->getEditRoute($user).'">
                            <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">
                                edit
                            </button>
                        </a>
                        <form action="'.$this->getDeleteRoute($user) .'" method="POST">
                          <input type="hidden" name="_token" value="'. csrf_token() .'">
                          <input type="hidden" name="_method" value="delete">
                            <input type="submit" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800" value="delete">
                        </form>';
    }

    /**
     * Getting the name input field
     *
     * @param string|null $name
     * @return string
     */
    public function getNameInput(?string $name = ''): string
    {
        $name = !empty($name)?$name:old('name');
        return '<input
         class="
         appearance-none
         block w-full
         bg-gray-200
         text-gray-700
         border
         border-gray-200
         rounded
         py-3
         px-4
         leading-tight
         focus:outline-none
         focus:bg-white
         focus:border-gray-500"
         id="grid-first-name"
         name="name"
         type="text"
         placeholder="Jane"
         value="'.$name.'">';
    }

    /**
     * Getting the email input field
     *
     * @param string|null $email
     * @return string
     */
    public function getEmailInput(?string $email = ''): string
    {
        $email = !empty($email)?$email:old('email');
        return '<input
         class="
         appearance-none
         block w-full
         bg-gray-200
         text-gray-700
         border
         border-gray-200
         rounded
         py-3
         px-4
         leading-tight
         focus:outline-none
         focus:bg-white
         focus:border-gray-500"
         id = "grid-last-name"
         name = "email"
         type = "email"
         placeholder = "Doe@gmail.com"
         value = "'.$email.'">';
    }

    /**
     * Getting the password input field
     *
     * @return string
     */
    public function getPasswordInput(): string
    {
        return '<input
         class="
         appearance-none
         block
         w-full
         bg-gray-200
         text-gray-700
         border
         border-gray-200
         rounded
         py-3
         px-4
         mb-3
         leading-tight
         focus:outline-none
         focus:bg-white
         focus:border-gray-500"
         id="grid-password"
         name="password"
         type="password"
         placeholder="******************">';
    }

    /**
     * Getting the email input field
     *
     * @return string
     */
    public function getRepeatPasswordInput(): string
    {
        return '<input
         class="
         appearance-none
         block
         w-full
         bg-gray-200
         text-gray-700
         border
         border-gray-200
         rounded
         py-3
         px-4
         mb-3
         leading-tight
         focus:outline-none
         focus:bg-white
         focus:border-gray-500"
         id="grid-password"
         name="password_confirmation"
         type="password"
         placeholder="******************">';
    }

    /**
     * Returning collection of all users from the DB
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    /**
     * Returning User object or null if not fount
     *
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Changing the name to a uppercase string
     *
     * @param User $user
     * @return string|null
     */
    public function uppercaseNameOf(User $user):?string
    {
        return $user->name;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @param bool $redirect
     * @return RedirectResponse | string
     */
    public function store(StoreUserRequest $request, bool $redirect = true): RedirectResponse|string
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $message = sprintf(SELF::MSG,'created').''.$user->name;

        if($redirect) {
            return redirect()->route('users.index')->with('success', $message);
        }

        return $message;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUserRequest $request
     * @param $id
     * @param bool $redirect
     * @return RedirectResponse | string
     */
    public function update(StoreUserRequest $request, int $id, bool $redirect = true):RedirectResponse|string
    {
        $user = $this->getUserById($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $message = sprintf(SELF::MSG,'updated').''.$user->name;

        if($redirect) {
            return redirect()->route('users.index')->with('success', $message);
        }

        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $userId
     * @param bool $redirect
     * @return RedirectResponse | string
     */
    public function delete(int $userId, bool $redirect = true):RedirectResponse|string
    {
        $user = $this->getUserById($userId);
        $username = $user->name;
        $user->delete();

        $message = sprintf(SELF::MSG, 'deleted') . '' . $username;

        if($redirect) {
            return redirect()->route('users.index')->with('success', $message);
        }

        return $message;
    }
}
