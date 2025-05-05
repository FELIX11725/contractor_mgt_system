<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Contract Agreement</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-gray: #f5f7fa;
            --border-color: #dcdfe6;
            --text-color: #333;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.7;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        
        .contract-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 20px;
        }
        
        .header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }
        
        .header h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header h2 {
            font-size: 20px;
            color: var(--secondary-color);
            font-weight: 500;
        }
        
        .contract-meta {
            display: flex;
            justify-content: space-between;
            background-color: var(--light-gray);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .contract-meta-item {
            flex: 1;
            padding: 0 15px;
        }
        
        .contract-meta-item:not(:last-child) {
            border-right: 1px solid var(--border-color);
        }
        
        .meta-label {
            font-size: 12px;
            text-transform: uppercase;
            color: #777;
            margin-bottom: 5px;
        }
        
        .meta-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .section {
            margin-bottom: 30px;
            padding: 0 15px;
        }
        
        .section h3 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-color);
            position: relative;
        }
        
        .section h3::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 50px;
            height: 2px;
            background-color: var(--accent-color);
        }
        
        .section p, .section li {
            margin: 10px 0;
            font-size: 16px;
        }
        
        .section ul {
            padding-left: 20px;
        }
        
        .section ul li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 15px;
        }
        
        .section ul li::before {
            content: "•";
            color: var(--secondary-color);
            font-weight: bold;
            position: absolute;
            left: 0;
        }
        
        .terms-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        
        .terms-item {
            background-color: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            border-left: 3px solid var(--secondary-color);
        }
        
        .signature-section {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px dashed var(--border-color);
        }
        
        .signatures-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }
        
        .signature-box {
            padding: 20px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--light-gray);
        }
        
        .signature-box h4 {
            font-size: 18px;
            color: var(--primary-color);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .signature-field {
            margin: 15px 0;
        }
        
        .signature-label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }
        
        .signature-value {
            width: 100%;
            padding: 8px 0;
            border: none;
            border-bottom: 1px solid #000;
            font-style: italic;
            background: transparent;
        }
        
        .signature-date {
            font-size: 14px;
            color: #777;
            text-align: right;
            margin-top: 20px;
        }
        
        .contract-footer {
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        
        .contract-footer p {
            margin: 5px 0;
        }
        
        .stamp-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        
        .official-stamp {
            width: 150px;
            height: 150px;
            border: 2px dashed var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #999;
            font-size: 14px;
            text-align: center;
        }
        
        .description-box {
            background-color: var(--light-gray);
            padding: 20px;
            border-radius: 8px;
            border-left: 3px solid var(--primary-color);
            font-style: italic;
        }
        
        @media print {
            body {
                background: none;
            }
            .contract-container {
                box-shadow: none;
                border: none;
                padding: 0;
            }
            .signature-box, .contract-meta, .description-box, .terms-item {
                background-color: transparent;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="contract-container">
        <div class="header">
            <h1>Contract Agreement</h1>
            <h2>{{ $contract->contractor->user->name }} & {{ $contract->contractor->first_name }} {{ $contract->contractor->last_name }}</h2>
        </div>
        
        <div class="contract-meta">
            <div class="contract-meta-item">
                <div class="meta-label">Contract ID</div>
                <div class="meta-value">{{ $contract->id ?? 'CN-'.date('Ymd').'-'.rand(1000,9999) }}</div>
            </div>
            <div class="contract-meta-item">
                <div class="meta-label">Contract Type</div>
                <div class="meta-value">{{ $contract->contractType->name }}</div>
            </div>
            <div class="contract-meta-item">
                <div class="meta-label">Issue Date</div>
                <div class="meta-value">{{ date('d M Y') }}</div>
            </div>
        </div>
        
        <div class="section">
            <h3>1. Parties to the Agreement</h3>
            <p>This Contract Agreement (hereinafter referred to as the "Agreement") is made and entered into on <strong>{{ date('d F Y') }}</strong> by and between:</p>
            
            <div class="terms-grid">
                <div class="terms-item">
                    <p><strong>User:</strong><br>
                    {{ $contract->contractor->user->name }}<br>
                    {{ $contract->business ? $contract->business->business_address : 'Address Line 1' }}<br>
                    {{ $contract->business ? $contract->business->business_location : 'City' }}, 
                    {{ $contract->business ? $contract->business->business_email : 'email' }}<br>
                   </p>
                </div>
                
                <div class="terms-item">
                    <p><strong>Contractor:</strong><br>
                    {{ $contract->contractor->first_name }} {{ $contract->contractor->last_name }}<br>
                    {{ $contract->contractor->address ?? 'Address Line 1' }}<br>
                    {{ $contract->contractor->city ?? 'City' }}, {{ $contract->contractor->country ?? 'Country' }}<br>
                    {{ $contract->contractor->email ?? 'email@example.com' }}</p>
                </div>
            </div>
        </div>
        
        <div class="section">
            <h3>2. Contract Details</h3>
            
            <div class="terms-grid">
                <div class="terms-item">
                    <p><strong>Start Date:</strong><br>{{ $contract->start_date }}</p>
                </div>
                
                <div class="terms-item">
                    <p><strong>End Date:</strong><br>{{ $contract->end_date }}</p>
                </div>
                
                <div class="terms-item">
                    <p><strong>Contract Value:</strong><br>shs. {{ number_format($contract->total_amount, 0, '.', ',') }}</p>
                </div>
                
                <div class="terms-item">
                    <p><strong>Payment Terms:</strong><br>{{ $contract->payment_terms ?? 'Net 30 days' }}</p>
                </div>
            </div>
        </div>
        
        <div class="section">
            <h3>3. Scope of Work</h3>
            <div class="description-box">
                <p>{!! nl2br(e($contract->description)) !!}</p>
            </div>
        </div>
        
        <div class="section">
            <h3>4. Terms and Conditions</h3>
            <ul>
                <li>The Contractor agrees to perform all work in accordance with the standards and specifications set forth in this Agreement.</li>
                <li>All work must be completed by the End Date specified in Section 2, unless otherwise agreed upon in writing by both parties.</li>
                <li>The User agrees to pay the Contractor the full amount specified in Section 2 upon satisfactory completion of the work.</li>
                <li>The Contractor shall supply all labor, materials, equipment, and transportation necessary to perform and complete the work, unless otherwise specified in writing.</li>
                <li>Any modifications to this Agreement must be made in writing and signed by both parties.</li>
                <li>The Contractor shall comply with all applicable laws, regulations, and codes in performing the work.</li>
                <li>Either party may terminate this Agreement with written notice if the other party breaches any material term or condition of this Agreement.</li>
                <li>Any disputes arising from this Agreement shall be resolved through mediation before pursuing legal action.</li>
            </ul>
        </div>
        
        <div class="section">
            <h3>5. Confidentiality</h3>
            <p>During the term of this Agreement and thereafter, the Contractor shall maintain the confidentiality of any proprietary information and trade secrets received from the User. The Contractor shall not disclose such information to any third party without the prior written consent of the User.</p>
        </div>
        
        <div class="section">
            <h3>6. Intellectual Property</h3>
            <p>All intellectual property rights in any materials, documents, or deliverables created or developed by the Contractor in the performance of this Agreement shall be the sole property of the User upon payment in full for the work.</p>
        </div>
        
        <div class="signature-section">
            <h3>7. Signatures</h3>
            <p>This Agreement constitutes the entire understanding between the parties and supersedes all prior negotiations, understandings, and agreements. By signing below, each party acknowledges that they have read, understood, and agree to be bound by the terms and conditions of this Agreement.</p>
            
            <div class="signatures-grid">
                <div class="signature-box">
                    <h4>For {{ $contract->contractor->user->name }}:</h4>
                    
                    <div class="signature-field">
                        <span class="signature-label">Authorized Signature:</span>
                        <div class="signature-value"></div>
                    </div>
                    
                    <div class="signature-field">
                        <span class="signature-label">Name:</span>
                        <div class="signature-value"></div>
                    </div>
                    
                    <div class="signature-field">
                        <span class="signature-label">Title/Position:</span>
                        <div class="signature-value"></div>
                    </div>
                    
                    <div class="signature-date">
                        Date: _____ / _____ / _________
                    </div>
                </div>
                
                <div class="signature-box">
                    <h4>For {{ $contract->contractor->first_name }} {{ $contract->contractor->last_name }}:</h4>
                    
                    <div class="signature-field">
                        <span class="signature-label">Authorized Signature:</span>
                        <div class="signature-value"></div>
                    </div>
                    
                    <div class="signature-field">
                        <span class="signature-label">Name:</span>
                        <div class="signature-value"></div>
                    </div>
                    
                    <div class="signature-field">
                        <span class="signature-label">Title/Position:</span>
                        <div class="signature-value"></div>
                    </div>
                    
                    <div class="signature-date">
                        Date: _____ / _____ / _________
                    </div>
                </div>
            </div>
            
            <div class="stamp-section">
                <div class="official-stamp">
                    [OFFICIAL STAMP]
                </div>
                <div class="official-stamp">
                    [OFFICIAL STAMP]
                </div>
            </div>
        </div>
        
        <div class="contract-footer">
            <p>Contract Reference: {{ $contract->id ?? 'CN-'.date('Ymd').'-'.rand(1000,9999) }}</p>
            <p>This document is legally binding upon both parties once signed.</p>
            <p>Page 1 of 1</p>
        </div>
    </div>
</body>
</html>