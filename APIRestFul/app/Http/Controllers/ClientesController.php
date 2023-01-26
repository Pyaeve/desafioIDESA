<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Validator;
use App\Clientes;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Clientes::all();
        $msg['status'] = 'ok';
        $msg['message']= 'Lista de Clientes, '.count($clientes). ' encontrados en total';
        $msg['data']['total']     = 1;
        $msg['data']['detail']    = $clientes;

        return $msg;

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
            //respodemos con una Ex
            $res = response()->json([
                'status' => 'error',
                'message' => $errors->messages(),
                ], 200);
            throw new HttpResponseException($res);
            
        }else{
            //ahora intentamos crear el Cliente
            $cliente = Cliente::create($request->all());
            //validamos de nuevo que lo hemos creado con exito
            if(is_object($cliente) && $cliente->count()>0){
                $res['status'] = 'ok';
                $res['message']           = 'Cliente nuevo creado con Exito!!';
                $res['data']['total']     = $cliente->count();
                $res['data']['detail']    = $cliente;
                return $res;
            }else{
                //preparamos la respusta
               //respodemos con una Ex
            $res = response()->json([
                'status' => 'error',
                'message' => 'Ocurrio algun error inexperado al trat de crear un nuevo Cliente',
                ], 200);
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
        $msg = [];
        $cliente = Clientes::findOrFail($id);
        
        if(is_object($cliente) && $cliente->count()>0){

            $msg['status'] = 'ok';
            $msg['message']   = 'Detalle del Cliente ';
             $msg['data']['total']     = $cliente->count();
             $msg['data']['detail']    = $cliente;

        }else{
            $msg['status'] = 'error';
            $msg['message']      = 'no hay registros de algun Cliente con ese ID en nuestra Base de Datos';
        }
        return $msg;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Cliente = Clientes::findOrFail($id)->delete();


    }
}
