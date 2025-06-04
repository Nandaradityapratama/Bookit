<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = Auth::user();
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with(['book' => function($query) {
                $query->select('id', 'title');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.show', compact('borrowings', 'user'));
    }

    public function index()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with(['book' => function($query) {
                $query->select('id', 'title');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.index', compact('borrowings'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with(['book' => function($query) {
                $query->select('id', 'title');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.edit', compact('borrowings', 'user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Simpan foto baru
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui');
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
}
