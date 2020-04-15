<?php

namespace App\Exports;

use App\CommandError;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Pipeline\Pipeline;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CommandErrorExport implements FromCollection, Responsable, ShouldAutoSize, WithCustomStartCell, WithMapping, WithHeadings, WithColumnFormatting, WithStrictNullComparison
{
    use Exportable;

    private $fileName = 'email.xls';
    private $writerType = Excel::XLS;
    private $field;
    private $year;

    public function __construct(int $year = null)
    {
        $this->year = $year;
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function headings(): array
    {
        return [
            'ID',
            'COMMAND',
            'ID_ERROR',
            'CREATED',
            'UPDATED',
            'TIME_DAY',
        ];
    }

    public function map($commandError): array
    {
        return [
            $commandError->id,
            $commandError->command,
            $commandError->error_id,
            Date::dateTimeToExcel($commandError->created_at),
            Date::dateTimeToExcel($commandError->updated_at),
            $commandError->updated_at->diffInDays($commandError->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'E' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }

    public function collection()
    {
        return app(Pipeline::class)
            ->send(CommandError::query())
            ->through([
                new \App\QueryFilters\Year('created_at', $this->year),
            ])
            ->thenReturn()
            ->get();
    }
}
