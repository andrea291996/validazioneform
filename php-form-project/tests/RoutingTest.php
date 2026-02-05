<?php

use PHPUnit\Framework\TestCase;
use App\Controller\FormController;
use App\Http\Request;
use App\Http\Response;
use Laminas\Escaper\Escaper;
use App\App;


class RoutingTest extends TestCase{

    //GET

    public function testGetRitornoStatus(){
        $app = new App();
        $request = new Request([], [], [
            'REQUEST_METHOD'=>'GET',
            'REQUEST_URI'=>'/'
        ]);
        $response = $app->handle($request);
        $controllo = $response->status();
        $this->assertSame(200, $controllo);
    }    

    public function testGetRitornoStatusPathNonEsistente(){
        $app = new App();
        $request = new Request([], [], [
            'REQUEST_METHOD'=>'GET',
            'REQUEST_URI'=>'/pincopallino'
        ]);
        $response = $app->handle($request);
        $controllo = $response->status();
        $this->assertSame(404, $controllo);
    } 

    public function testGetRitornoContieneParola404PathNonEsistente(){
        $app = new App();
        $request = new Request([], [], [
            'REQUEST_METHOD'=>'GET',
            'REQUEST_URI'=>'/pincopallino'
        ]);
        $response = $app->handle($request);
        $testo = $response->body();
        $parola = "404 Not Found";
        $controllo = str_contains($testo, $parola);
        $this->assertSame(true, $controllo);
    } 

    public function testGetRitornoContieneParolaForm(){
        $app = new App();
        $request = new Request([], [], [
            'REQUEST_METHOD'=>'GET',
            'REQUEST_URI'=>'/'
        ]);
        $response = $app->handle($request);
        $testo = $response->body();
        $parola = "<form";
        $controllo = str_contains($testo, $parola);
        $this->assertSame(true, $controllo);
    }    

    //POST

    public function testPostRitornoSenzaErroriStatus(){
        $app = new App();
        $post = [
            "name" => "aaaaaa",
            "email" => "aaaa@aaaa.aa",
            "message"=> "aaaaaaaaaaaaaaaaaaaaa"        
            ];
        $request = new Request([], $post, [
            'REQUEST_METHOD'=>'POST',
            'REQUEST_URI'=>'/submit'
        ]);
        $response = $app->handle($request);
        $controllo = $response->status();
        $this->assertSame(200, $controllo);
    }   

    public function testPostRitornoSenzaErroriContieneParolaGrazie(){
        $app = new App();
        $post = [
            "name" => "aaaaaa",
            "email" => "aaaa@aaaa.aa",
            "message"=> "aaaaaaaaaaaaaaaaaaaaa"        
            ];
        $request = new Request([], $post, [
            'REQUEST_METHOD'=>'POST',
            'REQUEST_URI'=>'/submit'
        ]);
        $response = $app->handle($request);
        $testo = $response->body();
        $parola = "Grazie";
        $controllo = str_contains($testo, $parola);
        $this->assertSame(true, $controllo);
    }
    
    public function testPostRitornoConErroriStatus(){
        $app = new App();
        $post = [
            "name" => "a",
            "email" => "aaaa@aaaa.aa",
            "message"=> "a"        
            ];
        $request = new Request([], $post, [
            'REQUEST_METHOD'=>'POST',
            'REQUEST_URI'=>'/submit'
        ]);
        $response = $app->handle($request);
        $controllo = $response->status();
        $this->assertSame(422, $controllo);
    }  
    
    public function testPostRitornoConErroriContieneParolaCorreggi(){
        $app = new App();
        $post = [
            "name" => "a",
            "email" => "aaaa@aaaa.aa",
            "message"=> "a"        
            ];
        $request = new Request([], $post, [
            'REQUEST_METHOD'=>'POST',
            'REQUEST_URI'=>'/submit'
        ]);
        $response = $app->handle($request);
        $testo = $response->body();
        $parola = "Correggi";
        $controllo = str_contains($testo, $parola);
        $this->assertSame(true, $controllo);
    }   
    
    //CASI LIMITE

    public function testGetRitornoRequestUriVuoto(){
        $app = new App();
        $request = new Request([], [], [
            'REQUEST_METHOD'=>'GET',
            //REQUEST_URI vuoto
            'REQUEST_URI'=>''
        ]);
        $response = $app->handle($request);
        $status = $response->status();
        $this->assertSame(200, $status);
        $path = $request->path();
        $this->assertSame("/", $path);
    }  

    public function testGetRitornoRequestUriMancante(){
        $app = new App();
        $request = new Request([], [], [
            'REQUEST_METHOD'=>'GET',
            //REQUEST_URI mancante
        ]);
        $response = $app->handle($request);
        $status = $response->status();
        $this->assertSame(200, $status);
        $path = $request->path();
        $this->assertSame("/", $path);
    } 

    public function testGetRitornoRequestUriStrano(){
        $app = new App();
        $request = new Request([], [], [
            'REQUEST_METHOD'=>'GET',
            //REQUEST_URI strano
            'REQUEST_URI'=>'??x=11'
        ]);
        $response = $app->handle($request);
        $status = $response->status();
        $this->assertSame(200, $status);
        $path = $request->path();
        $this->assertSame("/", $path);
    }  
}