<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;

class GraficaController extends Controller
{

    public function index()
    {

//Grafica puntualidad

$puntualidad = \Lava::DataTable();

$puntualidad->addStringColumn('Reasons')
        ->addNumberColumn('Percent')
        ->addRow(['Inicio Puntual', 86])
        ->addRow(['Retraso Menor a 10min.', 9])
        ->addRow(['Retraso mayor a 10 min.', 5]);


Lava::DonutChart('PE', $puntualidad, [
    'title' => 'Porcentaje de puntualidad en el periodo',
     'is3D'   => false,
     'colors'=> [ '#b1d3e6', '#d7e8f3','#333333',],
      'fontName'          => 'helvetica',
       'height'            => 400,
]);
      
      
//Grafica asistencia
      
      $finances = Lava::DataTable();

$finances->addDateColumn('Fecha')
         ->addNumberColumn('Horas Trabajadas')
         ->addRow(['01-11-2018', 7.5])
         ->addRow(['02-11-2018', 7.1])
         ->addRow(['03-11-2018', 6.89])
         ->addRow(['04-11-2018', 6.99])
         ->addRow(['05-11-2018', 7.8])
         ->addRow(['06-11-2018', 7.1])
         ->addRow(['07-11-2018', 6.89])
         ->addRow(['08-11-2018', 6.99])
           ->addRow(['09-11-2018', 7.5])
         ->addRow(['10-11-2018', 6.1])
         ->addRow(['11-11-2018', 6.89])
         ->addRow(['12-11-2018', 6.99])
         ->addRow(['13-11-2018', 7.5])
         ->addRow(['14-11-2018', 7.1])
         ->addRow(['15-11-2018', 6.5])
         ->addRow(['16-11-2018', 6.99])
           ->addRow(['17-11-2018', 7.5])
         ->addRow(['18-11-2018', 7.1])
         ->addRow(['19-11-2018', 6.89])
         ->addRow(['20-11-2018', 6.1])
         ->addRow(['21-11-2018', 5.5])
         ->addRow(['22-11-2018', 7.1])
         ->addRow(['23-11-2018', 6.89])
         ->addRow(['24-11-2018', 5.99] );


Lava::ColumnChart('Finances', $finances, [
    'title' => 'Horas Trabajadas en el periodo',
    'colors'=> [ '#b5bcbd', '#d7e8f3','#333333',],
    'height'            => 400,
  
   
]);
      
//Grafica inasistencias

$asistencia = \Lava::DataTable();

$asistencia ->addStringColumn('Asistencias')
        ->addNumberColumn('Inasistencias')
        ->addRow(['Asistencias', 24])
        ->addRow(['Inasistencias', 1]);


Lava::DonutChart('AP', $asistencia, [
    'title' => 'Porcentaje de Asistencias en el periodo',
     'is3D'   => false,
     'colors'=> [ '#b1d3e6','#333333',],
      'fontName'          => 'helvetica',
       'height'            => 400,
]);

        
        return view('graficas', compact('puntualidad','finances','asistencia') );
    }
}
