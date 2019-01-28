<?php

namespace App\Services\JWT\Contracts;

use App\User;

interface JWTInterface
{
    public function encode(User $user): string;
    public function decode(string $token): User;
    public function gitEncode(): string;
}