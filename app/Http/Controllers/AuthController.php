<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $input = $request->all();

        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'password2' => 'required|same:password',
        // ]);

        // if ($validator->fails()) {
        //     return $this->errorResponse('Validator error', $validator->errors());
        // }

        // $input['password'] = bcrypt($input['password']);

        // $user = User::create($input);

        // $response = [
        //     'token' => $user->createToken('thauCodeing')->plainTextToken(),
        //     'name' => $user->name,
        //     'email' => $user->emil,
        // ];

        // return $this->successResponse();
    }
}
