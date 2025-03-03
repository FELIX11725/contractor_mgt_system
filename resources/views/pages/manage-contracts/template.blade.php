<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        .contract-details { margin-bottom: 20px; }
        .contract-details p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Contract Agreement</h1>
    <div class="contract-details">
        <p><strong>Project:</strong> {{ $contract->project->project_name }}</p>
        <p><strong>Contractor:</strong> {{ $contract->contractor->first_name }} {{ $contract->contractor->last_name }}</p>
        <p><strong>Start Date:</strong> {{ $contract->start_date }}</p>
        <p><strong>End Date:</strong> {{ $contract->end_date }}</p>
        <p><strong>Contract Type:</strong> {{ $contract->contractType->name }}</p>
        <p><strong>Total Amount:</strong> ${{ number_format($contract->total_amount, 2) }}</p>
        <p><strong>Contract Status:</strong> {{ ucfirst($contract->contract_status) }}</p>
        <p><strong>Payment Terms:</strong> {{ $contract->payment_terms }}</p>
    </div>
    <div class="contract-body">
        <h2>Description</h2>
        <p>{!! $contract->description !!}</p>
    </div>
    <div class="signature-area">
        <p><strong>Contractor Signature:</strong> ___________________________</p>
        <p><strong>Date:</strong> ___________________________</p>
    </div>
</body>
</html>