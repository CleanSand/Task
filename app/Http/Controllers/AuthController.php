<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Функция регистрации
    public function register(Request $request){
        $fields = $request->validate([
            'firstName' => 'required|string',
            'secondName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'firstName' => $fields['firstName'],
            'secondName' => $fields['secondName'],
            'lastName' => $fields['lastName'],
            'roleID' => 2,
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('qwe')->plainTextToken;
        $response = [
            'user'=> $user,
            'token'=> $token
        ];
        return response($response,201);
    }
    // Функция авторизации
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Проверка почты
        $user = User::where('email', $fields['email'])->first();


        // Проверка пароля
        if (!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Incorrect password'
            ], 401);
        }


        $token = $user->createToken('qwe')->plainTextToken;
        $response = [
            'user'=> $user,
            'token'=> $token
        ];
        return response($response,201);
    }
    // Функция выхода
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logout'
        ];
    }
}
