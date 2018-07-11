<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => $success, 'message' => 'Berhasil login!'], $this->successStatus);
        }
        else{
            return response()->json(['errorr'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['message'] =  "akun ".$user->name." sukses dibuat";

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function detailuser($id)
    {
    	$user = User::find($id);
    	if($user){
    		return response()->json(['status' => 'success', 'data' => $user]);
    	}

    	return response()->json(['status' => 'error', 'message' => 'Data not found'],404);
    }

    public function delete($id)
    {
    	$user = User::find($id);
    	if($user){
    		$user->delete();
    		return response()->json(['status' => 'success', 'message' => "user dihapus"]);
    	}else{
    		return response()->json(['status' => 'fail', 'message' => "User gagal dihapus"]);
    	}

    }
}
