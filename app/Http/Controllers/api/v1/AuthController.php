<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Request\UserLoginRequest;
use App\Http\Request\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(UserRegistrationRequest $request)
    {

        $input = $request->only('name', 'email', 'password');
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('WedevsExam')->plainTextToken;
        $success['name'] =  $user->name;
        if($user){
            return $this->success($success, 'User register successfully.', 200);
        }else{
            return $this->error('User Registration Failed', 404);
        }
    }

    public function login(UserLoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $data['token'] =  $user->createToken('weDevsProject')->plainTextToken;
            $data['name'] =  $user->name;
            return $this->success($data, 'User login Successful.', 200);
        }
        elseif (!Auth::attempt()) {
            return $this->error('Credentials did not match',404);
        }
        else{
            return $this->error('You are Unauthorised!.', 404);
        }
    }



}
