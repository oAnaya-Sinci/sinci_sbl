<?php

namespace App\Exports;

use App\Trends;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class TrendsExport implements FromCollection,WithHeadings,WithStyles,WithTitle,ShouldAutoSize, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Fecha',
            'Valor',
            'Limite Superior',
            'Limite Inferior'
        ];

    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:D1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

    public function datos(string $caso,string $date, int $idvar, string $nomvar)
    {
        $this->date = $date;
        $this->idvar = $idvar;
        $this->nomvar = $nomvar;
        $this->title = $nomvar." ".$date;
        $this->caso = $caso;
        return $this;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function collection()
    {

      return  collect(DB::select("call ConsultaTrends(?,?,?)",array($this->caso,$this->idvar, $this->date)));
          

    }
}
