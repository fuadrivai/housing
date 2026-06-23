@extends('main.index')


@section('content')
    <!-- Stat Cards Row -->
    <div class="row g-3">
        <div class="col-6 col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-wrapper blue">
                    <i data-lucide="building-2" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <div class="stat-value">4</div>
                    <div class="stat-label">Total Houses</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-wrapper teal">
                    <i data-lucide="users" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <div class="stat-value">128</div>
                    <div class="stat-label">Total Members</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-wrapper amber">
                    <i data-lucide="star" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <div class="stat-value">15,840</div>
                    <div class="stat-label">Total Points</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-wrapper purple">
                    <i data-lucide="calendar-check" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <div class="stat-value">2025-26</div>
                    <div class="stat-label">Active Academic Year</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaderboard + House Rankings Chart -->
    <div class="row g-3">
        <div class="col-lg-5">
            <div class="dashboard-card h-100">
                <div class="card-header">
                    <span>🏆 Top Houses Leaderboard</span>
                    <a href="#" style="font-size:0.8rem;font-weight:600;color:#6366f1;text-decoration:none;">View
                        All</a>
                </div>
                <div class="card-body">
                    <ul class="leaderboard-list" id="leaderboardList">
                        <li class="leaderboard-item">
                            <span class="rank-badge gold">1</span>
                            <div class="leaderboard-info">
                                <div class="leaderboard-name">Phoenix House</div>
                                <div class="leaderboard-meta">42 members</div>
                            </div>
                            <span class="leaderboard-points">5,240 pts</span>
                        </li>
                        <li class="leaderboard-item">
                            <span class="rank-badge silver">2</span>
                            <div class="leaderboard-info">
                                <div class="leaderboard-name">Dragon House</div>
                                <div class="leaderboard-meta">38 members</div>
                            </div>
                            <span class="leaderboard-points">4,870 pts</span>
                        </li>
                        <li class="leaderboard-item">
                            <span class="rank-badge bronze">3</span>
                            <div class="leaderboard-info">
                                <div class="leaderboard-name">Griffin House</div>
                                <div class="leaderboard-meta">35 members</div>
                            </div>
                            <span class="leaderboard-points">3,950 pts</span>
                        </li>
                        <li class="leaderboard-item">
                            <span class="rank-badge default-rank">4</span>
                            <div class="leaderboard-info">
                                <div class="leaderboard-name">Pegasus House</div>
                                <div class="leaderboard-meta">31 members</div>
                            </div>
                            <span class="leaderboard-points">1,780 pts</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="dashboard-card h-100">
                <div class="card-header">📊 House Rankings</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="houseRankingsChart" aria-label="Bar chart showing house rankings by points"
                            role="img"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities + Points Distribution -->
    <div class="row g-3">
        <div class="col-lg-7">
            <div class="dashboard-card h-100">
                <div class="card-header">
                    <span>📋 Recent Activities</span>
                    <a href="#" style="font-size:0.8rem;font-weight:600;color:#6366f1;text-decoration:none;">View
                        All</a>
                </div>
                <div class="card-body no-padding" style="overflow-x:auto;">
                    <table class="table-activities" aria-label="Recent activities table">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Activity</th>
                                <th>House</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>John Smith</strong></td>
                                <td>Earned 50 points for academic excellence</td>
                                <td>Phoenix</td>
                                <td><span class="activity-badge points">Points</span></td>
                                <td>Today, 10:30 AM</td>
                            </tr>
                            <tr>
                                <td><strong>Sarah Johnson</strong></td>
                                <td>Transferred to Dragon House</td>
                                <td>Dragon</td>
                                <td><span class="activity-badge transfer">Transfer</span></td>
                                <td>Today, 9:15 AM</td>
                            </tr>
                            <tr>
                                <td><strong>Michael Chen</strong></td>
                                <td>Academic Year 2025-26 enrollment</td>
                                <td>Griffin</td>
                                <td><span class="activity-badge academic">Academic</span></td>
                                <td>Yesterday</td>
                            </tr>
                            <tr>
                                <td><strong>Emily Davis</strong></td>
                                <td>Monthly house report generated</td>
                                <td>Phoenix</td>
                                <td><span class="activity-badge report">Report</span></td>
                                <td>Yesterday</td>
                            </tr>
                            <tr>
                                <td><strong>David Wilson</strong></td>
                                <td>Earned 30 points for sports achievement</td>
                                <td>Pegasus</td>
                                <td><span class="activity-badge points">Points</span></td>
                                <td>2 days ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="dashboard-card h-100">
                <div class="card-header">🥧 Points Distribution</div>
                <div class="card-body">
                    <div class="chart-container chart-container-sm">
                        <canvas id="pointsDistributionChart"
                            aria-label="Doughnut chart showing points distribution across houses" role="img"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        $(function() {
            // ============ CHARTS INITIALIZATION ============
            let houseRankingsChart = null;
            let pointsDistributionChart = null;

            function initCharts() {
                // Destroy existing charts
                if (houseRankingsChart) houseRankingsChart.destroy();
                if (pointsDistributionChart) pointsDistributionChart.destroy();

                // House Rankings - Horizontal Bar Chart
                const rankingsCtx = document.getElementById('houseRankingsChart');
                if (rankingsCtx) {
                    houseRankingsChart = new Chart(rankingsCtx, {
                        type: 'bar',
                        data: {
                            labels: ['Phoenix', 'Dragon', 'Griffin', 'Pegasus'],
                            datasets: [{
                                label: 'Total Points',
                                data: [5240, 4870, 3950, 1780],
                                backgroundColor: [
                                    'rgba(99, 102, 241, 0.75)',
                                    'rgba(20, 184, 166, 0.75)',
                                    'rgba(245, 158, 11, 0.75)',
                                    'rgba(139, 92, 246, 0.75)',
                                ],
                                borderColor: [
                                    'rgba(99, 102, 241, 1)',
                                    'rgba(20, 184, 166, 1)',
                                    'rgba(245, 158, 11, 1)',
                                    'rgba(139, 92, 246, 1)',
                                ],
                                borderWidth: 1.5,
                                borderRadius: 8,
                                borderSkipped: false,
                                barThickness: 36,
                            }],
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: '#1e293b',
                                    titleFont: {
                                        family: 'Inter',
                                        weight: '600',
                                        size: 13
                                    },
                                    bodyFont: {
                                        family: 'Inter',
                                        size: 12
                                    },
                                    padding: 12,
                                    cornerRadius: 8,
                                    displayColors: false,
                                },
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f1f5f9',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        font: {
                                            family: 'Inter',
                                            size: 11
                                        },
                                        color: '#94a3b8',
                                    },
                                    border: {
                                        display: false
                                    },
                                },
                                y: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            family: 'Inter',
                                            size: 12,
                                            weight: '500'
                                        },
                                        color: '#475569',
                                    },
                                    border: {
                                        display: false
                                    },
                                },
                            },
                        },
                    });
                }

                // Points Distribution - Doughnut Chart
                const distributionCtx = document.getElementById('pointsDistributionChart');
                if (distributionCtx) {
                    pointsDistributionChart = new Chart(distributionCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Phoenix', 'Dragon', 'Griffin', 'Pegasus'],
                            datasets: [{
                                data: [5240, 4870, 3950, 1780],
                                backgroundColor: [
                                    'rgba(99, 102, 241, 0.8)',
                                    'rgba(20, 184, 166, 0.8)',
                                    'rgba(245, 158, 11, 0.8)',
                                    'rgba(139, 92, 246, 0.8)',
                                ],
                                borderColor: '#ffffff',
                                borderWidth: 4,
                                hoverBorderWidth: 3,
                                hoverBorderColor: '#ffffff',
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '62%',
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true,
                                        pointStyleWidth: 10,
                                        pointStyleHeight: 10,
                                        font: {
                                            family: 'Inter',
                                            size: 12
                                        },
                                        color: '#475569',
                                    },
                                },
                                tooltip: {
                                    backgroundColor: '#1e293b',
                                    titleFont: {
                                        family: 'Inter',
                                        weight: '600',
                                        size: 13
                                    },
                                    bodyFont: {
                                        family: 'Inter',
                                        size: 12
                                    },
                                    padding: 12,
                                    cornerRadius: 8,
                                },
                            },
                        },
                    });
                }
            }

            // Initialize charts
            initCharts();

            // Re-initialize charts on window resize (debounced)
            let chartResizeTimeout;
            $(window).on('resize', function() {
                clearTimeout(chartResizeTimeout);
                chartResizeTimeout = setTimeout(function() {
                    if (houseRankingsChart) houseRankingsChart.resize();
                    if (pointsDistributionChart) pointsDistributionChart.resize();
                }, 250);
            });

        });
    </script>
@endsection
