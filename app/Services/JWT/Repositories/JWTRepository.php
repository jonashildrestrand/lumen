<?php

namespace App\Services\JWT\Contracts;

use App\User;
use Firebase\JWT\JWT;

class JWTRepository implements JWTInterface
{
    public function encode(User $user): string
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + (60 * 30);

        $payload = [
            'iss' => 'Lumen',
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'id' => $user->id,
        ];

        $jwt = JWT::encode($payload, env('APP_KEY'), 'HS256');

        return $jwt;
    }

    public function decode(string $token): User
    {
        $payload = JWT::decode($token, env('APP_KEY'), ['HS256']);

        if(!isset($payload->id)) {
            return null;
        }

        $user = User::find($payload->id);

        return $user;
    }

    public function gitEncode(): string
    {
        $privateKey = file_get_contents(storage_path())

        $issuedAt = time();
        $expirationTime = $issuedAt + (60 * 30);

        $payload = [
            'iss' => 'Lumen',
            'iat' => $issuedAt,
            'exp' => $expirationTime,
        ];

        $jwt = JWT::encode($payload, $privateKey, 'HS256');

        return $jwt;
    }
}