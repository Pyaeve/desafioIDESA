<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ClientesCuotasController extends Controller
{
    
     /**
    * @OA\Get(
    *     path="/api/clientes/:id/cuotas/:lote",
    *     summary="Visualiza Detalle de las Cuptas de un Cliente",
    *  tags={"Clientes"},
    *     @OA\Parameter(
    *         description="Authentication Bearer [token] esto va en la cabecera ",
    *         in="path",
    *         name="Authentication",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="string", value="Authentication Bearer [token]", summary="tokem"),
    *       
    *     ),
    *       @OA\Parameter(
    *         description="ID del Cliente ",
    *         in="path",
    *         name="id",
    *         required=true,
    *         @OA\Schema(type="int"),
    *         @OA\Examples(example="int", value="123456", summary="ID del cliente"),
    *       
    *     ),
    *  @OA\Parameter(
    *         description="ID del LOTE del Cliente ",
    *         in="path",
    *         name="lote",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="int", value="123456", summary="ID del LOTE del cliente"),
    *       
    *     ),
    *     @OA\Response(
    *         response="200",
    *         description="Si autentica devuelve un JSON con los datos del cliente .",
    * @OA\JsonContent(
    *         @OA\Examples(example="result",{"status":"ok","message":"detalle de la cuota del cliente!!","data":{"total":1,"detail":{
                "id": 4,
                "clienteID": 123456,
                "lote": "00148",
                "nro": 4,
                "precio": "130000",
                "vencimiento": "2022-10-01",
                "status": 1,
                "created_at": null,
                "updated_at": null
            },}},summary="Devuelve un Objeto JSON con la lista")
    *            
    *         )
    *     ),
    * @OA\Response(
    *         response="401",
    *         description="Devuelve un JSON con el error .",
    * @OA\JsonContent(
    *         @OA\Examples(example="result", {"status":"Unauthorized","message":"No tiene autorizacion para consumir la API"}, summary="Devuelve un Objeto JSON com el mensaje de error")
    *            
    *         )
    *     )
    * )
    */
    public function show($id, $lote)
    {
       try {
            
            $cuotas = DB::select("SELECT * FROM cuotas AS t1 WHERE t1.clienteID=".$id." AND t1.lote='".$lote."'"); 
           // dd($cliente);
           
            $msg=[];
             $msg['status'] = 'ok';
                $msg['message']   = "Detalle de las Cuotas del Lote ".$lote;
                $msg['data']['total']=0;
              
            foreach ($cuotas as $n) {
                $msg['status'] = 'ok';
                $msg['message']   = 'Detalle de las Cuotas del Lote: '.$lote;
                $msg['data']['total']     +=$n->precio ;
                $msg['data']['detail'][]    = $n;

            }
             
            $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']  );
            return $res;
        } catch (Exception $e) {
            $msg['status'] = 'error';
            $msg['message']      = 'no hay registros de algun Cliente con ese ID en nuestra Base de Datos';
            $res = response()->json($msg, 200,['x-dev-by'=>
            'Richard Arce
            ']  );
            return $res;
        }
    }

   
}
