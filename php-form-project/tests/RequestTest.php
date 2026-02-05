<?php

use PHPUnit\Framework\TestCase;
use App\Http\Request;
use App\App;

class RequestTest extends TestCase{

    //METHOD()

    public function testMethodSenzaChiaveRequestMethod(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078'
        ]);

        $controllo = $request->method();
        $this->assertSame('GET', $controllo);
    }

    public function testMethodConChiaveRequestMethodGet(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'get'
        ]);

        $controllo = $request->method();
        $this->assertSame('GET', $controllo);
    }

    public function testMethodConChiaveRequestMethodPost(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'post'
        ]);

        $controllo = $request->method();
        $this->assertSame('POST', $controllo);
    }

    public function testMethodConChiaveRequestMethodMistoMaiuscoleMinuscole(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'bLaBlA'
        ]);

        $controllo = $request->method();
        $this->assertSame('BLABLA', $controllo);
    }

    //PATH()

    public function testPathConRequestUriEsistenteGet(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/'
        ]);

        $controllo = $request->path();
        $this->assertSame('/', $controllo);
    }

    public function testPathConRequestUriEsistenteGetConParametri(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/?x=1'
        ]);

        $controllo = $request->path();
        $this->assertSame('/', $controllo);
    }

    public function testPathConRequestUriEsistentePost(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/submit'
        ]);

        $controllo = $request->path();
        $this->assertSame('/submit', $controllo);
    }

    public function testPathConRequestUriEsistentePostConParametri(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/submit?x=1'
        ]);

        $controllo = $request->path();
        $this->assertSame('/submit', $controllo);
    }

    public function testPathFallimentoParse(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => 0                        
        ]);

        $controllo = $request->path();
        $this->assertSame('/', $controllo); 
    }

    //POST 

    public function testPostArrayNelCostruttore(){
        $request = new Request([], ["pincopallino", "pallinopinco"], []);

        $controllo = $request->post();
        $this->assertSame(["pincopallino", "pallinopinco"], $controllo); 
    }

}