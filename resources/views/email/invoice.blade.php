<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Invoice</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

    <!-- Wrapper Table -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f4f4f5; padding: 40px 20px;">
        <tr>
            <td align="center">
                
                <!-- Main Email Container -->
                <table width="600" border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #05050a; padding: 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 32px; letter-spacing: -1px;">SV Distribution.</h1>
                            <p style="color: #94a3b8; margin: 10px 0 0 0; font-size: 14px;">Premium Hardware & Gear</p>
                        </td>
                    </tr>

                    <!-- Success Message -->
                    <tr>
                        <td style="padding: 40px 40px 20px 40px;">
                            <h2 style="margin: 0 0 10px 0; color: #18181b; font-size: 24px;">Order Confirmed</h2>
                            <p style="margin: 0; color: #52525b; font-size: 16px; line-height: 1.5;">
                                Hi {{ $order->name }},<br>
                                Thank you for your purchase. We are preparing your order for shipment. Below is your official invoice.
                            </p>
                        </td>
                    </tr>

                    <!-- Invoice Details -->
                    <tr>
                        <td style="padding: 0 40px 30px 40px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; border-radius: 12px; padding: 20px;">
                                <tr>
                                    <td width="50%" style="vertical-align: top;">
                                        <p style="margin: 0; color: #94a3b8; font-size: 12px; text-transform: uppercase; font-weight: bold;">Invoice Number</p>
                                        <p style="margin: 5px 0 0 0; color: #0f172a; font-size: 16px; font-weight: bold;">{{ $invoiceNumber }}</p>
                                    </td>
                                    <td width="50%" style="vertical-align: top; text-align: right;">
                                        <p style="margin: 0; color: #94a3b8; font-size: 12px; text-transform: uppercase; font-weight: bold;">Order Date</p>
                                        <p style="margin: 5px 0 0 0; color: #0f172a; font-size: 16px; font-weight: bold;">{{ $order->created_at->format('M d, Y') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Itemized List Header -->
                    <tr>
                        <td style="padding: 0 40px 10px 40px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">
                                        <h3 style="margin: 0; color: #0f172a; font-size: 16px;">Order Summary</h3>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- LOOP THROUGH CART ITEMS -->
                    <tr>
                        <td style="padding: 0 40px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                @foreach($cart as $item)
                                <tr>
                                    <td width="80" style="padding: 15px 0; border-bottom: 1px solid #f1f5f9;">
                                        <!-- Product Image -->
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('storage/'.$item['image']) }}" width="64" height="64" style="border-radius: 8px; object-fit: cover; display: block; background-color: #f1f5f9;">
                                        @endif
                                    </td>
                                    <td style="padding: 15px 15px; border-bottom: 1px solid #f1f5f9;">
                                        <p style="margin: 0; color: #0f172a; font-size: 16px; font-weight: 600;">{{ $item['name'] }}</p>
                                        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 14px;">Qty: {{ $item['quantity'] }}</p>
                                    </td>
                                    <td align="right" style="padding: 15px 0; border-bottom: 1px solid #f1f5f9;">
                                        <p style="margin: 0; color: #0f172a; font-size: 16px; font-weight: bold;">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    <!-- Totals -->
                    <tr>
                        <td style="padding: 20px 40px 40px 40px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="right" style="padding-bottom: 10px; color: #64748b; font-size: 14px;">Subtotal:</td>
                                    <td align="right" width="100" style="padding-bottom: 10px; color: #0f172a; font-size: 14px; font-weight: bold;">₹{{ number_format($order->total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-bottom: 15px; color: #64748b; font-size: 14px;">Shipping:</td>
                                    <td align="right" width="100" style="padding-bottom: 15px; color: #0f172a; font-size: 14px; font-weight: bold;">Free</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-top: 15px; border-top: 2px solid #e2e8f0; color: #0f172a; font-size: 18px; font-weight: 800;">Total:</td>
                                    <td align="right" width="100" style="padding-top: 15px; border-top: 2px solid #e2e8f0; color: #3b82f6; font-size: 20px; font-weight: 900;">₹{{ number_format($order->total, 2) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Shipping Address Details -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px 40px;">
                            <h3 style="margin: 0 0 10px 0; color: #0f172a; font-size: 14px; text-transform: uppercase;">Shipping Details</h3>
                            <p style="margin: 0; color: #52525b; font-size: 14px; line-height: 1.6;">
                                <strong>{{ $order->name }}</strong><br>
                                {{ $order->address }}<br>
                                {{ $order->phone }}
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 30px 40px; text-align: center; background-color: #05050a;">
                            <p style="margin: 0; color: #94a3b8; font-size: 12px;">
                                Need help with your order? Reply to this email or contact us at<br>
                                <a href="mailto:abhishanth.narayan@gmail.com" style="color: #3b82f6; text-decoration: none;">abhishanth.narayan@gmail.com</a>
                            </p>
                            <p style="margin: 15px 0 0 0; color: #52525b; font-size: 12px;">
                                &copy; {{ date('Y') }} SV Distribution. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>