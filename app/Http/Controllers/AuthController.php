<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\Auth\RegisteringRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //
    public function login(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function callback($provider)
    {
        $data = Socialite::driver($provider)->user();
        $user = User::query()->where('email', $data->getEmail())->first();
        $check_exist = true;
        if (is_null($user)) {
            $user = new User();
            $user->email = $data->getEmail();
            $user->role = UserRoleEnum::APPLICANT;
            $check_exist = false;
        }
        $user->name = $data->getName();
        $user->avatar = $data->getAvatar();
        $user->save();
        Auth::login($user);
        if ($check_exist) {
            $role = strtolower(UserRoleEnum::fromValue((int)$user->role)->key);
            return redirect()->route("$role.users.index");
        }
        return redirect()->route('auth.register');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function registering(RegisteringRequest $request)
    {
        $password = Hash::make($request->password);
        $role = $request->role;
        if (Auth::check()) {
            User::query()
                ->where('id', Auth::user()->id)
                ->update([
                    'password' => $password,
                    'role' => $role,
                ]);
        } else {
            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'role' => $role,
            ]);
            Auth::login($user);
        }
        $role = strtolower(UserRoleEnum::fromValue((int)$role)->key);
        return redirect()->route($role . '.users.index');
    }

}
