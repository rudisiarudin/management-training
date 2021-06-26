<?php

namespace App\Exports;

use App\Models\TrainingSchedule;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TrainingScheduleExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return TrainingSchedule::find($this->id)->registrations->map(function ($item, $index) {
           return [
               $index + 1,
               $item->participant->name,
               '',
               $item->participant->companies->name,
               $item->participant->companies->address,
               $item->participant->companies->phone,
               $item->participant->companies->email,
               $item->participant->title,
               '',
               $item->trainingSchedule->created_at,
               $item->trainingSchedule->location,
               'Trainers Management Indonesia',
           ];
       });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'NO.',
            'NAMA',
            'TEMPAT TANGGAL LAHIR',
            'NAMA PERUSAHAAN',
            'ALAMAT PERUSAHAAN',
            'TELP',
            'EMAIL',
            'JABATAN',
            'PENDIDIKAN',
            'WAKTU PEMBINAAN',
            'TEMPAT PEMBINAAN',
            'PENYELENGGARA'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:L1')->applyFromArray([
                    'font' => ['bold' => true]
                ]);

                $event->sheet->getDelegate()->getStyle('A:L')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A:L')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A:L')->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20, 'px');
            }
        ];
    }
}
