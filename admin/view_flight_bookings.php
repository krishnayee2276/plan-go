<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Bookings | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1c1450;
            --accent: #fae013;
        }
        body { background: #f8f9fa; }
        .sidebar { background: var(--primary); min-height: 100vh; }
        .content { padding: 2rem; }
        .status-success { color: #198754; }
        .status-pending { color: #ffc107; }
        .status-failed { color: #dc3545; }
        .card { box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075); }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3 text-white">
            <h4 class="mb-4"><i class="fas fa-plane me-2"></i>Plan&Go Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white active" href="view_flight_bookings.php">Flight Bookings</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../packages.php">Packages</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../admin/users.php">Users</a></li>
            </ul>
        </div>
        
        <div class="flex-grow-1">
            <?php include 'includes/header.php'; ?>
            <div class="content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Flight Bookings Dashboard</h2>
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" onclick="filterStatus('all')"><i class="fas fa-list"></i> All</button>
                        <button class="btn btn-outline-success" onclick="filterStatus('Success')"><i class="fas fa-check"></i> Success</button>
                        <button class="btn btn-outline-warning" onclick="filterStatus('Pending')"><i class="fas fa-clock"></i> Pending</button>
                    </div>
                </div>

                <?php
                require_once '../api/db_config.php';
                $where = "1=1";
                if (isset($_GET['status'])) {
                    $where .= " AND payment_status = '" . $conn->real_escape_string($_GET['status']) . "'";
                }
                $sql = "SELECT * FROM flight_bookings WHERE $where ORDER BY created_at DESC";
                $result = $conn->query($sql);
                ?>

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Customer</th>
                                        <th>Flight</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($row['booking_id']); ?></strong></td>
                                        <td>
                                            <div><?php echo htmlspecialchars($row['user_name']); ?></div>
                                            <small><?php echo htmlspecialchars($row['email']); ?></small><br>
                                            <small><?php echo htmlspecialchars($row['mobile']); ?></small>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['flight_no']); ?></td>
                                        <td><strong>₹<?php echo number_format($row['fare_amount'], 0); ?></strong></td>
                                        <td>
                                            <span class="badge <?php 
                                                echo $row['payment_status'] == 'Success' ? 'bg-success' : 
                                                     ($row['payment_status'] == 'Pending' ? 'bg-warning' : 'bg-danger'); 
                                            ?>">
                                                <?php echo $row['payment_status']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d M Y H:i', strtotime($row['created_at'])); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="viewDetails('<?php echo $row['booking_id']; ?>')">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php if ($result->num_rows == 0): ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3"></i>
                                            <p>No flight bookings found</p>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <script>
        function filterStatus(status) {
            window.location.href = '?status=' + status;
        }

        function viewDetails(bookingId) {
            // Modal or redirect to details
            alert('Booking details for ' + bookingId + ' (implement modal)');
        }
    </script>
</body>
</html>

