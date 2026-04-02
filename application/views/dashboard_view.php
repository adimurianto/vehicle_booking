<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<main id="main-container">
   <div class="content">
        <div class="row">
            <div class="col-12 p-3 p-md-4">
                
                <!-- SUMMARY CARDS ROW -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                        <div class="card bg-white text-dark h-100">
                            <div class="card-body px-3 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="mb-0 font-weight-bold"><?= number_format($chart['total_booking'] ?? 0) ?></h3>
                                        <p class="mb-0 opacity-75 text-dark">Total Booking</p>
                                    </div>
                                    <div>
                                        <i class="fa fa-bus fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                        <div class="card bg-white text-dark h-100">
                            <div class="card-body px-3 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="mb-0 font-weight-bold"><?= number_format($chart['approved'] ?? 0) ?></h3>
                                        <p class="mb-0 text-dark">Approved</p>
                                    </div>
                                    <div>
                                        <i class="fa fa-check-circle-o fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                        <div class="card bg-white text-dark h-100">
                            <div class="card-body px-3 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="mb-0 font-weight-bold"><?= number_format($chart['rejected'] ?? 0) ?></h3>
                                        <p class="mb-0 text-dark">Rejected</p>
                                    </div>
                                    <div>
                                        <i class="fa fa-times-circle-o fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-white text-dark h-100">
                            <div class="card-body px-3 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="mb-0 font-weight-bold"><?= number_format($chart['pending'] ?? 0) ?></h3>
                                        <p class="mb-0 text-dark">Pending</p>
                                    </div>
                                    <div>
                                        <i class="fa fa-clock-o fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CHART CARD -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white px-3 py-3">
                        <h5 class="mb-0"><i class="fa fa-bar-chart mr-2"></i> Grafik Booking</h5>
                    </div>
                    <div class="card-body px-3 py-3">
                        <canvas id="chartBooking" style="height: 350px; width: 100%;"></canvas>
                    </div>
                </div>

                <?php if($role !== "Approver"){?>
                    <!-- STATS FUEL & SERVICE -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="card bg-white shadow-sm h-100">
                                <div class="card-body px-3 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="text-muted mb-1">Total BBM Digunakan</h5>
                                            <h2 class="mb-0 font-weight-bold"><?= number_format($chart['fuel'] ?? 0) ?> <small class="text-muted">Liter</small></h2>
                                        </div>
                                        <div class="bg-light p-3 rounded-circle">
                                            <i class="fa fa-bars fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-white shadow-sm h-100">
                                <div class="card-body px-3 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="text-muted mb-1">Total Service</h5>
                                            <h2 class="mb-0 font-weight-bold"><?= number_format($chart['service'] ?? 0) ?> <small class="text-muted">Kali</small></h2>
                                        </div>
                                        <div class="bg-light p-3 rounded-circle">
                                            <i class="fa fa-wrench fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LOG AKTIVITAS TERBARU -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-white px-3 py-3">
                            <h5 class="mb-0"><i class="fa fa-history mr-2 text-secondary"></i> Aktivitas Terbaru</h5>
                        </div>
                        <div class="card-body px-3 py-3">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th><i class="fa fa-calendar mr-1"></i> Waktu</th>
                                            <th><i class="fa fa-user mr-1"></i> User</th>
                                            <th><i class="fa fa-info-circle mr-1"></i> Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($chart['logs']) && is_array($chart['logs'])): ?>
                                            <?php foreach($chart['logs'] as $log): ?>
                                                <tr>
                                                    <td class="text-nowrap"><?= htmlspecialchars($log->created_at ?? $log['created_at'] ?? '-') ?></td>
                                                    <td><?= htmlspecialchars($log->user_name ?? $log['user_name'] ?? '-') ?></td>
                                                    <td><?= htmlspecialchars($log->action ?? $log['action'] ?? '-') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Tidak ada aktivitas terbaru</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<script>
    var ctx = document.getElementById('chartBooking').getContext('2d');
    
    var months = <?= json_encode($chart['months'] ?? []) ?>;
    var counts = <?= json_encode($chart['counts'] ?? []) ?>;
    
    if (counts.length === 0) {
        counts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Booking',
                data: counts,
                backgroundColor: '#007bff',
                borderColor: '#0056b3',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: true
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Booking'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            }
        }
    });
</script>