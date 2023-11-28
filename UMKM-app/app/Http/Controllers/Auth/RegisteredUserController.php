<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {   $filename1 = null;
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto' => ['required', 'mimes:jpeg,png', 'file'],
            'NIK' => ['required'],
        ]);
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename1 = time() . $request->file('foto')->getClientOriginalName();
            $path1 = $request->file('foto')->storeAs('file/', $filename1, 'public');
        }else{
            
        }
        $validated['foto']=$filename1;
        

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);
        $id = $user->id;

        return redirect()->route('umkm.index',['id'=>$id]);
    }
}
