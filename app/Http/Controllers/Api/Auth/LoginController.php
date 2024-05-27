<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //untuk validasi data
use Tymon\JWTAuth\Facades\JWTAuth; //untuk mendapatkan token JWT

class LoginController extends Controller
{
    /**
     * index (function yang akan dipanggil pertama kali ketika class
     * ini di running)
     * 
     * @param mixed $request
     * @return void
     */
    public function index(Request $request)
    {

        //set validasi
        $validator = Validator::make($request->all(),[
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        //response error validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }



        //get "email" dan "password" dari input
        $credentials = $request->only('email', 'password');

        //check jika "email" dan "password" tidak sesuai
        if(!$token = auth()->guard('api')->attempt($credentials))

            //response login "failed"
            return response()->json([
                'success' => false,
                'message' => 'Email atau pasword salah'
            ],400);

        $user   =  auth()->guard('api')->user();

        $role = $user->getRoleNames();

        // response login "success" dengan generate "Token"
        return response()->json([
            'success'       => true,
            'user'          => auth()->guard('api')->user()->only(['name', 'email']),
            'permissions'   => auth()->guard('api')->user()->getPermissionArray(),
            'role'          => $role,
            'token'         => $token
            ], 200);
    }


    /**
     * logout
     * berfungsi untuk menghapus JWT Token
     * @return void
     */
    public function logout()
    {
        //remove "token" JWT
        JWTAuth::invalidate(JWTAuth::getToken());

        //response "success" logout
        return response()->json([
            'success' => true,
        ],200);
    }
}
