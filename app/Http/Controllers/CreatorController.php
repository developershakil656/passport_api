<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) 
            return send_response(false,'validation error!',$validator->errors());

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)) {
            $creator          = Auth::user();
            $data['creator']  = $creator;
            $data['token'] = $creator->createToken('creatorToken')->accessToken;

            return send_response(true, 'You are successfully logged in.',$data);
        } else {
            return send_response(false, 'something went wrong!',[], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:creators',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) return send_response(false,'Validation Error!', $validator->errors(), 422);

        // try {
            $creator =new Creator;
            $creator->name = $request->name;
            $creator->email = $request->email;
            $creator->password = Hash::make($request->password);
            $creator->save();

            $data['creator']  = $creator;
            $data['token'] = $creator->createToken('creatorToken')->accessToken;

            return send_response(true, 'registration successfully complated.',$data);
        // } catch (Exception $e) {
        //     return send_response(false, 'Unable to register your account!'.$e);
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return send_response(true, 'You are successfully logged out.');
    }

}
