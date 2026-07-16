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
            background:#fff; padding:16px 14px;
            box-shadow:0 2px 10px rgba(0,0,0,.15);
        }
        /* Render the exact 42-char monospace text the printer receives.
           ch units tie the width to the character grid so wrapping/columns match. */
        .paper {
            font-family: 'Courier New', monospace;
            font-size:13px;
            line-height:1.35;
            white-space:pre;
            color:#000;
            width:42ch;
            margin:0;
        }
        .paper b { font-weight:700; }

        @media print {
            body { background:#fff; padding:0; }
            .toolbar { display:none; }
            .receipt { box-shadow:none; padding:0; }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <button class="btn btn-print" onclick="window.print()">Print</button>
        <a class="btn btn-thermal" href="{{ route('bills.print', $bill) }}">Send to Thermal Printer</a>
        <a class="btn btn-back" href="{{ route('bills.index') }}">Back</a>
    </div>

    <div class="receipt">
<pre class="paper">{!! collect($lines)->map(fn ($l) => $l['bold'] ? '<b>' . e($l['text']) . '</b>' : e($l['text']))->implode("\n") !!}</pre>
    </div>
</body>
</html>
