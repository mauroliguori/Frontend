<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class FrutaController extends Controller
{
    private $requestHeaders = [
        "Content-Type" => "application/json",
        "Accept" => "application/json",
    ];

    private function sendGet(){
        return Http::withHeaders($this -> requestHeaders) 
            -> get(getenv("API_FRUTAS_URL"));
    }
    private function sendGetOne($id){
        return Http::withHeaders($this -> requestHeaders) 
            -> get(getenv("API_FRUTAS_URL") . $id);
    }
    private function sendDelete($id){
        return Http::withHeaders($this -> requestHeaders) 
            -> delete(getenv("API_FRUTAS_URL") . $id);
    }

    private function sendPost($data){
        return Http::withHeaders($this -> requestHeaders) 
            -> post(getenv("API_FRUTAS_URL"), $data);
    }

    public function Listar(Request $request){
        try {
            $response = $this -> sendGet();

            if($response -> successful()){
                $frutas = json_decode($response->body(),true);
                return view("frutas",[ "frutas" => $frutas ]);
            }
        }
        catch(\Illuminate\Http\Client\ConnectionException $e) {
            return view("error",["error" => "No se pudo conectar con la API"]);
        }
        return view("error",[ "error" => "Hubo un error"]);
        
        
    }

    public function Obtener(Request $request,$idFruta){
        try {
            $response = $this -> sendGetOne($idFruta);

            if($response -> successful()){
                $fruta = json_decode($response->body(),true);
                return view("fruta",[ "fruta" => $fruta ]);
            }
        }
        catch(\Illuminate\Http\Client\ConnectionException $e) {
            return view("error",["error" => "No se pudo conectar con la API"]);
        }
        
        return view("error",[ "error" => "Hubo un error"]);
        
    }
    public function Crear(Request $request){
        try {
            $response = $this -> sendPost([
                    "nombre" => $request -> post("nombre"),
                    "precio" => $request -> post("precio"),
                    "tipo" => $request -> post("tipo"),
                    "gramos" => $request -> post("gramos"),
            ]);
            if($response -> successful()){
                $fruta = json_decode($response->body(),true);
                return redirect("/frutas")->with("fruta",$fruta);
            }
        }

        catch(\Illuminate\Http\Client\ConnectionException $e) {
            return view("error",["error" => "No se pudo conectar con la API"]);
        }

        return view("error",[ "error" => "Hubo un error"]);
        
    }

    public function Eliminar(Request $request, $idFruta){
        try{
            $response = $this -> sendDelete($idFruta);
            if(
                $response -> successful() && 
                json_decode($response->body(),true)['message'] === "Deleted"
            ){
                return redirect("/frutas")
                    ->with("eliminado",$idFruta);
            }
        }

        catch(\Illuminate\Http\Client\ConnectionException $e) {
            return view("error",["error" => "No se pudo conectar con la API"]);
        }
        
        return view("error",[ "error" => "Hubo un error"]);
        
    }
}
