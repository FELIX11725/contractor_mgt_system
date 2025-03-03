<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        li {
            margin-bottom: 5px;
        }
        .budget-item {
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Budget Report for {{ $currentProject->project_name }}</h1>

    @forelse ($budgetData as $milestone => $items)
        <h2> {{ $milestone }}</h2>
        <ul>
            @foreach ($items as $item)
                <li class="budget-item">
                    {{ $item->expense_item }} - shs. {{ number_format($item->estimated_amount, 0, '.', ',') }}
                </li>
            @endforeach
        </ul>
    @empty
        <p>No budget data found.</p>
    @endforelse

    <div class="footer">
        Generated on {{ now()->format('Y-m-d H:i:s') }}
    </div>
</body>
</html>