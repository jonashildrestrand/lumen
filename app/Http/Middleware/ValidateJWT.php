<?php

namespace App\Http\Middleware;

use App\Services\JWT\Contracts\JWTInterface;
use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;

class ValidateJWT
{

    /**
     * @var JWTInterface
     */
    private $jwt;

    /**
     * ValidateJWT constructor.
     * @param JWTInterface $jwt
     */
    public function __construct(JWTInterface $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        try {
            $user = $this->jwt->decode($token);
        } catch (\Exception $e) {
            throw new Exception('Invalid token!');
        }

        Auth::setUser($user);

        return $next($request);
    }
}