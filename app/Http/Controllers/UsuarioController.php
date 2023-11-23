<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsuarioController extends Controller
{
    private $requestHeaders = [
        "Content-Type" => "application/json",
        "Accept" => "application/json",
    ];
    private function sendPost($data){
        return Http::withHeaders($this -> requestHeaders) 
            -> post(getenv("API_OAUTH_URL") . "/oauth/token", $data);
    }

    public function Login(Request $request){
        try {
            $response = $this -> sendPost([
                    "username" => $request -> post("username"),
                    "password" => $request -> post("password"),
                    "grant_type" => $request -> post("grant_type"),
                    "client_id" => $request -> post("client_id"),
                    "client_secret" => $request -> post("client_secret"),
            ]);
            
            if($response -> successful()){
                $tokenData = json_decode($response->body(),true);

                echo '<script>';
                echo 'localStorage.setItem("access_token", "' . $tokenData['access_token'] . '");';
                echo '</script>';
                
            
                return redirect("/tareas")->with("tokenData",$tokenData);
            }
        } catch (Exception $e) {
        
            return redirect()->back()->withErrors(['error' => 'Error en la autenticación']);
        }
    }
}