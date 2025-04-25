<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Helpers\CryptoHelper;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
    
        $validated['password'] = Hash::make($validated['password']);
    
        $user = User::create($validated);
    
        return response()->json(new UserResource($user), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();
    
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
    
        $user->update($validated);
    
        return response()->json(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function updateTemplate(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);

        $user = $request->user();
        $user->template_id = $request->input('template_id');
        $user->save();

        return response()->json(['success' => true]);
    }

    public function updatePassword(Request $request)
    {
        logger([
            'currentPassword_encrypted' => $request->input('currentPassword'),
            'newPassword_encrypted' => $request->input('newPassword'),
            'confirmPassword_encrypted' => $request->input('confirmPassword'),
        ]);

        $currentPassword = CryptoHelper::decryptAES($request->input('currentPassword'));
        $newPassword = CryptoHelper::decryptAES($request->input('newPassword'));
        $confirmPassword = CryptoHelper::decryptAES($request->input('confirmPassword'));

        logger([
            'currentPassword_decrypted' => $currentPassword,
            'newPassword_decrypted' => $newPassword,
            'confirmPassword_decrypted' => $confirmPassword,
        ]);

        $validator = Validator::make([
            'currentPassword' => $currentPassword,
            'newPassword' => $newPassword,
            'confirmPassword' => $confirmPassword,
        ], [
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'min:8'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Hash::check($currentPassword, $request->user()->password)) {
            return response()->json([
                'message' => 'The current password is incorrect.',
            ], 422);
        }

        $request->user()->update([
            'password' => Hash::make($newPassword),
        ]);

        return response()->json(['message' => 'Password updated successfully']);
    }

}
