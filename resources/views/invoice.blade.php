<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoiceNumber }} | SV Distribution</title>

    <style>
        /* =========================================
           RESET & BASE STYLES
           ========================================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", sans-serif;
            background: 
                radial-gradient(circle at 20% 20%, rgba(0, 122, 255, 0.18), transparent 35%),
                radial-gradient(circle at 80% 30%, rgba(52, 199, 89, 0.15), transparent 35%),
                radial-gradient(circle at 50% 90%, rgba(175, 82, 222, 0.18), transparent 40%),
                #050816;
            color: #e5e7eb;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* Background Effects */
        .aurora {
            position: fixed; inset: 0; z-index: -1;
            background: radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.25), transparent 40%),
                        radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.20), transparent 40%);
            animation: floatAurora 12s infinite alternate ease-in-out;
            backdrop-filter: blur(120px);
        }

        /* =========================================
           INVOICE CONTAINER (GLASSMORPHISM)
           ========================================= */
        .invoice-wrapper {
            max-width: 800px;
            margin: auto;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        /* Success Banner */
        .success-banner {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            font-weight: 700;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        /* Header Elements */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .brand-logo h1 {
            font-size: 36px;
            font-weight: 900;
            background: linear-gradient(90deg, #ffffff, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }

        .brand-logo p { color: #94a3b8; font-size: 14px; }

        .invoice-meta { text-align: right; }
        .invoice-meta h2 { font-size: 24px; color: #ffffff; letter-spacing: 1px; }
        .invoice-meta p { color: #94a3b8; margin-top: 5px; }

        /* Customer & Billing Details */
        .billing-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.02);
            padding: 25px;
            border-radius: 16px;
        }

        .billing-section h3 {
            color: #60a5fa;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .billing-section p { color: #cbd5e1; line-height: 1.6; }
        .billing-section strong { color: #ffffff; }

        /* =========================================
           ITEMIZED TABLE
           ========================================= */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .invoice-table th {
            text-align: left;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .invoice-table td {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #e5e7eb;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* Totals Section */
        .totals {
            width: 300px;
            margin-left: auto;
            padding-top: 20px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: #cbd5e1;
            font-size: 16px;
        }

        .totals-row.grand-total {
            font-size: 24px;
            font-weight: 800;
            color: #34d399;
            border-top: 1px dashed rgba(255, 255, 255, 0.2);
            padding-top: 20px;
        }

        /* =========================================
           ACTIONS (BUTTONS)
           ========================================= */
        .actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 50px;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: 0.3s;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-print {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .btn-home {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }

        .btn:hover { transform: translateY(-3px); filter: brightness(1.1); }

        /* =========================================
           PRINT STYLES (Triggers on Ctrl+P)
           ========================================= */
        @media print {
            body { 
                background: white; 
                color: black; 
                padding: 0;
            }
            .aurora, .actions, .success-banner { display: none !important; }
            .invoice-wrapper {
                box-shadow: none;
                border: none;
                background: transparent;
                padding: 0;
                filter: none;
                backdrop-filter: none;
            }
            .brand-logo h1 { color: black; background: none; -webkit-text-fill-color: black; }
            .brand-logo p, .invoice-meta p, .billing-section p, .invoice-table th { color: #333; }
            .invoice-meta h2, .billing-section strong, .invoice-table td, .totals-row { color: black; }
            .totals-row.grand-total { color: black; border-top: 2px solid black; }
            .invoice-header, .invoice-table td, .invoice-table th { border-color: #ddd; }
            .billing-grid { background: #f9fafb; border: 1px solid #e5e7eb; }
            .invoice-table th { background: #f3f4f6; color: black; }
        }

        /* RESPONSIVE */
        @media(max-width: 600px) {
            .invoice-header { flex-direction: column; gap: 20px; }
            .invoice-meta { text-align: left; }
            .billing-grid { grid-template-columns: 1fr; }
            .actions { flex-direction: column; }
        }
    </style>
</head>
<body>

    <div class="aurora"></div>

    <div class="invoice-wrapper">
        
        <div class="success-banner">
            ✅ Order Placed Successfully!
        </div>

        <div class="invoice-header">
            <div class="brand-logo">
                <h1>SV.</h1>
                <p>PV Sami Road, Chalappuram</p>
                <p>abhishanth.narayan@gmail.com</p>
            </div>
            <div class="invoice-meta">
                <h2>INVOICE</h2>
                <p>Order #{{ $invoiceNumber }}</p>
                <p>Date: {{ $date }}</p>
            </div>
        </div>

        <div class="billing-grid">
            <div class="billing-section">
                <h3>Billed To:</h3>
                <p><strong>{{ $customer['name'] }}</strong></p>
                <p>{{ $customer['email'] }}</p>
                <p>{{ $customer['phone'] }}</p>
            </div>
            <div class="billing-section">
                <h3>Shipped To:</h3>
                <p>{{ $customer['address'] }}</p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td class="text-center">{{ $item['quantity'] }}</td>
                    <td class="text-right">₹{{ number_format($item['price'], 2) }}</td>
                    <td class="text-right">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <div class="totals-row">
                <span>Subtotal</span>
                <span>₹{{ number_format($total, 2) }}</span>
            </div>
            <div class="totals-row">
                <span>Shipping</span>
                <span>Free</span>
            </div>
            <div class="totals-row grand-total">
                <span>Total</span>
                <span>₹{{ number_format($total, 2) }}</span>
            </div>
        </div>

        <div class="actions">
            <button onclick="window.print()" class="btn btn-print">
                🖨️ Print Invoice
            </button>
            <a href="{{ route('home') }}" class="btn btn-home">
                🏠 Back to Store
            </a>
        </div>

    </div>

</body>
</html>