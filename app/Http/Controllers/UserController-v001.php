<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(Request $request)
    {
        try {
            $datum = $request->validate(
                [
                    'fname' => ['required', 'string', 'max:255'],
                    'lname' => ['required', 'string', 'max:255'],
                    'phone' => ['required'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]
            );

        } catch (\Throwable $th) {
            //throw validation err;
            /**
             * if ($validator->fails()) {
             * $error = $validator->errors()->first();
             * }
             */
            $validatorErr = $th->errors();
            //422 Unprocessable Content
            return response()->json(['errors' =>$validatorErr], 422);
        }

        try {
            $password = Hash::make($datum['password']);//bcrypt
            $userModelInstance=User::create([
                'fname' => $datum['fname'] ,
                'lname' => $datum['lname'] ,
                'email' => $datum['email'] ,
                'phone' => $datum['phone'] ,
                'email_verified_at' => Carbon::now(),
                'password' => $password,
            ]);
            return response()->json(['success' => $userModelInstance], 201);

        } catch (\Throwable $th) {
            //throw creation SQL err;
            $queryErr= $th->getMessage();
            //500 Internal Server Erro
            return response()->json(['errors' => $queryErr], 500);
        }

    }
    function login(Request $request)
    {
        try {
            $datum = $request->validate(
                [

                    'email' => ['required'],
                    'password' => ['required'],
                ]
            );

        } catch (\Throwable $th) {
            //throw validation err;
            /**
             * if ($validator->fails()) {
             * $error = $validator->errors()->first();
             * }
             */
            $validatorErr = $th->errors();
            //422 Unprocessable Content
            return response()->json(['errors' =>$validatorErr], 422);
        }


        try {
            $user = DB::table('users')->where('email',$datum['email'])->first();
            if(!Hash::check($datum['password'], $user->password))
            {
                //Not found
                return response()->json(['errors' =>"User not Found"], 404);
            }
            else
            {
                //Found
                return response()->json(['success' =>$user], 200);
            }
        } catch (\Throwable $th) {
            $queryErr= $th->getMessage();
            return response()->json(['errors' => $queryErr], 500);
        }


    }
}
