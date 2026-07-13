<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt #{{ $bill->receipt_no }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            background:#e5e7eb; margin:0; padding:24px;
            font-family: 'Segoe UI', Arial, sans-serif;
            display:flex; flex-direction:column; align-items:center; gap:16px;
        }
        .toolbar { display:flex; gap:10px; }
        .btn {
            border:none; border-radius:6px; padding:9px 16px; font-size:14px; cursor:pointer;
            text-decoration:none; display:inline-flex; align-items:center; gap:6px; color:#fff;
        }
        .btn-print { background:#2563eb; }
        .btn-thermal { background:#16a34a; }
        .btn-back { background:#6b7280; }

        .receipt {
            width:302px; background:#fff; padding:16px 14px;
            box-shadow:0 2px 10px rgba(0,0,0,.15);
            font-family: 'Courier New', monospace; color:#000; font-size:12px; line-height:1.45;
        }
        .center { text-align:center; }
        .store-name { font-size:18px; font-weight:700; }
        .muted { font-size:11px; }
        .divider { border:none; border-top:1px dashed #000; margin:6px 0; }
        table { width:100%; border-collapse:collapse; font-size:11px; }
        th, td { padding:1px 0; }
        th { text-align:left; border-bottom:1px solid #000; }
        .num { text-align:right; white-space:nowrap; }
        .totals td { padding-top:2px; }
        .totals .label { text-align:right; font-weight:700; }
        .footer { font-size:11px; white-space:pre-line; }
        .meta { display:flex; justify-content:space-between; font-size:11px; }

        @media print {
            body { background:#fff; padding:0; }
            .toolbar { display:none; }
            .receipt { box-shadow:none; width:80mm; padding:0; }
        }
    </style>
</head>
<body>
    @php $store = $bill->medicalStore; $gross = $bill->grossTotal(); $net = $bill->netTotal(); @endphp

    <div class="toolbar">
        <button class="btn btn-print" onclick="window.print()">Print</button>
        <a class="btn btn-thermal" href="{{ route('bills.print', $bill) }}">Send to Thermal Printer</a>
        <a class="btn btn-back" href="{{ route('bills.index') }}">Back</a>
    </div>

    <div class="receipt">
        <div class="center">
            <div class="store-name">{{ $store->name ?? '' }}</div>
            @if(!empty($store->address))<div class="muted">{{ $store->address }}</div>@endif
            @if(!empty($store->phone))<div class="muted">Phone # {{ $store->phone }}</div>@endif
            @if(!empty($store->license_no))<div class="muted">License No: {{ $store->license_no }}</div>@endif
        </div>

        <hr class="divider">

        <div class="meta">
            <span><strong>No:</strong> {{ $bill->receipt_no }}</span>
            <span><strong>Date:</strong> {{ \Illuminate\Support\Carbon::parse($bill->date)->format('d/m/Y') }}</span>
        </div>
        <div><strong>M/S:</strong> {{ optional($bill->patient)->name }}</div>

        <hr class="divider">

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="num">Qty</th>
                    <th class="num">Price</th>
                    <th class="num">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bill->billDetails as $detail)
                <tr>
                    <td>{{ optional($detail->medicine)->medicine_name }}</td>
                    <td class="num">{{ $detail->quantity }}</td>
                    <td class="num">{{ number_format($detail->unit_price, 2) }}</td>
                    <td class="num">{{ number_format($detail->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr class="divider">

        <table class="totals">
            <tr>
                <td class="label">Gross Total:</td>
                <td class="num">{{ number_format($gross, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Discount:</td>
                <td class="num">{{ number_format($bill->discount, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Net Total:</td>
                <td class="num">{{ number_format($net, 2) }}</td>
            </tr>
        </table>

        @if(!empty($store->bottom_content))
            <hr class="divider">
            <div class="center footer">{{ $store->bottom_content }}</div>
        @endif
    </div>
</body>
</html>
