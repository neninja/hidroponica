<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialException;
use App\Http\Requests\IssueTokenRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class IssueTokenController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IssueTokenRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            throw new InvalidCredentialException();
        }

        /** @var User $user */
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken($request->input('device') ?? $request->userAgent());

        return response()->json([
            'access_token' => $token->plainTextToken,
            'device' => $token->accessToken->name,
            'user' => new UserResource($user),
        ]);
    }
}
