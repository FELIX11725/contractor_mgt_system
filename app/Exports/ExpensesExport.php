<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExpensesExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    protected $expenses;

    public function __construct($expenses)
    {
        $this->expenses = $expenses;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Expense::all();
    }

    public function headings(): array
    {
        return [
            'Expense Item',
            'Narration',
            'Amount',
            'Date',
        ];
    }

    public function map($expense): array
    {
        return [
            $expense->category->name, // Assuming a relationship between Expense and ExpenseCategoryItem
            $expense->description,
            number_format($expense->amount_paid, 2), // Format amount for better readability
            $expense->date_of_pay,
        ];
    }

    // Apply styles to headers
    public function styles(Worksheet $sheet)
    {
        // Make headers bold
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // Add a title at the top
        $sheet->mergeCells('A1:D1'); // Merge cells for title
        $sheet->setCellValue('A1', 'Expenses Report'); // Set title text
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14); // Style title
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center'); // Center title

        // Add report generation date
        $sheet->mergeCells('A2:D2');
        $sheet->setCellValue('A2', 'Generated on: ' . now()->format('Y-m-d'));
        $sheet->getStyle('A2')->getFont()->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
    }

    // Set sheet title
    public function title(): string
    {
        return 'Expenses Report';
    }
}
