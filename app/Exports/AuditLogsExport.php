<?php

namespace App\Exports;

use App\Models\AuditLog;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
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

class AuditLogsExport implements 
    FromQuery, 
    WithHeadings, 
    WithMapping, 
    ShouldAutoSize, 
    WithStyles, 
    WithColumnFormatting, 
    WithCustomStartCell,
    WithTitle,
    WithEvents
{
    protected $query;
    protected $rowCount;
    protected $startDate;
    protected $endDate;

    public function __construct($query, $startDate = null, $endDate = null)
    {
        $this->query = $query;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return $this->query;
    }

    /**
     * Define the start cell for the export
     */
    public function startCell(): string
    {
        return 'A3';
    }

    /**
     * Set the title of the worksheet
     */
    public function title(): string
    {
        return 'Audit Logs';
    }

    /**
     * Define the columns and their human-readable headers
     */
    public function headings(): array
    {
        return [
            'Date',
            'Time',
            'User',
            'IP Address',
            'Action',
            'Description',
            
        ];
    }

    /**
     * Map database records to spreadsheet rows
     */
    public function map($log): array
    {
        return [
            $log->created_at->format('Y-m-d'),
            $log->created_at->format('H:i:s'),
            $log->user?->name ?? 'System',
            $log->ip_address ?? 'N/A',
            ucfirst($log->action),
            $log->description,
        ];
    }

    /**
     * Define the column formatting
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'B' => NumberFormat::FORMAT_DATE_TIME3,
        ];
    }

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Count the total number of rows for styling
        $this->rowCount = $sheet->getHighestDataRow();
        
        return [
            // Title styling (will be handled in registerEvents)
            
            // Headers styling
            3 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4'],
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
            
            // Content rows styling
            'A4:H' . $this->rowCount => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Register events to further customize the worksheet
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Add title and date range
                $title = 'Audit Logs Report';
                $subtitle = '';
                
                if ($this->startDate && $this->endDate) {
                    $subtitle = "Date Range: {$this->startDate} - {$this->endDate}";
                } elseif ($this->startDate) {
                    $subtitle = "From: {$this->startDate}";
                } elseif ($this->endDate) {
                    $subtitle = "To: {$this->endDate}";
                }
                
                $sheet->setCellValue('A1', $title);
                $sheet->setCellValue('A2', $subtitle);
                
                // Style the title
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->setColor(new Color('4472C4'));
                $sheet->getStyle('A2')->getFont()->setItalic(true);
                
                // Merge cells for the title
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                
                // Set row height for header
                $sheet->getRowDimension(3)->setRowHeight(20);
                
                // Freeze panes for easier navigation
                $sheet->freezePane('A4');
                
                // Auto-filter to allow filtering
                $sheet->setAutoFilter('A3:H' . $this->rowCount);
                
                // Zebra striping for better readability
                for ($row = 4; $row <= $this->rowCount; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle('A' . $row . ':H' . $row)->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->setStartColor(new Color('F5F5F5'));
                    }
                }
                
                // Set column widths for better readability
                $sheet->getColumnDimension('A')->setWidth(12); // Date
                $sheet->getColumnDimension('B')->setWidth(10); // Time
                $sheet->getColumnDimension('C')->setWidth(20); // User
                $sheet->getColumnDimension('D')->setWidth(15); // IP Address
                $sheet->getColumnDimension('E')->setWidth(15); // Action
                $sheet->getColumnDimension('F')->setWidth(40); // Description
                $sheet->getColumnDimension('G')->setWidth(30); // Old Values
                $sheet->getColumnDimension('H')->setWidth(30); // New Values
                
                // Make sure text wrapping is enabled for description and values
                $sheet->getStyle('F4:H' . $this->rowCount)
                    ->getAlignment()
                    ->setWrapText(true);
                
                // Conditional formatting for different action types
                $lastRow = $this->rowCount;
                
                // Highlight "create" actions in green
                $sheet->getStyle('E4:E' . $lastRow)
                    ->getFont()
                    ->setBold(true);
                
                // Apply conditional formatting based on action type
                for ($row = 4; $row <= $lastRow; $row++) {
                    $action = $sheet->getCell('E' . $row)->getValue();
                    
                    if (strcasecmp($action, 'Create') === 0) {
                        $sheet->getStyle('E' . $row)->getFont()->setColor(new Color('008000')); // Green
                    } elseif (strcasecmp($action, 'Update') === 0) {
                        $sheet->getStyle('E' . $row)->getFont()->setColor(new Color('FFA500')); // Orange
                    } elseif (strcasecmp($action, 'Delete') === 0) {
                        $sheet->getStyle('E' . $row)->getFont()->setColor(new Color('FF0000')); // Red
                    } elseif (strcasecmp($action, 'Login') === 0) {
                        $sheet->getStyle('E' . $row)->getFont()->setColor(new Color('0000FF')); // Blue
                    }
                }
            },
        ];
    }
}