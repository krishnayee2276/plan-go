-- Create booking_travelers table for storing traveler details
-- Run this SQL in your MySQL database (phpMyAdmin or command line)

CREATE TABLE IF NOT EXISTS booking_travelers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    traveler_type ENUM('Adult', 'Child') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

-- Also add customer_phone column to bookings table if it doesn't exist
ALTER TABLE bookings ADD COLUMN IF NOT EXISTS customer_phone VARCHAR(20) AFTER customer_email;
