<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialException;
use App\Http\Requests\IssueTokenRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OA;

class IssueTokenController extends Controller
{
    #[OA\Post(path: '/api/tokens', tags: ['auth'])]
    #[OA\RequestBody(
        content: new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(ref: '#/components/schemas/IssueTokenRequest')
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'access_token', type: 'string'),
                new OA\Property(property: 'user', ref: '#/components/schemas/User'),
            ]
        )
    )]
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
