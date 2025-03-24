<?php

namespace App\Exports;

use App\Models\Expense;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpensesExport implements FromCollection, WithMapping, WithHeadings
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
            $expense->amount_paid,
            $expense->date_of_pay,
        ];
    }
}
