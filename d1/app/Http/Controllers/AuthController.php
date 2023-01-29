<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
/**
* @OA\Info(title="API REST IDESA  ", version="1.0")
*
* @OA\Server(url="https://desafio.idesa.pyaeveapps.com")
*/
class AuthController extends Controller
{
    
   /**
    * @OA\Post(
    *     path="/api/user/auth",
    *     summary="Autentifica los usuarios ",
    *     @OA\Parameter(
    *         description="email",
    *         in="path",
    *         name="email",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="string", value="email@example.com", summary="email del usuario"),
    *       
    *     ),
    *      @OA\Parameter(
    *         description="password",
    *         in="path",
    *         name="password",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="string", value="123456", summary="password del usuario"),
    *       
    *     ),
    *     
    *     @OA\Response(
    *         response="200",
    *         description="Si autentica devuelve un JSON con el ACCESS TOKEN .",
    * @OA\JsonContent(
    *         @OA\Examples(example="result", {"status":"ok","message":"Auteticacion de Usuario validado con Exito","data":{"total":1,"detail":{"id":5,"nombres":"Martin Martinez","correo":"martin.martinez@idesa.com.py","access_token":"4|gBzzeriN5WIoqPoheZqKCcX8ZFeyETx6O8i9CirB","type_token":"Bearer","value_token":"Bearer 4|gBzzeriN5WIoqPoheZqKCcX8ZFeyETx6O8i9CirB","expiration_token":"2800"}}}, summary="Devuelve un Objeto JSON con los DATOS del Usuario y su Access Tokebn valido por 72h"),
    *            
    *         )
    *     ),
    * @OA\Response(
    *         response="401",
    *         description="Devuelve un JSON con el error .",
    * @OA\JsonContent(
    *         @OA\Examples(example="result", {"status":"Unauthorized","message":"No tiene autorizacion para consumir la API"}, summary="Devuelve un Objeto JSON com el mensaje de error"),
    *            
    *         )
    *     )
    * )
    */
  
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
