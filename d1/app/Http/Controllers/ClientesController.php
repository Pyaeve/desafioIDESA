<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Validator;
use App\Clientes;



class ClientesController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/clientes",
    *     summary="Lista los usuarios ",
    *     @OA\Parameter(
    *         description="Authentication Bearer [token] esto va en la cabecera ",
    *         in="path",
    *         name="Authentication",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="string", value="Authentication Bearer [token]", summary="email del usuario"),
    *       
    *     ),
    *     
    *     @OA\Response(
    *         response="200",
    *         description="Si autentica devuelve un JSON con el ACCESS TOKEN .",
    * @OA\JsonContent(
    *         @OA\Examples(example="result",{"status":"ok","message":"Auteticacion de Usuario validado con Exito","data":{"total":1,"detail":{"id":1,"nombres":"IDESA","correo":"desafio@idesa.com.py","access_token":"3|LdDMJM9HFVi8hqfkKmlP3q7rPUejd4n6Wx1aldWS","type_token":"Bearer","value_token":"Bearer 3|LdDMJM9HFVi8hqfkKmlP3q7rPUejd4n6Wx1aldWS","expiration_token":"2800"}}}, summary="Devuelve un Objeto JSON con la lista de Clientes"),
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
    public function index()
    {
        $clientes = Clientes::paginate(10);
        $msg['status'] = 'ok';
        $msg['message']= 'Lista de Clientes, '.count($clientes). ' encontrados en total';
        $msg['data']['total']     = count($clientes);
        $msg['data']['detail']    = $clientes;
        $res = response()->json($msg,200,['DEV-BY'=>
            'Richard Arce
            ']);
        return $res;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
       
        //validamos primero el Request
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'correo' => 'required|max:255',
            'domicilio' => 'required|max:255',
            
        ]);
        //si no valida
        if ($validator->fails()) {
            //obtenos los errores
            $errors = $validator->errors();
            
             $msg['status'] = 'error';
                $msg['message']           = 'Error debe enviar todos los campos requeridos para crear un Cliente nuevo';
                $msg['data']['total']     = count($errors->messages());
                $msg['data']['detail']    = $errors->messages();
            $res = response()->json(
                $msg,200,['x-dev-by'=>
            'Richard Arce
            ']);

            throw new HttpResponseException($res);
            
        }else{
            //ahora intentamos crear el Cliente
            $cliente = Clientes::create($request->all());
            //validamos de nuevo que lo hemos creado con exito
            if(is_object($cliente) && $cliente->count()>0){
                $msg['status'] = 'ok';
                $msg['message']           = 'Cliente nuevo creado con Exito!!';
                $msg['data']['total']     = 1;
                $msg['data']['detail']    = $cliente;
                $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']);
                return $res;
            }else{
                //preparamos la respusta
               //respodemos con una Ex
            $res = response()->json([
                'status' => 'error',
                'message' => 'Ocurrio al gun error inexperado',
                ], 200, ['DEV-BY'=>
            'Richard Arce
            ']);
            throw new HttpResponseException($res);
            }

        }
        
    
     

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            
            $cliente = Clientes::findOrFail($id); 
            $msg['status'] = 'ok';
            $msg['message']   = 'Detalle del Cliente ';
            $msg['data']['total']     = 1;
            $msg['data']['detail']    = $cliente;
            $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']  );
            return $res;
        } catch (ModelNotFoundException $e) {
            $msg['status'] = 'error';
            $msg['message']      = 'no hay registros de algun Cliente con ese ID en nuestra Base de Datos';
            $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']  );
            return $res;
        }
        
       
     
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        try {
              //validamos primero el Request
            $validator = Validator::make($request->all(), [
                'id'=>'required',
                'nombres' => 'required|max:255',
                
            
             ]);
             //si no valida
           if ($validator->fails()) {
                //obtenos los errores
                $errors = $validator->errors();
                $msg['status'] = 'error';
                $msg['message']           = 'Error debe enviar todos los campos requeridos para crear un Cliente nuevo';
                $msg['data']['total']     = count($errors->messages());
                $msg['data']['detail']    = $errors->messages();
                $res = response()->json($msg,501,['x-dev-by'=>'Richard Arce']);

                throw new HttpResponseException($res);
            
            } 
            $cliente = Clientes::findOrFail($id)->update($request->all()); 
            $msg['status'] = 'ok';
            $msg['message']   = 'Cliente actualizado en con exito ';
            $msg['data']['total']=1;
            $msg['data']['detail']=$cliente;
            $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']  );
            return $res;
            //sino capturamos el error
        } 
         catch (ModelNotFoundException $e) {
            $msg['status'] = 'error';
            $msg['message']      = 'no hay registros de algun Cliente con ese ID en nuestra Base de Datos';
            $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']  );
            return $res;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cliente)
    {   //tratamos de borrar con softdeleting
        try {

            $cliente = Clientes::findOrFail($id)->delete(); 
            $msg['status'] = 'ok';
            $msg['message']   = 'Cliente borrado en con exito ';
            $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']  );
            return $res;
            //sino capturamos el error
        } catch (ModelNotFoundException $e) {
            $msg['status'] = 'error';
            $msg['message']      = 'no hay registros de algun Cliente con ese ID en nuestra Base de Datos';
            $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']  );
            return $res;
        }
        
    }
}
