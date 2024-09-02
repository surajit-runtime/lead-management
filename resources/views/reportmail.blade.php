<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>Email Template</title> --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Daily Leads Report</h2>
    <table>
        <thead>
            <tr>
                <th>Call Center</th>
                <th>Total Leads</th>
                <th>Hot Leads</th>
                <th>Nurturing Leads</th>
                <th>Dead Leads</th>
                <th>Closed Leads</th>
                <th>Pending Leads</th>
            </tr>
        </thead>
        <tbody>
            @foreach($defoultArr as $df)
            <tr>
                <td>{{ $df['call_center_name'] }}</td>
                <td>{{ $df['total_lead_count'] }}</td>
                <td>{{ $df['hot_lead_count'] }}</td>
                <td>{{ $df['nurturing_lead_count'] }}</td>
                <td>{{ $df['dead_lead_count'] }}</td>
                <td>{{ $df['close_lead_count'] }}</td>
                <td>{{ $df['pending_leads_count'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
