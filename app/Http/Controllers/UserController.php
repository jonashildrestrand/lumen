<?php

namespace App\Http\Controllers;

use App\Services\JWT\Contracts\JWTInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    private $jwtInterface;

    /**
     * Create a new controller instance.
     *
     * @param JWTInterface $jwtInterface
     */
    public function __construct(JWTInterface $jwtInterface)
    {
        $this->jwtInterface = $jwtInterface;
    }

    public function login(Request $request): string
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if(!$user) throw new Exception('User does not exist!');

        if(Hash::check($password, $user->password)) {
            return response()->json(['token' => $this->jwtInterface->encode($user)]);
        } else {
            throw new Exception('Invalid password!');
        }
    }

    public function details(User $user)
    {
        $user = Auth::user();

        return response()->json([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name
        ]);
    }
}
