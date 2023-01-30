<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="API REST (LARAVEL 7) IDESA ",
     *      description="API REST construido con Laravel 7 y Documentado con Swagger",
     *      @OA\Contact(
     *          email="rifarca@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     * 
     * @OA\Server(url="https://desafio.idesa.pyaeveapps.com/v2/public")
     * @OA\Tag(
     *     name="Usuarios",
     *     description="API para manejar Usuarios y su Autenticacion"
     * )
     * @OA\Tag(
     *     name="Clientes",
     *     description="API para manejar Clientes"
     * )
     * 
        */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
