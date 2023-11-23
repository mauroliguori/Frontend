<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TareaController extends Controller
{
    private $requestHeaders = [
        "Content-Type" => "application/json",
        "Accept" => "application/json",
    ];

    private function sendGet(){
        return Http::withHeaders($this -> requestHeaders) 
            -> get(getenv("API_TAREAS_URL") . "/api/v1/tareas");
    }
    public function Listar(Request $request){
        try {
            $response = $this -> sendGet();

            if($response -> successful()){
                $tareas = json_decode($response->body(),true);
                return view("tareas",[ "tareas" => $tareas ]);
            }
        }
        catch(\Illuminate\Http\Client\ConnectionException $e) {
            return view("error",["error" => "No se pudo conectar con la API"]);
        }
        return view("error",[ "error" => "Hubo un error"]);
        
        
    }
}
