<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\User;
use App\Asistencia;
use Carbon\Carbon;

class AsistenciaDetalleExport implements FromCollection, WithMapping, WithHeadings
{
    
    private $mes;
    
    public function __construct($mes)
    {
        $this->mes = $mes;
    }
    

    public function headings(): array
    {
        return [
            'Usuario',
            'Jefe Directo',
            'Entrada',
            'Salida',
            'Descansos'
        ];
    }

    /**
    * @var Invoice $invoice
    */
    public function map($asistencia): array
    {
        return [
            $asistencia->user ? $asistencia->user->nombreCompleto(): '',
            ($asistencia->user && $asistencia->user->miJefe)? $asistencia->user->miJefe->nombreCompleto() : '',
            $asistencia->start_date,
            $asistencia->end_date,
            $this->recesos($asistencia->recesos),
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      /*
        $usuarios = User::orderBy('name')->get();
        $actual = Carbon::now();
        foreach( $usuarios as $usuario ) {
            $registros = Asistencia::where('user_id', $usuario->id)
                                   ->whereMonth('created_at', $this->mes)
                                   ->whereYear('created_at', $actual->year);
            
            $datos = $registros->get();
            $diasTrabajados = $datos->count();
            //$puntuales = $registros->whereTime('start_date','<=','09:16:00')->get();
            $trabajadas = 0;
            foreach($datos as $dato) {  
                $sr = $dato->trabajadas;
                $rr =  $dato->recesos->sum('descanso');
                $trabajadas += ($sr - $rr)/60;
            }
            
            $usuario->dias = $diasTrabajados;
            $usuario->trabajadas = ($trabajadas)? number_format($trabajadas, 2, '.', ',') : $trabajadas;
        }
      */
        $actual = Carbon::now();
        $registros = Asistencia::whereMonth('created_at',  $this->mes)
                             ->whereYear('created_at', $actual->year)
                             ->with('recesos', 'user')
                             ->orderBy('user_id', 'desc')
                             ->get();
        
        return $registros;
    }
  
  public function recesos($recesos) {
      $respuesta = "";
      foreach($recesos as $index => $receso ) {
          $respuesta = $respuesta."(".($index+1).") ".$receso->start_date."<->".$receso->end_date. ", ";
      }
      return $respuesta;
  }
  
  
}
