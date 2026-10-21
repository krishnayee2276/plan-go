<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed | Plan&Go</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1c1450;
            --accent: #fae013;
        }
        body { font-family: system-ui, sans-serif; background: linear-gradient(135deg, #f8fafc, #e2e8f0); min-height: 100vh; }
        .header { background: rgba(28,20,80,0.95); backdrop-filter: blur(20px); position: sticky; top: 0; z-index: 1000; }
        .logo { height: 40px; }
        .success-card { box-shadow: 0 20px 60px rgba(0,0,0,0.15); border: none; }
        .check-icon { font-size: 6rem; color: #198754; }
        .btn-home { background: var(--primary); color: white; border-radius: 50px; padding: 12px 32px; font-weight: 600; }
        footer { background: var(--accent); color: var(--primary); padding: 20px; margin-top: auto; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="header py-3">
        <div class="container">
            <a href="flight_booking.php"><img src="assets/images/logo.png" alt="Plan&Go" class="logo"></a>
        </div>
    </header>

    <div class="flex-grow-1 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card success-card text-center p-5">
                        <div class="check-icon mb-4">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h1 class="mb-3">Booking Confirmed!</h1>
                        <p class="lead text-muted mb-4">Your flight booking has been successfully processed. You'll receive a confirmation email shortly.</p>
                        
                        <?php
                        $booking_id = $_GET['booking_id'] ?? 'BK-XXXX';
                        ?>
                        
                        <div class="alert alert-success">
                            <strong>Booking ID:</strong> <span class="fw-bold text-primary"><?php echo htmlspecialchars($booking_id); ?></span>
                        </div>
                        
                        <div class="row g-3 justify-content-center">
                            <div class="col-auto">
                                <a href="flight_booking.php" class="btn btn-home">
                                    <i class="fas fa-plane me-2"></i>Book Another Flight
                                </a>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-outline-primary" onclick="printBooking('<?php echo $booking_id; ?>')">
                                    <i class="fas fa-print me-2"></i>Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Plan&Go. Safe travels! ✈️</p>
        </div>
    </footer>

    <script>
        function printBooking(bookingId) {
            window.print();
        }

        // Confetti animation
        setTimeout(() => {
            // Simple confetti effect
            const colors = ['#198754', '#1c1450', '#fae013'];
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'fixed';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.top = '-10px';
                confetti.style.width = '10px';
                confetti.style.height = '10px';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.borderRadius = '50%';
                confetti.style.pointerEvents = 'none';
                confetti.style.zIndex = '9999';
                confetti.style.animation = 'fall 3s linear forwards';
                document.body.appendChild(confetti);
                
                setTimeout(() => confetti.remove(), 3000);
            }
        }, 500);

        const style = document.createElement('style');
        style.textContent = `
            @keyframes fall {
                to {
                    transform: translateY(100vh) rotate(720deg);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>

