<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Budget Details - {{ $budget->budget_name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 10px;
        }
        .project-title {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
        }
        .budget-title {
            font-size: 16px;
            color: #1e40af;
        }
        .report-date {
            font-size: 12px;
            color: #6b7280;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 8px;
            border: 1px solid #e5e7eb;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table th {
            background-color: #3b82f6;
            color: white;
            text-align: left;
            padding: 8px;
            font-weight: bold;
        }
        .table td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        .table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .total-row {
            font-weight: bold;
            background-color: #e5e7eb !important;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="project-title">{{ $budget->phase->project->project_name }}</div>
        <div class="budget-title">{{ $budget->budget_name }}</div>
        <div class="report-date">Generated on {{ now()->format('Y-m-d H:i:s') }}</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="20%"><strong>Project:</strong></td>
            <td>{{ $budget->phase->project->project_name }}</td>
        </tr>
        <tr>
            <td><strong>Phase:</strong></td>
            <td>{{ $budget->phase->name }}</td>
        </tr>
        @if($budget->description)
        <tr>
            <td><strong>Description:</strong></td>
            <td>{{ $budget->description }}</td>
        </tr>
        @endif
    </table>

    <h3>Budget Items</h3>
    <table class="table">
        <thead>
            <tr>
                <th width="40%">Item</th>
                <th width="10%">Quantity</th>
                <th width="15%">Rate</th>
                <th width="15%">Estimated Amount</th>
                {{-- <th width="20%">Total Spent</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($budgetItems as $item)
            <tr>
                <td>{{ $item->expenseCategoryItem->name ?? 'N/A' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->rate, 2) }}</td>
                <td>{{ number_format($item->estimated_amount, 2) }}</td>
                {{-- <td>{{ number_format($item->approved_expenses_sum_amount_paid ?? 0, 2) }}</td> --}}
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>{{ number_format($budgetItems->sum('estimated_amount'), 2) }}</strong></td>
                {{-- <td><strong>{{ number_format($budgetItems->sum('approved_expenses_sum_amount_paid'), 2) }}</strong></td> --}}
            </tr>
        </tbody>
    </table>

    <div class="footer">
        {{ config('app.name') }} | {{ now()->format('F j, Y') }}
    </div>
</body>
</html>