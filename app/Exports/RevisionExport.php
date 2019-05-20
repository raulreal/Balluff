<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\User;
use App\Revision;
use Carbon\Carbon;

class RevisionExport implements FromCollection, WithMapping, WithHeadings
{
    
    private $revisionId;
    
    public function __construct($revisionId)
    {
        $this->revisionId = $revisionId;
    }
    

    public function headings(): array
    {
        return [
            'Usuario',
            'Jefe Directo',
            'Número revición',
            'Total objetivos individuales',
            'Total objetivos administrativos',
            'Total objetivos de cultura',
            'Evaluación Final'
        ];
    }

  
    /**
    * @var Invoice $invoice
    */
    public function map($revision): array
    {
        return [
            $revision->desenpeno->user->nombreCompleto(),
            ($revision->desenpeno->user->miJefe)? $revision->desenpeno->user->miJefe->nombreCompleto() : '',
            $revision->tipo,
            $revision->totalCSP,
            $revision->totalAdmon,
            $revision->totalCultura,
            $revision->total
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $registros = Revision::where('id',  $this->revisionId)->get();
        return $registros;
    }
  
  
}
