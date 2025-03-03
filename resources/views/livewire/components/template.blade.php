<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Agreement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .header h2 {
            font-size: 18px;
            color: #555;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .section p {
            margin: 5px 0;
        }
        .signature-section {
            margin-top: 50px;
        }
        .signature-box {
            display: inline-block;
            width: 45%;
            margin-top: 20px;
        }
        .signature-box p {
            margin: 5px 0;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            width: 80%;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Contract Agreement</h1>
        <h2>Between {{ $contract->project->project_name }} and {{ $contract->contractor->first_name }} {{ $contract->contractor->last_name }}</h2>
    </div>

    <div class="section">
        <h3>1. Parties</h3>
        <p><strong>Project:</strong> {{ $contract->project->project_name }}</p>
        <p><strong>Contractor:</strong> {{ $contract->contractor->first_name }} {{ $contract->contractor->last_name }}</p>
    </div>

    <div class="section">
        <h3>2. Contract Details</h3>
        <p><strong>Contract Type:</strong> {{ $contract->contractType }}</p>
        <p><strong>Start Date:</strong> {{ $contract->start_date }}</p>
        <p><strong>End Date:</strong> {{ $contract->end_date }}</p>
        <p><strong>Total Amount:</strong> shs. {{ number_format($contract->total_amount, 0, '.', ',') }}</p>
    </div>

    <div class="section">
        <h3>3. Description of Work</h3>
        <p>{!! nl2br(e($contract->description)) !!}</p>
    </div>

    <div class="section">
        <h3>4. Terms and Conditions</h3>
        <p>The terms and conditions of this contract are as follows:</p>
        <ul>
            <li>The contractor agrees to complete the work as described in Section 3.</li>
            <li>The project agrees to pay the total amount specified in Section 2 upon satisfactory completion of the work.</li>
            <li>Any disputes arising from this contract will be resolved through mutual agreement or legal means.</li>
        </ul>
    </div>

    <div class="signature-section">
        <h3>5. Signatures</h3>
        <div class="signature-box">
            <p><strong>For {{ $contract->project->project_name }}:</strong></p>
            <p>Name: ___________________________</p>
            <p>Title: ___________________________</p>
            <p>Date: ___________________________</p>
            <div class="signature-line"></div>
        </div>

        <div class="signature-box">
            <p><strong>For {{ $contract->contractor->first_name }} {{ $contract->contractor->last_name }}:</strong></p>
            <p>Name: ___________________________</p>
            <p>Title: ___________________________</p>
            <p>Date: ___________________________</p>
            <div class="signature-line"></div>
        </div>
    </div>
</body>
</html>