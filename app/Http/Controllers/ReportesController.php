<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper; 
use DB;
use Session;

class ReportesController extends Controller
{
    
    public function ver_reporte_hola_mundo(){

        $input = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world.jrxml';
        $inputCompiled = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world.jasper';
        $output = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world_'.date("Ymd")."_".date("his");

        if (!file_exists( $inputCompiled)) {
            $jasper = new PHPJasper;
            $jasper->compile($input)->execute();
        }

        $options = [
            'format' => ['pdf']
        ];

        $jasper = new PHPJasper;
    
        $jasper->process(
            $inputCompiled,
            $output,
            $options
        )->execute();
    
        //$pathToFile = base_path() .
        //'/vendor/geekcom/phpjasper/examples/hello_world.pdf';

        return response()->file($output.'.pdf');

        //return response()->download( $output.'.pdf' );  

    }

    public function ver_reporte_hola_mundo_parametros() {
        $input = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world_params.jrxml';
        $inputCompiled = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world_params.jasper';
        $output = base_path() .
        '/vendor/geekcom/phpjasper/examples';
        $options = [
            'format' => ['pdf'],
            'params' => [
                'myInt' => 7,
                'myDate' => date('y-m-d'),
                'myImage' => base_path() .
                '/vendor/geekcom/phpjasper/examples/jasperreports_logo.png',
                'myString' => 'Hola Mundo!'
            ]
        ];
    
        $jasper = new PHPJasper;
    
        $jasper->process(
            $inputCompiled,
            $output,
            $options
        )->execute();
    
        $pathToFile = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world_params.pdf';
        return response()->file($pathToFile);
    }

}
