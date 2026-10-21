<?php
include "includes/auth.php";
include "includes/db_config.php";
include "includes/header.php";
include "includes/sidebar.php";

/* ===============================
   FETCH ALL BOOKINGS
================================ */
$bookings = $pdo->query("
    SELECT 
        id,
        customer_name,
        customer_email,
        package_name,
        amount,
        booking_date,
        travel_date,
        travelers,
        status
    FROM bookings
    ORDER BY id DESC
")->fetchAll();

/* ===============================
   COUNT PENDING BOOKINGS
================================ */
$newBookingsCount = 0;
foreach ($bookings as $booking) {
    if ($booking['status'] === 'Pending') {
        $newBookingsCount++;
    }
}
?>

<div class="main">
    <div class="topbar">
        <div>
            <h1>Package Bookings</h1>
            <p class="welcome">Pending Bookings: <?= $newBookingsCount ?></p>
        </div>
    </div>

    <div class="content">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Package</th>
                    <th>Travel Date</th>
                    <th>Travelers</th>
                    <th>Amount</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($bookings) > 0): ?>
                    <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td>#<?= $b['id'] ?></td>
                            <td><?= htmlspecialchars($b['customer_name']) ?></td>
                            <td><?= htmlspecialchars($b['customer_email']) ?></td>
                            <td><?= htmlspecialchars($b['package_name']) ?></td>
                            <td><?= $b['travel_date'] ?></td>
                            <td><?= $b['travelers'] ?></td>
                            <td>₹<?= number_format($b['amount']) ?></td>
                            <td><?= $b['booking_date'] ?></td>
                            <td>
                                <?php if($b['status'] === 'Pending'): ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                                <?php elseif($b['status'] === 'Confirmed'): ?>
                                <span class="badge bg-success">Confirmed</span>
                                <?php elseif($b['status'] === 'Cancelled'): ?>
                                <span class="badge bg-danger">Cancelled</span>
                                <?php else: ?>
                                <span class="badge bg-secondary"><?= $b['status'] ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align:center;">No bookings found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "includes/footer.php"; ?>
