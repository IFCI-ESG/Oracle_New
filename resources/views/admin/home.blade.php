@extends('layouts.vertical', ['title' => 'ESG PRAKRIT'])

@section('css')
<style>
    .dashboard-card {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden;
        border: none;
        height: 100%;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }
    
    .stat-card-body {
        padding: 0;
        display: flex;
        flex-direction: column;
    }
    
    .stat-card-header {
        background: rgba(72, 209, 204, 0.08);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .stat-card-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 600;
        color: #2c3e50;
        line-height: 1.1;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 0.95rem;
        color: #8392a5;
        font-weight: 500;
    }
    
    .stat-icon {
        height: 50px;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.6rem;
    }
    
    .bg-leaf {
        background: rgba(40, 167, 69, 0.12);
        color: #28a745;
    }
    
    .bg-water {
        background: rgba(13, 110, 253, 0.12);
        color: #0d6efd;
    }
    
    .bg-sun {
        background: rgba(255, 193, 7, 0.12);
        color: #ffc107;
    }
    
    .dashboard-section {
        margin-bottom: 2.5rem;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #2c3e50;
        display: flex;
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .section-title i {
        margin-right: 10px;
        color: #48d1cc;
    }
    
    .bank-category-label {
        font-weight: 500;
        color: #2c3e50;
        font-size: 1rem;
    }
    
    .card-actions {
        display: flex;
        justify-content: flex-end;
    }
    
    .dashboard-welcome {
        background: linear-gradient(135deg, #48d1cc 0%, #1e7e7b 100%);
        color: white;
        border-radius: 12px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 5px 20px rgba(30, 126, 123, 0.3);
    }
    
    .dashboard-welcome h2 {
        font-weight: 600;
        font-size: 2rem;
        margin-bottom: 0.75rem;
    }
    
    .chart-container {
        position: relative;
        height: 200px;
        width: 200px;
        margin: 0 auto;
    }
    
    .stat-trend {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }
    
    .trend-up {
        color: #28a745;
    }
    
    .trend-down {
        color: #dc3545;
    }
    
    .card-metric {
        display: flex;
        align-items: center;
        margin-top: 1rem;
    }
    
    .metric-item {
        display: flex;
        align-items: center;
        margin-right: 1.5rem;
    }
    
    .metric-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 6px;
    }
    
    .metric-label {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    .progress {
        height: 8px;
        margin-bottom: 0.75rem;
        border-radius: 4px;
        overflow: hidden;
    }
    
    /* Simplified card styles for a cleaner look */
    .simple-stat-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        padding: 1.5rem;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .simple-stat-card .card-title {
        color: #4a5568;
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .simple-stat-card .stat-value {
        font-size: 2.75rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }
    
    .simple-stat-card .stat-indicator {
        display: inline-flex;
        align-items: center;
        font-size: 0.875rem;
        padding: 0.35rem 0.75rem;
        border-radius: 100px;
        margin: 0.5rem 0;
    }
    
    .simple-stat-card .progress-thin {
        height: 6px;
        background-color: #edf2f7;
        border-radius: 6px;
        overflow: hidden;
    }
    
    .simple-stat-card .progress-bar {
        height: 100%;
        border-radius: 6px;
    }
    
    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
    }
    
    .green-gradient {
        background: linear-gradient(145deg, #20bf55 0%, #01baef 100%);
    }
    
    .blue-gradient {
        background: linear-gradient(145deg, #2563eb 0%, #4f46e5 100%);
    }
    
    .yellow-gradient {
        background: linear-gradient(145deg, #f59e0b 0%, #fbbf24 100%);
    }
</style>
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid mt-3">
    <!-- Welcome Banner -->
    @if (Auth::user()->hasRole('Admin') && Auth::user()->hasRole('SubAdmin') &&  Auth::user()->hasRole('Bank'))
        <div class="dashboard-welcome">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2>Welcome to ESG PRAKRIT Dashboard</h2>
                    <p class="mb-0 opacity-75">Environmental, Social, and Governance monitoring platform for banking sector</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <span>{{ $currentDate }}</span>
                </div>
            </div>
        </div>
        
        <!-- Stats Section -->
        <div class="dashboard-section">
            <h5 class="section-title">
                <i class="bi bi-bar-chart-fill"></i> Banking Sector Overview
            </h5>
            <div class="row">
                <!-- Total Banks -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Total Banks</h5>
                        <div class="icon-circle green-gradient text-white">
                            <i class="bi bi-bank"></i>
                        </div>
                        <h2 class="stat-value">{{ $totalBanks }}</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up-right me-1"></i> 5.3% since last month
                        </div>
                        <div class="progress-thin mt-4">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Active Banks -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Active Banks</h5>
                        <div class="icon-circle blue-gradient text-white">
                            <i class="bi bi-building-check"></i>
                        </div>
                        <h2 class="stat-value">{{ $activeBanksCount }}</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up-right me-1"></i> 2.1% since last month
                        </div>
                        <div class="progress-thin mt-4">
                            <div class="progress-bar bg-primary" style="width: {{ $activePercentage }}%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Total Companies -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Total Companies</h5>
                        <div class="icon-circle yellow-gradient text-white">
                            <i class="bi bi-building"></i>
                        </div>
                        <h2 class="stat-value">{{ $totalCompanies }}</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up-right me-1"></i> 8.7% since last month
                        </div>
                        <div class="progress-thin mt-4">
                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bank Categories Section with Charts -->
        <div class="dashboard-section">
            <h5 class="section-title">
                <i class="bi bi-pie-chart-fill"></i> Bank Categories
            </h5>
            <div class="row">
                <!-- Public vs Private Banks Pie Chart -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Bank Sector Distribution</h5>
                        <div class="chart-container mb-3">
                            <canvas id="bankSectorChart"></canvas>
                        </div>
                        <div class="card-metric">
                            <div class="metric-item">
                                <div class="metric-color" style="background: #20bf55;"></div>
                                <span class="metric-label">Public ({{ $publicPercentage }}%)</span>
                            </div>
                            <div class="metric-item">
                                <div class="metric-color" style="background: #2563eb;"></div>
                                <span class="metric-label">Private ({{ $privatePercentage }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Public Sector Banks -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Public Sector Banks</h5>
                        <div class="icon-circle green-gradient text-white">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <h2 class="stat-value">{{ $publicSectorBanksCount }}</h2>
                        <div class="progress-thin mt-2 mb-2">
                            <div class="progress-bar bg-success" style="width: {{ $publicPercentage }}%"></div>
                        </div>
                        <p class="small text-muted mb-0">{{ $publicPercentage }}% of total banks</p>
                    </div>
                </div>
                
                <!-- Active vs Inactive Pie Chart -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Banks Participation Status</h5>
                        <div class="chart-container mb-3">
                            <canvas id="bankStatusChart"></canvas>
                        </div>
                        <div class="card-metric">
                            <div class="metric-item">
                                <div class="metric-color" style="background: #f59e0b;"></div>
                                <span class="metric-label">Active ({{ $activePercentage }}%)</span>
                            </div>
                            <div class="metric-item">
                                <div class="metric-color" style="background: #6c757d;"></div>
                                <span class="metric-label">Inactive ({{ 100 - $activePercentage }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Second row for detailed stats -->
            <div class="row">
                <!-- Private Sector Banks -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Private Sector Banks</h5>
                        <div class="icon-circle blue-gradient text-white">
                            <i class="bi bi-building"></i>
                        </div>
                        <h2 class="stat-value">{{ $privateSectorBanksCount }}</h2>
                        <div class="progress-thin mt-2 mb-2">
                            <div class="progress-bar bg-primary" style="width: {{ $privatePercentage }}%"></div>
                        </div>
                        <p class="small text-muted mb-0">{{ $privatePercentage }}% of total banks</p>
                    </div>
                </div>
                
                <!-- Participation Rate -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Participation Rate</h5>
                        <div class="icon-circle yellow-gradient text-white">
                            <i class="bi bi-activity"></i>
                        </div>
                        <h2 class="stat-value">{{ $activePercentage }}%</h2>
                        <div class="progress-thin mt-2 mb-2">
                            <div class="progress-bar bg-warning" style="width: {{ $activePercentage }}%"></div>
                        </div>
                        <p class="small text-muted mb-0">{{ $activeBanksCount }} active out of {{ $totalBanks }} total banks</p>
                    </div>
                </div>
                
                <!-- ESG Impact Bar Chart -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">ESG Impact Score</h5>
                        <div class="chart-container mb-3">
                            <canvas id="esgImpactChart"></canvas>
                        </div>
                        <div class="card-metric">
                            <div class="metric-item">
                                <div class="metric-color" style="background: #20bf55;"></div>
                                <span class="metric-label">Environmental</span>
                            </div>
                            <div class="metric-item">
                                <div class="metric-color" style="background: #2563eb;"></div>
                                <span class="metric-label">Social</span>
                            </div>
                            <div class="metric-item">
                                <div class="metric-color" style="background: #f59e0b;"></div>
                                <span class="metric-label">Governance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->hasRole('Admin') && Auth::user()->hasRole('SubAdmin') && Auth::user()->hasRole('Corporate'))
        <div class="dashboard-welcome">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2>Welcome to ESG PRAKRIT Dashboard</h2>
                    <p class="mb-0 opacity-75">Environmental, Social, and Governance monitoring platform for Corporate Sector</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <span>{{ $currentDate }}</span>
                </div>
            </div>
        </div>
        
        <!-- Stats Section -->
        <div class="dashboard-section">
            <h5 class="section-title">
                <i class="bi bi-bar-chart-fill"></i> Corporte Sector Overview
            </h5>
            <div class="row">
                <!-- Total Banks -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Total Banks</h5>
                        <div class="icon-circle green-gradient text-white">
                            <i class="bi bi-bank"></i>
                        </div>
                        <h2 class="stat-value">{{ $totalBanks }}</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up-right me-1"></i> 5.3% since last month
                        </div>
                        <div class="progress-thin mt-4">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Active Banks -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Active Banks</h5>
                        <div class="icon-circle blue-gradient text-white">
                            <i class="bi bi-building-check"></i>
                        </div>
                        <h2 class="stat-value">{{ $activeBanksCount }}</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up-right me-1"></i> 2.1% since last month
                        </div>
                        <div class="progress-thin mt-4">
                            <div class="progress-bar bg-primary" style="width: {{ $activePercentage }}%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Total Companies -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Total Companies</h5>
                        <div class="icon-circle yellow-gradient text-white">
                            <i class="bi bi-building"></i>
                        </div>
                        <h2 class="stat-value">{{ $totalCompanies }}</h2>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up-right me-1"></i> 8.7% since last month
                        </div>
                        <div class="progress-thin mt-4">
                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bank Categories Section with Charts -->
        <div class="dashboard-section">
            <h5 class="section-title">
                <i class="bi bi-pie-chart-fill"></i> Bank Categories
            </h5>
            <div class="row">
                <!-- Public vs Private Banks Pie Chart -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Bank Sector Distribution</h5>
                        <div class="chart-container mb-3">
                            <canvas id="bankSectorChart"></canvas>
                        </div>
                        <div class="card-metric">
                            <div class="metric-item">
                                <div class="metric-color" style="background: #20bf55;"></div>
                                <span class="metric-label">Public ({{ $publicPercentage }}%)</span>
                            </div>
                            <div class="metric-item">
                                <div class="metric-color" style="background: #2563eb;"></div>
                                <span class="metric-label">Private ({{ $privatePercentage }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Public Sector Banks -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Public Sector Banks</h5>
                        <div class="icon-circle green-gradient text-white">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <h2 class="stat-value">{{ $publicSectorBanksCount }}</h2>
                        <div class="progress-thin mt-2 mb-2">
                            <div class="progress-bar bg-success" style="width: {{ $publicPercentage }}%"></div>
                        </div>
                        <p class="small text-muted mb-0">{{ $publicPercentage }}% of total banks</p>
                    </div>
                </div>
                
                <!-- Active vs Inactive Pie Chart -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Banks Participation Status</h5>
                        <div class="chart-container mb-3">
                            <canvas id="bankStatusChart"></canvas>
                        </div>
                        <div class="card-metric">
                            <div class="metric-item">
                                <div class="metric-color" style="background: #f59e0b;"></div>
                                <span class="metric-label">Active ({{ $activePercentage }}%)</span>
                            </div>
                            <div class="metric-item">
                                <div class="metric-color" style="background: #6c757d;"></div>
                                <span class="metric-label">Inactive ({{ 100 - $activePercentage }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Second row for detailed stats -->
            <div class="row">
                <!-- Private Sector Banks -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Private Sector Banks</h5>
                        <div class="icon-circle blue-gradient text-white">
                            <i class="bi bi-building"></i>
                        </div>
                        <h2 class="stat-value">{{ $privateSectorBanksCount }}</h2>
                        <div class="progress-thin mt-2 mb-2">
                            <div class="progress-bar bg-primary" style="width: {{ $privatePercentage }}%"></div>
                        </div>
                        <p class="small text-muted mb-0">{{ $privatePercentage }}% of total banks</p>
                    </div>
                </div>
                
                <!-- Participation Rate -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">Participation Rate</h5>
                        <div class="icon-circle yellow-gradient text-white">
                            <i class="bi bi-activity"></i>
                        </div>
                        <h2 class="stat-value">{{ $activePercentage }}%</h2>
                        <div class="progress-thin mt-2 mb-2">
                            <div class="progress-bar bg-warning" style="width: {{ $activePercentage }}%"></div>
                        </div>
                        <p class="small text-muted mb-0">{{ $activeBanksCount }} active out of {{ $totalBanks }} total banks</p>
                    </div>
                </div>
                
                <!-- ESG Impact Bar Chart -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="simple-stat-card">
                        <h5 class="card-title">ESG Impact Score</h5>
                        <div class="chart-container mb-3">
                            <canvas id="esgImpactChart"></canvas>
                        </div>
                        <div class="card-metric">
                            <div class="metric-item">
                                <div class="metric-color" style="background: #20bf55;"></div>
                                <span class="metric-label">Environmental</span>
                            </div>
                            <div class="metric-item">
                                <div class="metric-color" style="background: #2563eb;"></div>
                                <span class="metric-label">Social</span>
                            </div>
                            <div class="metric-item">
                                <div class="metric-color" style="background: #f59e0b;"></div>
                                <span class="metric-label">Governance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div> <!-- container -->
@endsection

@section('script')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Make sure DOM is fully loaded before initializing charts
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize charts after a slight delay to ensure canvas elements are ready
        setTimeout(function() {
            initializeCharts();
        }, 100);
    });
    
    function initializeCharts() {
        // Bank Sector Distribution Chart
        const bankSectorCtx = document.getElementById('bankSectorChart');
        if (bankSectorCtx) {
            new Chart(bankSectorCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Public Sector Banks', 'Private Sector Banks'],
                    datasets: [{
                        data: [{{ $publicSectorBanksCount }}, {{ $privateSectorBanksCount }}],
                        backgroundColor: ['#20bf55', '#2563eb'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    cutout: '65%',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return label + ': ' + value + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        } else {
            console.error('Canvas element bankSectorChart not found');
        }
        
        // Bank Status Chart
        const bankStatusCtx = document.getElementById('bankStatusChart');
        if (bankStatusCtx) {
            new Chart(bankStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Active Banks', 'Inactive Banks'],
                    datasets: [{
                        data: [{{ $activeBanksCount }}, {{ $totalBanks - $activeBanksCount }}],
                        backgroundColor: ['#f59e0b', '#6c757d'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    cutout: '65%',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return label + ': ' + value + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        } else {
            console.error('Canvas element bankStatusChart not found');
        }
        
        // ESG Impact Chart
        const esgImpactCtx = document.getElementById('esgImpactChart');
        if (esgImpactCtx) {
            new Chart(esgImpactCtx, {
                type: 'bar',
                data: {
                    labels: ['Environmental', 'Social', 'Governance'],
                    datasets: [{
                        label: 'Impact Score',
                        data: [78, 65, 82], // Sample data
                        backgroundColor: ['#20bf55', '#2563eb', '#f59e0b'],
                        borderWidth: 0,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 20
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    barPercentage: 0.6
                }
            });
        } else {
            console.error('Canvas element esgImpactChart not found');
        }
    }
</script>
@endsection

