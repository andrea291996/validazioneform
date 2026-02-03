<?php

use PHPUnit\Framework\TestCase;
use App\Http\Request;


class RequestTest extends TestCase{

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
            'REQUEST_METHOD' => 'GET'
        ]);

        $controllo = $request->method();
        $this->assertSame('GET', $controllo);
    }

    public function testMethodConChiaveRequestMethodPost(){
        $request = new Request([], [], [
            'BLABLA' => '::1',
            'BLABLABLA' => '55078',
            'REQUEST_METHOD' => 'POST'
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

}