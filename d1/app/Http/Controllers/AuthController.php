<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
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
                   401,['x-dev-by'=>'Richard Arce']
                    
                );
            }
            $user = User::where('email', $request->email)->first();
            if ( ! Hash::check($request->password, $user->password, [])) {
                return response()->json([
                    'status' => 'Unauthorized',
                    'message' => 'No tiene autorizacion para consumir la API'], 401,['x-dev-by'=>'Richard Arce']
                    
                    
                );
            }
            if (count(DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()) > 0) {
            DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();
            }
            $tokenResult = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'status' => 'ok',
                'message'=>'Auteticacion de Usuario validado con Exito',
                'data'=>[
                    'total'=>1,    
                    'detail'=> [
                        'id'=>$user->id,
                        'nombres'=>$user->name,
                        'correo'=>$user->email,
                        'access_token' => $tokenResult,
                        'type_token' => 'Bearer',
                        'value_token'=>'Bearer '.$tokenResult,
                        'expiration_token'=>env('API_EXPIRE_ACCESS_TOKEN',5)
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
            ],401,['x-dev-by'=>'Richard Arce','server','anda a saber']);
        }
    }
}
