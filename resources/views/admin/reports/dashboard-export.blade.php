<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ESG Dashboard Report</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #2e7d32;
        }
        .title {
            color: #1a472a;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .section-title {
            color: #2e7d32;
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        .stats-container {
            margin-bottom: 30px;
        }
        .stat-row {
            margin-bottom: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
        }
        .stat-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
            display: inline-block;
            width: 150px;
        }
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #1a472a;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: avoid;
        }
        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background: #2e7d32;
            color: white;
            font-weight: normal;
        }
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">ESG Performance Dashboard Report</h1>
        <p class="subtitle">Generated on {{ now()->format('F d, Y \a\t h:i A') }}</p>
    </div>

    <div class="section">
        <h2 class="section-title">Banking Sector Overview</h2>
        <div class="stats-container">
            <div class="stat-row">
                <span class="stat-label">Total Banks:</span>
                <span class="stat-value">{{ $totalBanks }}</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Active Banks:</span>
                <span class="stat-value">{{ $activeBanksCount }} ({{ $activePercentage }}%)</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Public Sector Banks:</span>
                <span class="stat-value">{{ $publicSectorBanksCount }} ({{ $publicPercentage }}%)</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Private Sector Banks:</span>
                <span class="stat-value">{{ $privateSectorBanksCount }} ({{ $privatePercentage }}%)</span>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">ESG Score Analysis</h2>
        <table>
            <thead>
                <tr>
                    <th>Bank Type</th>
                    <th>Environmental Score</th>
                    <th>Social Score</th>
                    <th>Governance Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Public Sector</td>
                    <td>{{ $esgScores[0][0] ?? 0 }}%</td>
                    <td>{{ $esgScores[0][1] ?? 0 }}%</td>
                    <td>{{ $esgScores[0][2] ?? 0 }}%</td>
                </tr>
                <tr>
                    <td>Private Sector</td>
                    <td>{{ $esgScores[1][0] ?? 0 }}%</td>
                    <td>{{ $esgScores[1][1] ?? 0 }}%</td>
                    <td>{{ $esgScores[1][2] ?? 0 }}%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>This report was automatically generated from the ESG PRAKRIT Dashboard</p>
        <p>© {{ date('Y') }} ESG PRAKRIT. All rights reserved.</p>
    </div>
</body>
</html> 