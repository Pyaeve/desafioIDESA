<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class AuthController extends Controller
{
    
    //login
    public function login(Request $request)
    {
        try {
           $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                 return response()->json([
                    'status' => 'Unauthorized',
                    'message' => 'No tiene autorizacion para consumir la API'], 
                    200,
                    
                );
            }
            $user = User::where('email', $request->email)->first();
            if ( ! Hash::check($request->password, $user->password, [])) {
                return response()->json([
                    'status' => 'Unauthorized',
                    'message' => 'No tiene autorizacion para consumir la API'], 
                    
                    
                );
            }
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status' => 'ok',
                'message'=>'Auteticion de Usuario validado con Exito',
                'data'=>[
                    'total'=>1,    
                    'detail'=> [
                        'access_token' => $tokenResult,
                        'token_type' => 'Bearer',
                       ]
                ]
            ],200,['x-dev-by'=>'Richard Arce']);
        }catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message'=>'Error al intentar Autenticar ',
                'data'=>[
                    'total'=>1,    
                    'detail'=> [
                        'exception' => $error
                        
                    ]
                ]
            ],401,['x-dev-by'=>'Richard Arce']);
        }
    }
}
