<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt {{ $receipt->receipt_number }}</title>
    <style>
        @page {
            margin: 0;
        }
        
        /* Base Styles */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #fff;
            font-size: 14px;
            line-height: 1.6;
        }
        
        /* Main Container */
        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            background-color: #fff;
        }
        
        /* Receipt Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.03);
            font-weight: bold;
            z-index: 0;
            white-space: nowrap;
        }
        
        /* Receipt Header */
        .receipt-header {
            position: relative;
            background: linear-gradient(135deg, #3751FF 0%, #2A3AFF 100%);
            color: white;
            padding: 30px;
            border-bottom: 5px solid #1F2B9B;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .receipt-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 1px;
            margin: 0;
            text-transform: uppercase;
        }
        
        .receipt-subtitle {
            font-size: 14px;
            font-weight: normal;
            opacity: 0.8;
            margin-top: 5px;
        }
        
        .receipt-number {
            font-size: 16px;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 50px;
            letter-spacing: 1px;
        }
        
        /* Design Elements */
        .receipt-dots {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 150px;
            overflow: hidden;
            opacity: 0.1;
            z-index: 1;
        }
        
        .receipt-dots::before {
            content: "";
            position: absolute;
            top: -50px;
            left: -50px;
            right: -50px;
            bottom: -50px;
            background-image: radial-gradient(#fff 2px, transparent 2px);
            background-size: 15px 15px;
        }
        
        /* Receipt Body */
        .receipt-body {
            padding: 30px;
            position: relative;
            z-index: 1;
        }
        
        /* Company and Client Info */
        .company-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #e0e0e0;
        }
        
        .company-info h2 {
            font-size: 18px;
            margin: 0 0 5px 0;
            color: #3751FF;
        }
        
        .company-info p {
            margin: 0;
            line-height: 1.5;
            color: #666;
        }
        
        .receipt-date {
            text-align: right;
        }
        
        .receipt-date .date-label {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 12px;
            text-transform: uppercase;
            color: #777;
        }
        
        .receipt-date .date-value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            background-color: #f8f9fa;
            padding: 8px 15px;
            border-radius: 4px;
            border-left: 3px solid #3751FF;
        }
        
        /* Receipt Details */
        .receipt-details {
            margin-bottom: 30px;
            background-color: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }
        
        .detail-header {
            background-color: #3751FF;
            color: white;
            padding: 12px 15px;
            font-weight: bold;
            font-size: 16px;
        }
        
        .detail-row {
            display: flex;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            flex: 1;
            padding: 12px 15px;
            font-weight: bold;
            background-color: rgba(55, 81, 255, 0.05);
            border-right: 1px solid #e9ecef;
        }
        
        .detail-value {
            flex: 2;
            padding: 12px 15px;
        }
        
        /* Amount Styling */
        .amount-row .detail-value {
            font-weight: bold;
            color: #3751FF;
            font-size: 18px;
        }
        
        /* Receipt Image */
        .receipt-image {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        
        .receipt-image h4 {
            margin: 0 0 10px 0;
            color: #3751FF;
            font-size: 16px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .receipt-image img {
            max-width: 100%;
            height: auto;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        /* Signature Section */
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            flex: 1;
            margin-right: 20px;
        }
        
        .signature-box:last-child {
            margin-right: 0;
        }
        
        .signature-line {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 5px;
            height: 30px;
        }
        
        .signature-label {
            font-size: 12px;
            color: #777;
        }
        
        /* Footer */
        .receipt-footer {
            margin-top: 40px;
            padding: 20px 30px;
            background-color: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-size: 12px;
            color: #777;
            position: relative;
        }
        
        .footer-note {
            margin-bottom: 10px;
        }
        
        /* Thank You Message */
        .thank-you-message {
            font-size: 18px;
            font-weight: bold;
            color: #3751FF;
            text-align: center;
            margin: 30px 0;
        }
        
        /* Barcode Section */
        .barcode-section {
            text-align: center;
            margin: 20px 0;
        }
        
        .barcode {
            background-image: linear-gradient(90deg, #000 2px, transparent 2px), linear-gradient(90deg, #000 1px, transparent 1px);
            background-size: 6px 100%, 2px 100%;
            background-repeat: space;
            height: 40px;
            width: 200px;
            margin: 0 auto;
            display: inline-block;
        }
        
        .barcode-number {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }
        
        /* Stamps and Marks */
        .paid-stamp {
            position: absolute;
            top: 80px;
            right: 40px;
            transform: rotate(20deg);
            border: 2px solid #28a745;
            color: #28a745;
            font-size: 24px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            opacity: 0.7;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        /* QR Code Placeholder */
        .qr-code {
            width: 70px;
            height: 70px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            padding: 5px;
            margin-bottom: 10px;
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        
        .qr-code::before {
            content: "";
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            background-image: 
                linear-gradient(to right, black 25%, transparent 25%, transparent 75%, black 75%),
                linear-gradient(to bottom, black 25%, transparent 25%, transparent 75%, black 75%);
            background-size: 10px 10px, 10px 10px;
            background-position: 0 0, 5px 5px;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Watermark -->
        <div class="watermark">PAID</div>
        
        <!-- Receipt Header -->
        <div class="receipt-header">
            <div class="receipt-dots"></div>
            <div class="header-content">
                <div>
                    <h1 class="receipt-title">Official Receipt</h1>
                    <div class="receipt-subtitle">Thank you for your business</div>
                </div>
                <div class="receipt-number"># {{ $receipt->receipt_number }}</div>
            </div>
        </div>
        
        <!-- Paid Stamp -->
        <div class="paid-stamp">Paid</div>
        
        <!-- Receipt Body -->
        <div class="receipt-body">
            <!-- Company and Date Info -->
            <div class="company-details">
                <div class="company-info">
                    <h2>Project Details</h2>
                    <p>{{ $receipt->project->project_name }}</p>
                    <p>{{ $receipt->project->description ?? 'Project Description' }}</p>
                </div>
                <div class="receipt-date">
                    <div class="date-label">Receipt Date</div>
                    <div class="date-value">{{ $receipt->created_at->format('d M Y') }}</div>
                </div>
            </div>
            
            <!-- Receipt Details -->
            <div class="receipt-details">
                <div class="detail-header">Receipt Details</div>
                
                <div class="detail-row">
                    <div class="detail-label">Receipt Number</div>
                    <div class="detail-value">{{ $receipt->receipt_number }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Project</div>
                    <div class="detail-value">{{ $receipt->project->project_name }}</div>
                </div>
                
                <div class="detail-row amount-row">
                    <div class="detail-label">Amount</div>
                    <div class="detail-value">{{ number_format($receipt->amount, 0, '.', ',') }} UGX</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Description</div>
                    <div class="detail-value">{{ $receipt->description }}</div>
                </div>
            </div>
            
            <!-- Receipt Image if available -->
            @if($receipt->photo_path)
            <div class="receipt-image">
                <h4>Receipt Image</h4>
                <img src="{{ storage_path('app/public/' . $receipt->photo_path) }}" alt="Receipt Image">
            </div>
            @endif
            
            <!-- Thank You Message -->
            <div class="thank-you-message">Thank You For Your Business!</div>
            
            <!-- Barcode Section -->
            <div class="barcode-section">
                <div class="barcode"></div>
                <div class="barcode-number">{{ $receipt->receipt_number }}</div>
            </div>
            
            <!-- Signature Section -->
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-label">Received By</div>
                </div>
                
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-label">Authorized Signature</div>
                </div>
                
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-label">Date</div>
                </div>
            </div>
        </div>
        
        <!-- Receipt Footer -->
        <div class="receipt-footer">
            <div class="footer-note">This is an official receipt. Please keep it for your records.</div>
            <div>Generated on {{ now()->format('d M Y, h:i A') }}</div>
            
            <!-- QR Code Placeholder -->
            <div style="margin-top: 15px;">
                <div class="qr-code"></div>
                <div style="font-size: 10px; color: #999;">Scan to verify</div>
            </div>
        </div>
    </div>
</body>
</html>