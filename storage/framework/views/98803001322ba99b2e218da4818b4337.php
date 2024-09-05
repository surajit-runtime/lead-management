<?php $__env->startSection('main-container'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Boxes at the Top -->
            <div class="row mb-4">
                <!-- Box 1: Monthly Campaigns -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Campaigns</h5>
                            <p>Total: <?php echo e(array_sum($monthlyCounts)); ?></p>
                        </div>
                    </div>
                </div>
                <!-- Box 2: Flags -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Campaigns by Flag</h5>
                            <p>Total: <?php echo e(array_sum($flagCounts)); ?></p>
                        </div>
                    </div>
                </div>
                <!-- Box 3: Channels -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Campaigns by Channel</h5>
                            <p>Total: <?php echo e(array_sum($channelCounts)); ?></p>
                        </div>
                    </div>
                </div>
                <!-- Box 4: Success Status -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Success Status</h5>
                            <p>Total: <?php echo e(array_sum($successStatusCounts)); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row">
                <!-- Chart 1: Monthly Campaigns -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Campaigns</h5>
                            <div class="chart-container">
                                <canvas id="monthlyCampaignsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart 2: Campaigns by Flag -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Campaigns by Flag</h5>
                            <div class="chart-container">
                                <canvas id="flagChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart 3: Campaigns by Channel -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Campaigns by Channel</h5>
                            <div class="chart-container">
                                <canvas id="channelChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart 4: Success Status -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Success Status</h5>
                            <div class="chart-container">
                                <canvas id="successStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Initialize Charts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Campaigns Chart
        var ctx1 = document.getElementById('monthlyCampaignsChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($monthlyMonths, 15, 512) ?>,
                datasets: [{
                    label: 'Monthly Campaigns',
                    data: <?php echo json_encode($monthlyCounts, 15, 512) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Campaigns by Flag Chart
        var ctx2 = document.getElementById('flagChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($flagKeys, 15, 512) ?>,
                datasets: [{
                    label: 'Campaigns by Flag',
                    data: <?php echo json_encode($flagCounts, 15, 512) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        // Campaigns by Channel Chart
        var ctx3 = document.getElementById('channelChart').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($channelKeys, 15, 512) ?>,
                datasets: [{
                    label: 'Campaigns by Channel',
                    data: <?php echo json_encode($channelCounts, 15, 512) ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Success Status Chart
        var ctx4 = document.getElementById('successStatusChart').getContext('2d');
        new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($successStatusKeys, 15, 512) ?>,
                datasets: [{
                    label: 'Success Status',
                    data: <?php echo json_encode($successStatusCounts, 15, 512) ?>,
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Runtime\Lead Management Project files\Lead management\resources\views/frontend/charts/index.blade.php ENDPATH**/ ?>