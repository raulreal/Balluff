<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\User;
use App\Asistencia;
use Carbon\Carbon;

class AsistenciaExport implements FromCollection, WithMapping, WithHeadings
{
    
    //private $fecha;
    
    public function __construct()
    {
        //$this->fecha = $fecha;
    }
    
    public function headings(): array
    {
        return [
            'Colaborador',
            'Departamento',
            'Puesto',
            'Días trabajados',
            'Horas trabajadas'
        ];
    }
    
    /**
    * @var Invoice $invoice
    */
    public function map($user): array
    {
        return [
            $user->nombreCompleto(),
            ($user->departamento)? $user->departamento->nombre : "",
            $user->puesto,
            $user->dias,
            $user->trabajadas,
        ];
    }
  
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $usuarios = User::orderBy('name')->get();
        $actual = Carbon::now();
        
        foreach( $usuarios as $usuario ) {
            $registros = Asistencia::where('user_id', $usuario->id)
                                   ->whereMonth('created_at', $actual->month);
            
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
            $usuario->trabajadas = $trabajadas;
        }
        
        return $usuarios;
        
        
    }
}
