<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    protected $user;

    public function __construct(){
    $this->middleware("auth:api",["except" => ["login","register"]]);
        $this->user = new User;
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()){
            return response()->json([
            'success' => false,
            'message' => $validator->messages()->toArray()
            ], 500);
        }
        $data = [
            'fname' => $request->fname ,
            'lname' =>$request->lname ,
            'email' => $request->email ,
            'phone' => $request->phone ,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($request->password),
        ];

        $this->user->create($data);
        $responseMessage = "Registration Successful";

        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }


    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->toArray()
            ], 500);
        }

        $credentials = $request->only(["email","password"]);

        $user = User::where('email',$credentials['email'])->first();

        if($user){
        if(!auth()->attempt($credentials)){
            $responseMessage = "Invalid username or password";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        // dd($accessToken );
        $responseMessage = "Login Successful";
        return $this->respondWithToken($accessToken,$responseMessage,auth()->user());

        }else{
            $responseMessage = "Sorry, this user does not exist";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }

    public function viewProfile(){
        $responseMessage = "user profile";
        $data = Auth::guard("api")->user();
        return response()->json([
            "success" => true,
            "message" => $responseMessage,
            "data" => $data
        ], 200);
    }

    public function logout(){
        $user = Auth::guard("api")->user()->token();
        $user->revoke();
        $responseMessage = "successfully logged out";
        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }
}
