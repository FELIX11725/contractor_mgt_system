<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expense Invoice #{{ $invoiceNumber }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h1>Expense Invoice</h1>
            <p>Invoice #{{ $invoiceNumber }} | Date: {{ $date }}</p>
        </div>
        
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>Description:</strong> {{ $expense->description }}<br>
                                <strong>Category:</strong> {{ $expense->category->name }}<br>
                                @if($expense->transaction_id)
                                <strong>Transaction ID:</strong> {{ $expense->transaction_id }}<br>
                                @endif
                            </td>
                            <td>
                                <strong>Date:</strong> {{ \Carbon\Carbon::parse($expense->date_of_pay)->format('M d, Y') }}<br>
                                <strong>Status:</strong> Approved<br>
                                <strong>Approved By:</strong> {{ $expense->approvals->first()->user->name ?? 'System' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>Item</td>
                <td>Amount</td>
            </tr>
            
            <tr class="item">
                <td>{{ $expense->category->name }}</td>
                <td>${{ number_format($expense->amount_paid, 2) }}</td>
            </tr>
            
            <tr class="total">
                <td></td>
                <td>Total: ${{ number_format($expense->amount_paid, 2) }}</td>
            </tr>
        </table>
        
        <div class="footer">
            <p>Thank you for your business</p>
            <p>This is an automatically generated invoice for approved expenses</p>
        </div>
    </div>
</body>
</html>