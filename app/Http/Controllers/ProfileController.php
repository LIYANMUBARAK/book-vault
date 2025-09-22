<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\UpdatePasswordRequest;




class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
   public function edit(Request $request)
{
    return view('profile.edit', [
        'user' => $request->user(), // THIS MUST BE PRESENT
    ]);
    
}



public function updatePassword(UpdatePasswordRequest $request)
{
    // Add some debugging
    \Log::info('Password update attempt', [
        'user_id' => $request->user()->id,
        'has_current_password' => !empty($request->current_password),
        'has_new_password' => !empty($request->password),
    ]);

    $user = $request->user();
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('profile.edit')->with('status', 'password-updated');
}


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function adminDashboard()
{
    $this->authorize('admin-only');

    $totalBooks = \App\Models\Book::count();
    $borrowedBooks = \App\Models\BorrowRecord::whereNull('returned_at')->count();
    $overdueBooks = \App\Models\BorrowRecord::whereNull('returned_at')
                        ->where('due_date', '<', now())->count();

    return view('dashboard.admin', compact('totalBooks', 'borrowedBooks', 'overdueBooks'));
}


public function memberDashboard()
{
    $borrowedBooks = \App\Models\BorrowRecord::where('user_id', Auth::id())
                        ->whereNull('returned_at')
                        ->with('book')
                        ->get();

    return view('dashboard.member', compact('borrowedBooks'));
}

}
