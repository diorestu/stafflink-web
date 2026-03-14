<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contract {{ $data['contract_number'] }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2937;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            margin: 0 0 4px;
        }

        .meta {
            text-align: center;
            font-size: 11px;
            margin-bottom: 22px;
            color: #4b5563;
        }

        h2 {
            font-size: 13px;
            margin: 20px 0 8px;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 4px;
        }

        p {
            margin: 0 0 10px;
        }

        .box {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 10px;
            background: #f9fafb;
        }

        .signature-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
            padding: 8px;
        }

        .signature-line {
            margin-top: 64px;
            border-top: 1px solid #111827;
            width: 90%;
        }

        .muted {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <h1>STANDARD SERVICE AGREEMENT</h1>
    <p class="meta">
        Contract Number: <strong>{{ $data['contract_number'] }}</strong><br>
        Contract Date: {{ $data['contract_date'] }}
    </p>

    <p>
        This Service Agreement ("Agreement") is entered into on {{ $data['effective_date'] }} by and between:
    </p>

    <div class="box">
        <strong>{{ $data['provider_name'] }}</strong><br>
        {!! nl2br(e($data['provider_address'] ?: '-')) !!}<br>
        <span class="muted">("Provider")</span>
    </div>

    <div class="box">
        <strong>{{ $data['client_name'] }}</strong><br>
        {!! nl2br(e($data['client_address'] ?: '-')) !!}<br>
        <span class="muted">("Client")</span>
    </div>

    <h2>1. Scope of Services</h2>
    <p>{!! nl2br(e($data['service_description'])) !!}</p>

    <h2>2. Contract Value and Payment Terms</h2>
    <p><strong>Total Fee:</strong> {{ $data['fee_display'] }}</p>
    <p><strong>Payment Terms:</strong> {!! nl2br(e($data['payment_terms'])) !!}</p>

    <h2>3. Service Period</h2>
    <p>
        The service period starts on {{ $data['start_date'] }}
        @if ($data['end_date'])
            and ends on {{ $data['end_date'] }}.
        @else
            and continues until completed by both parties.
        @endif
    </p>

    <h2>4. Additional Terms</h2>
    <p>
        @if ($data['additional_terms'])
            {!! nl2br(e($data['additional_terms'])) !!}
        @else
            No additional terms apply unless agreed in writing by both parties.
        @endif
    </p>

    <h2>5. Governing Law</h2>
    <p>
        This Agreement shall be governed by and construed in accordance with the laws of
        {{ $data['governing_law'] ?: 'the applicable jurisdiction' }}.
    </p>

    <table class="signature-table">
        <tr>
            <td>
                <strong>Provider</strong>
                <div class="signature-line"></div>
                <p>
                    {{ $data['provider_signatory_name'] }}<br>
                    @if ($data['provider_signatory_title'])
                        <span class="muted">{{ $data['provider_signatory_title'] }}</span><br>
                    @endif
                    Date: __________________
                </p>
            </td>
            <td>
                <strong>Client</strong>
                <div class="signature-line"></div>
                <p>
                    {{ $data['client_signatory_name'] }}<br>
                    @if ($data['client_signatory_title'])
                        <span class="muted">{{ $data['client_signatory_title'] }}</span><br>
                    @endif
                    Date: __________________
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
