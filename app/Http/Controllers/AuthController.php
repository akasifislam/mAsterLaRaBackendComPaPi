<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password2' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validator error', $validator->errors());
        }

        $checkEmail = User::where("email", $input['email'])->first();

        if ($checkEmail) {
            return $this->errorResponse('Email already exist');
        }

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $response = [
            'token' => $user->createToken('thauCodeing')->plainTextToken,
            'name' => $user->name,
            'email' => $user->emil,
        ];

        return $this->successResponse($response, "User Successfully Register");
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = Auth::user();
            $response = [
                'token' => $user->createToken('thauCodeing')->plainTextToken,
                'name' => $user->name,
                'email' => $user->emil,
            ];
            return $this->successResponse($response, "User Successfully login");
        } else {
            return $this->errorResponse("Your Email or Password is not valid");
        }
    }
}
