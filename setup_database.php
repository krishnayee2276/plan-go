<?php
// Database setup script for Plan & Go Admin Dashboard

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plan_go_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db($dbname);

// Create tables
$tables = [
    "CREATE TABLE IF NOT EXISTS packages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        p_name VARCHAR(255) NOT NULL,
        category VARCHAR(100),
        duration INT,
        price_inr DECIMAL(10,2),
        price_usd DECIMAL(10,2),
        status VARCHAR(50) DEFAULT 'Active',
        image VARCHAR(255),
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(255) NOT NULL,
        customer_email VARCHAR(255),
        package_name VARCHAR(255),
        amount DECIMAL(10,2),
        status VARCHAR(50) DEFAULT 'Pending',
        booking_date DATE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE,
        phone VARCHAR(20),
        status VARCHAR(50) DEFAULT 'Active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS inquiries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        phone VARCHAR(20),
        destination VARCHAR(255),
        message TEXT,
        status VARCHAR(50) DEFAULT 'New',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS inquiry_replies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        inquiry_id INT NOT NULL,
        admin_message TEXT,
        suggested_packages TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (inquiry_id) REFERENCES inquiries(id) ON DELETE CASCADE
    )",

    "CREATE TABLE IF NOT EXISTS settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(255) UNIQUE,
        setting_value TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) UNIQUE,
        password VARCHAR(255),
        fullname VARCHAR(255),
        email VARCHAR(255),
        status VARCHAR(50) DEFAULT 'Active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS site_services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        service_name VARCHAR(255) UNIQUE,
        status VARCHAR(50) DEFAULT 'Active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

// Execute table creation
foreach ($tables as $table_sql) {
    if ($conn->query($table_sql) === TRUE) {
        echo "Table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}

// Alter bookings table to add customer_email column if missing
$alter_sql = "ALTER TABLE bookings ADD COLUMN customer_email VARCHAR(255) AFTER customer_name";
if ($conn->query($alter_sql) === TRUE) {
    echo "Bookings table altered successfully<br>";
} else {
    echo "Error altering bookings table: " . $conn->error . "<br>";
}

// Insert sample data
$sample_data = [
    "INSERT INTO packages (p_name, category, duration, price_inr, price_usd, status, description) VALUES
    ('Goa Beach Paradise', 'Domestic', 5, 25000, 300, 'Active', 'Relaxing beach vacation in Goa'),
    ('Kashmir Valley Tour', 'Domestic', 7, 35000, 420, 'Active', 'Beautiful valley experience'),
    ('Dubai Luxury Trip', 'International', 6, 75000, 900, 'Active', 'Luxury shopping and desert safari'),
    ('Thailand Adventure', 'International', 8, 55000, 660, 'Active', 'Island hopping and culture')",

    "INSERT INTO bookings (customer_name, customer_email, package_name, amount, status, booking_date) VALUES
    ('John Doe', 'john@example.com', 'Goa Beach Paradise', 25000, 'Confirmed', '2024-01-15'),
    ('Jane Smith', 'jane@example.com', 'Dubai Luxury Trip', 75000, 'Pending', '2024-01-20'),
    ('Mike Johnson', 'mike@example.com', 'Kashmir Valley Tour', 35000, 'Confirmed', '2024-01-10'),
    ('Sarah Wilson', 'sarah@example.com', 'Thailand Adventure', 55000, 'Cancelled', '2024-01-05')",

    "INSERT INTO users (name, email, phone, status) VALUES
    ('Alice Brown', 'alice@example.com', '+91 9876543210', 'Active'),
    ('Bob Davis', 'bob@example.com', '+91 9876543211', 'Active'),
    ('Charlie Wilson', 'charlie@example.com', '+91 9876543212', 'Blocked')",

    "INSERT INTO enquiries (name, email, message, status) VALUES
    ('David Lee', 'david@example.com', 'I am interested in your Goa package. Can you provide more details?', 'New'),
    ('Emma Taylor', 'emma@example.com', 'When is the best time to visit Kashmir?', 'Replied'),
    ('Frank Miller', 'frank@example.com', 'Do you offer customized packages?', 'New')",

    "INSERT INTO settings (setting_key, setting_value) VALUES
    ('site_title', 'Plan & Go Travel'),
    ('contact_email', 'info@plan-go.com'),
    ('currency', 'INR'),
    ('timezone', 'Asia/Kolkata')",

    "INSERT INTO admin_users (username, password, fullname, email, status) VALUES
    ('admin', '" . password_hash('admin123', PASSWORD_DEFAULT) . "', 'Administrator', 'admin@plan-go.com', 'Active')"
];

foreach ($sample_data as $data_sql) {
    if ($conn->query($data_sql) === TRUE) {
        echo "Sample data inserted successfully<br>";
    } else {
        echo "Error inserting sample data: " . $conn->error . "<br>";
    }
}

$conn->close();
echo "<br>Database setup completed! You can now access the admin dashboard.";
?>
