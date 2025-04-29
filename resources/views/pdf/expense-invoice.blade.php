<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Invoice #{{ $invoiceNumber }}</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #dbeafe;
            --text-color: #374151;
            --text-light: #6b7280;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --background-color: #ffffff;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'DejaVu Sans', Helvetica, Arial, sans-serif;
            line-height: 1.5;
            color: var(--text-color);
            background-color: #f9fafb;
            padding: 40px 0;
        }

        .invoice-container {
            max-width: 850px;
            margin: 0 auto;
        }

        .invoice-box {
            background-color: var(--background-color);
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .invoice-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .header-left {
            display: flex;
            flex-direction: column;
        }

        .company-logo {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
            margin: 16px 0 8px;
        }

        .invoice-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
            text-align: right;
        }

        .invoice-number, .invoice-date {
            font-size: 14px;
            color: var(--text-light);
        }

        .invoice-number span, .invoice-date span {
            font-weight: 600;
            color: var(--text-color);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }

        .expense-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 6px;
        }

        .expense-details h3 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-light);
            margin-bottom: 12px;
        }

        .detail-group {
            margin-bottom: 16px;
        }

        .detail-label {
            font-size: 13px;
            color: var(--text-light);
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 15px;
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }

        th {
            background-color: #f3f4f6;
            font-weight: 600;
            text-align: left;
            padding: 12px 15px;
            font-size: 14px;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .item-name {
            font-weight: 500;
        }

        .item-description {
            font-size: 14px;
            color: var(--text-light);
            margin-top: 4px;
        }

        .amount-col {
            text-align: right;
            font-weight: 600;
        }

        .totals-table {
            width: 35%;
            margin-left: auto;
        }

        .totals-table td {
            padding: 8px 0;
            border: none;
        }

        .totals-table .total-label {
            color: var(--text-light);
        }

        .totals-table .total-value {
            text-align: right;
            font-weight: 500;
        }

        .grand-total .total-label {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
        }

        .grand-total .total-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
            font-size: 14px;
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .payment-instructions {
            background-color: var(--accent-color);
            border-radius: 6px;
            padding: 15px 20px;
            margin: 20px 0;
        }

        .payment-instructions h3 {
            color: var(--secondary-color);
            font-size: 15px;
            margin-bottom: 8px;
        }

        .approved-by {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .approved-by svg {
            width: 18px;
            height: 18px;
            color: var(--success-color);
        }

        @media print {
            body {
                padding: 0;
                background-color: #fff;
            }
            
            .invoice-box {
                box-shadow: none;
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .invoice-box {
                padding: 25px;
            }
            
            .header {
                flex-direction: column;
                gap: 20px;
            }
            
            .invoice-details {
                text-align: left;
            }
            
            .expense-details {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .totals-table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-box">
            <div class="header">
                <div class="header-left">
                    
                    <div class="invoice-title">Expense Invoice</div>
                </div>
                <div class="invoice-details">
                    <div class="invoice-number">Invoice Number: <span>#{{ $invoiceNumber }}</span></div>
                    <div class="invoice-date">Date: <span>{{ $date }}</span></div>
                    <div class="status-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline; margin-right:4px; vertical-align:middle;">
                            <path d="M20 6L9 17l-5-5"></path>
                        </svg>
                        Approved
                    </div>
                </div>
            </div>

            <div class="expense-details">
                <div class="expense-info">
                    <h3>Expense Information</h3>
                    <div class="detail-group">
                        <div class="detail-label">Description</div>
                        <div class="detail-value">{{ $expense->description }}</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Category</div>
                        <div class="detail-value">{{ $expense->category->name }}</div>
                    </div>
                    @if($expense->transaction_id)
                    <div class="detail-group">
                        <div class="detail-label">Transaction ID</div>
                        <div class="detail-value">{{ $expense->transaction_id }}</div>
                    </div>
                    @endif
                </div>
                <div class="payment-info">
                    <h3>Payment Information</h3>
                    <div class="detail-group">
                        <div class="detail-label">Payment Date</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($expense->date_of_pay)->format('M d, Y') }}</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Status</div>
                        <div class="detail-value approved-by">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                            Approved by {{ $expense->approvals->first()->user->name ?? 'System' }}
                        </div>
                    </div>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Item Details</th>
                        <th style="text-align: right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="item-name">{{ $expense->category->name }}</div>
                            <div class="item-description">{{ $expense->description }}</div>
                        </td>
                        <td class="amount-col">${{ number_format($expense->amount_paid, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="totals-table">
                <tr>
                    <td class="total-label">Subtotal</td>
                    <td class="total-value">${{ number_format($expense->amount_paid, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="total-label">Total</td>
                    <td class="total-value">${{ number_format($expense->amount_paid, 2) }}</td>
                </tr>
            </table>

            <div class="payment-instructions">
                <h3>Payment Information</h3>
                <p>This expense has been approved and processed on {{ \Carbon\Carbon::parse($expense->date_of_pay)->format('F d, Y') }}.</p>
            </div>

            <div class="footer">
                <p>Thank you for your business</p>
                <p>This is an automatically generated invoice for approved expenses</p>
                <p>© {{ date('Y') }} Your Company. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>