<?php
include "includes/auth.php";
include "includes/db_config.php";

// APPROVE BOOKING - Handle action BEFORE fetching bookings
if (isset($_GET['action']) && $_GET['action'] === 'approve' && isset($_GET['id'])) {
    $bookingId = intval($_GET['id']);
    $stmt = $pdo->prepare("UPDATE bookings SET status = 'Confirmed' WHERE id = ?");
    $stmt->execute([$bookingId]);
    header("Location: view_bookings.php");
    exit;
}

// CANCEL BOOKING - Handle action BEFORE fetching bookings
if (isset($_GET['action']) && $_GET['action'] === 'cancel' && isset($_GET['id'])) {
    $bookingId = intval($_GET['id']);
    $stmt = $pdo->prepare("UPDATE bookings SET status = 'Cancelled' WHERE id = ?");
    $stmt->execute([$bookingId]);
    header("Location: view_bookings.php");
    exit;
}

include "includes/header.php";
include "includes/sidebar.php";

/* ===============================
   FETCH ALL BOOKINGS
================================ */
$bookings = $pdo->query("
    SELECT 
        id,
        customer_name,
        package_name,
        travel_date,
        amount,
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
        <table class="table table-hover" style="border-collapse: separate; border-spacing: 0;">
            <thead>
                <tr style="background: linear-gradient(135deg, #2e2352 0%, #4a3f7f 100%); color: white;">
                    <th style="padding: 15px; border-top-left-radius: 8px;">ID</th>
                    <th style="padding: 15px;">Customer</th>
                    <th style="padding: 15px;">Package</th>
                    <th style="padding: 15px;">Travel Date</th>
                    <th style="padding: 15px;">Amount</th>
                    <th style="padding: 15px; border-top-right-radius: 8px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($bookings) > 0): ?>
                    <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td style="padding: 15px;"><strong>#<?= $b['id'] ?></strong></td>
                            <td style="padding: 15px;"><?= htmlspecialchars($b['customer_name']) ?></td>
                            <td style="padding: 15px;"><?= htmlspecialchars($b['package_name']) ?></td>
                            <td style="padding: 15px;"><?= $b['travel_date'] ?></td>
                            <td style="padding: 15px;"><strong style="color: #2e2352;">₹<?= number_format($b['amount']) ?></strong></td>
                            <td style="padding: 15px;">
                                <?php if($b['status'] === 'Pending'): ?>
                                <span class="badge" style="background: #ffc107; color: #2e2352; font-weight: 600; padding: 6px 12px;">Pending</span>
                                <a href="?action=approve&id=<?= $b['id'] ?>" class="btn btn-sm" style="background: #28a745; color: white; padding: 5px 12px; border-radius: 4px; text-decoration: none; margin-left: 8px;">Approve</a>
                                <a href="?action=cancel&id=<?= $b['id'] ?>" class="btn btn-sm" style="background: #dc3545; color: white; padding: 5px 12px; border-radius: 4px; text-decoration: none; margin-left: 4px;">Cancel</a>
                                <?php elseif($b['status'] === 'Confirmed'): ?>
                                <span class="badge" style="background: #28a745; color: white; font-weight: 600; padding: 6px 12px;">Confirmed</span>
                                <?php elseif($b['status'] === 'Cancelled'): ?>
                                <span class="badge" style="background: #dc3545; color: white; font-weight: 600; padding: 6px 12px;">Cancelled</span>
                                <?php else: ?>
                                <span class="badge" style="background: #6c757d; color: white; font-weight: 600; padding: 6px 12px;"><?= $b['status'] ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding: 40px;">No bookings found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "includes/footer.php"; ?>
