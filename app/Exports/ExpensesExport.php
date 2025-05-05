<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class ExpensesExport implements 
    FromCollection, 
    WithMapping, 
    WithHeadings, 
    WithStyles, 
    ShouldAutoSize, 
    WithColumnFormatting,
    WithCustomStartCell,
    WithTitle,
    WithEvents
{
    protected $expenses;
    protected $startDate;
    protected $endDate;
    protected $totalAmount = 0;
    protected $rowCount;
    protected $categorySummary = [];

    public function __construct($expenses, $startDate = null, $endDate = null)
    {
        $this->expenses = $expenses;
        $this->startDate = $startDate ? Carbon::parse($startDate)->format('Y-m-d') : null;
        $this->endDate = $endDate ? Carbon::parse($endDate)->format('Y-m-d') : null;
        
        // Calculate total amount and category summary
        foreach ($expenses as $expense) {
            $this->totalAmount += $expense->amount_paid;
            
            $categoryName = $expense->category->name;
            if (!isset($this->categorySummary[$categoryName])) {
                $this->categorySummary[$categoryName] = 0;
            }
            $this->categorySummary[$categoryName] += $expense->amount_paid;
        }
    }

    /**
     * Define the start cell for the export
     */
    public function startCell(): string
    {
        return 'A6';
    }

    /**
     * Get expenses data
     */
    public function collection()
    {
        return $this->expenses;
    }

    /**
     * Set the title of the worksheet
     */
    public function title(): string
    {
        return 'Expenses Report';
    }

    /**
     * Define column headers
     */
    public function headings(): array
    {
        return [
            'Expense Category',
            'Description',
            'Amount',
            'Date',
            'Payment Method',
            'Approved By',
            'Status',
        ];
    }

    /**
     * Map expenses data to columns
     */
    public function map($expense): array
    {
        return [
            $expense->category->name,
            $expense->description,
            $expense->amount_paid,
            $expense->date_of_pay,
            $expense->payment_method ?? 'N/A',
            $expense->approved_by ?? 'Pending',
            $expense->status ?? 'Pending',
        ];
    }

    /**
     * Define column formats
     */
    public function columnFormats(): array
{
    return [
        'C' => '"shs."#,##0.00_-', // Standard USD currency format
        'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    ];
}

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Count rows for styling
        $this->rowCount = $sheet->getHighestDataRow();
        
        return [
            // Headers styling
            6 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2F5597'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            
            // Data rows styling
            'A7:G' . $this->rowCount => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'],
                    ],
                ],
            ],
            
            // Amount column specific styling
            'C7:C' . $this->rowCount => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ],
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }

    /**
     * Register events for additional styling and content
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $this->rowCount;
                $summaryStartRow = $lastRow + 3;
                
                // Company name and report title
                $sheet->setCellValue('A1', config('app.name', 'Company Name'));
                $sheet->setCellValue('A2', 'EXPENSES REPORT');
                
                // Date range
                $dateRange = 'All Time';
                if ($this->startDate && $this->endDate) {
                    $dateRange = "From {$this->startDate} To {$this->endDate}";
                } elseif ($this->startDate) {
                    $dateRange = "From {$this->startDate}";
                } elseif ($this->endDate) {
                    $dateRange = "To {$this->endDate}";
                }
                $sheet->setCellValue('A3', $dateRange);
                
                // Generated date and total records
                $sheet->setCellValue('A4', 'Generated: ' . now()->format('Y-m-d H:i:s') . 
                                         ' | Total Records: ' . count($this->expenses));
                
                // Style the headers
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->setColor(new Color('2F5597'));
                $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A3')->getFont()->setItalic(true);
                $sheet->getStyle('A4')->getFont()->setItalic(true)->setSize(9);
                
                // Merge cells for headers
                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('A3:G3');
                $sheet->mergeCells('A4:G4');
                
                // Center align headers
                $sheet->getStyle('A1:A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                // Set row height for the header row
                $sheet->getRowDimension(6)->setRowHeight(20);
                
                // Add summary section title
                $sheet->setCellValue('A' . $summaryStartRow, 'SUMMARY');
                $sheet->getStyle('A' . $summaryStartRow)->getFont()->setBold(true)->setSize(12);
                $sheet->mergeCells('A' . $summaryStartRow . ':G' . $summaryStartRow);
                $sheet->getStyle('A' . $summaryStartRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A' . $summaryStartRow)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->setStartColor(new Color('D9E1F2'));
                
                // Add category summary
                $sheet->setCellValue('A' . ($summaryStartRow + 1), 'Category');
                $sheet->setCellValue('B' . ($summaryStartRow + 1), 'Amount');
                $sheet->getStyle('A' . ($summaryStartRow + 1) . ':B' . ($summaryStartRow + 1))->getFont()->setBold(true);
                $sheet->getStyle('A' . ($summaryStartRow + 1) . ':B' . ($summaryStartRow + 1))->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->setStartColor(new Color('E2EFDA'));
                
                $row = $summaryStartRow + 2;
                foreach ($this->categorySummary as $category => $amount) {
                    $sheet->setCellValue('A' . $row, $category);
                    $sheet->setCellValue('B' . $row, $amount);
                    $sheet->getStyle('B' . $row)->getNumberFormat()->setFormatCode('"shs."#,##0.00_-');
                    $row++;
                }
                
                // Add total row
                $sheet->setCellValue('A' . $row, 'TOTAL');
                $sheet->setCellValue('B' . $row, $this->totalAmount);
                $sheet->getStyle('A' . $row . ':B' . $row)->getFont()->setBold(true);
                $sheet->getStyle('B' . $row)->getNumberFormat()->setFormatCode('"shs."#,##0.00_-');
                $sheet->getStyle('A' . $row . ':B' . $row)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->setStartColor(new Color('C6E0B4'));
                
                // Style the summary section
                $sheet->getStyle('A' . ($summaryStartRow + 1) . ':B' . $row)->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
                
                // Freeze panes
                $sheet->freezePane('A7');
                
                // Enable auto-filter
                $sheet->setAutoFilter('A6:G' . $lastRow);
                
                // Zebra striping for main data
                for ($i = 7; $i <= $lastRow; $i++) {
                    if ($i % 2 == 0) {
                        $sheet->getStyle('A' . $i . ':G' . $i)->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->setStartColor(new Color('F5F5F5'));
                    }
                }
                
                // Conditional formatting for status column
                for ($i = 7; $i <= $lastRow; $i++) {
                    $status = $sheet->getCell('G' . $i)->getValue();
                    
                    if (strcasecmp($status, 'Approved') === 0) {
                        $sheet->getStyle('G' . $i)->getFont()->setColor(new Color('008000')); // Green
                    } elseif (strcasecmp($status, 'Pending') === 0) {
                        $sheet->getStyle('G' . $i)->getFont()->setColor(new Color('FFA500')); // Orange
                    } elseif (strcasecmp($status, 'Rejected') === 0) {
                        $sheet->getStyle('G' . $i)->getFont()->setColor(new Color('FF0000')); // Red
                    }
                }
                
                // Set column widths
                $sheet->getColumnDimension('A')->setWidth(20); // Category
                $sheet->getColumnDimension('B')->setWidth(40); // Description
                $sheet->getColumnDimension('C')->setWidth(15); // Amount
                $sheet->getColumnDimension('D')->setWidth(12); // Date
                $sheet->getColumnDimension('E')->setWidth(15); // Payment Method
                $sheet->getColumnDimension('F')->setWidth(15); // Approved By
                $sheet->getColumnDimension('G')->setWidth(12); // Status
                
                // Make text wrap in description column
                $sheet->getStyle('B7:B' . $lastRow)
                    ->getAlignment()
                    ->setWrapText(true);
            },
        ];
    }
}