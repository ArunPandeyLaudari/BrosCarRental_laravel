<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
    {
        // Custom validation rule for email
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Ensures email starts with a letter, and domain/TLD are valid
                function ($attribute, $value, $fail) {
                    $parts = explode('@', $value); // Split email into local and domain parts
                    $localPart = $parts[0];
                    $domainParts = explode('.', $parts[1]); // Split domain into subdomain and TLD
    
                    if (is_numeric($localPart)) {
                        $fail('The email local part (before @) cannot be entirely numeric.');
                    }
    
                    if (is_numeric($domainParts[0])) {
                        $fail('The email domain cannot be entirely numeric.');
                    }
    
                    if (is_numeric($domainParts[count($domainParts) - 1])) {
                        $fail('The email TLD (after last dot) cannot be numeric.');
                    }
                }
            ],
            'phonenumber' => ['required', 'integer'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'photopath' => ['nullable', 'image'],
            'terms' => ['accepted'],
        ], [
            'email.regex' => 'The email format is invalid or the domain/TLD cannot be numeric.',
        ]);
    
        // Handle file upload for the photo
        $photoname = null;
        if ($request->hasFile('photopath')) {
            $photoname = time() . '.' . $request->photopath->extension();
            $request->photopath->move(public_path('uploads/users'), $photoname);
        }
    
        // Create new user with validated data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'password' => Hash::make($request->password),
            'photopath' => $photoname,
        ]);
    
        // Fire the Registered event
        event(new Registered($user));
    
        // Redirect to the login page after successful registration
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
    
    
}
