<?php
include '../includes/config.php'; // Assuming this has $conn

header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // INSERT or UPDATE
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            $data = $_POST;
        }

        $id = $data['id'] ?? null;
        $p_name = $data['p_name'];
        $category = ucfirst(strtolower($data['category']));
        $price_inr = $data['price_inr'];
        $price_usd = $data['price_usd'] ?? null;
        $duration = $data['duration'];
        $description = $data['description'];
        $status = $data['status'];
        $slug = strtolower($data['slug']);
        $visa_status = $data['visa_status'] ?? null;
        $stay_type = $data['stay_type'] ?? null;
        $cuisine = $data['cuisine'] ?? null;
        $car_rental = $data['car_rental'] ?? null;
        $cuisine_name = $data['cuisine_name'] ?? null;
        $car_link = $data['car_link'] ?? null;

        // Handle image uploads
        $upload_dir = '../admin/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $p_image = '';
        if (isset($_FILES['p_image']) && $_FILES['p_image']['error'] == 0) {
            $file_name = basename($_FILES['p_image']['name']);
            $target_file = $upload_dir . $file_name;
            if (move_uploaded_file($_FILES['p_image']['tmp_name'], $target_file)) {
                $p_image = $file_name;
            } else {
                echo json_encode(['success' => false, 'message' => 'Package image upload failed']);
                exit;
            }
        }

        $cuisine_image = '';
        if (isset($_FILES['cuisine_image']) && $_FILES['cuisine_image']['error'] == 0) {
            $file_name = basename($_FILES['cuisine_image']['name']);
            $target_file = $upload_dir . $file_name;
            if (move_uploaded_file($_FILES['cuisine_image']['tmp_name'], $target_file)) {
                $cuisine_image = $file_name;
            } else {
                echo json_encode(['success' => false, 'message' => 'Cuisine image upload failed']);
                exit;
            }
        }

        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $file_name = basename($_FILES['image']['name']);
            $target_file = $upload_dir . $file_name;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $file_name;
            } else {
                echo json_encode(['success' => false, 'message' => 'Additional image upload failed']);
                exit;
            }
        }

        if ($id) {
            // UPDATE
            $sql = "UPDATE packages SET p_name=?, category=?, price_inr=?, price_usd=?, duration=?, description=?, status=?, slug=?, visa_status=?, stay_type=?, cuisine=?, car_rental=?, cuisine_name=?, car_link=?";
            $params = [$p_name, $category, $price_inr, $price_usd, $duration, $description, $status, $slug, $visa_status, $stay_type, $cuisine, $car_rental, $cuisine_name, $car_link];
            $types = 'ssddssssssssss';
            if ($p_image) {
                $sql .= ", p_image=?";
                $params[] = $p_image;
                $types .= 's';
            }
            if ($cuisine_image) {
                $sql .= ", cuisine_image=?";
                $params[] = $cuisine_image;
                $types .= 's';
            }
            if ($image) {
                $sql .= ", image=?";
                $params[] = $image;
                $types .= 's';
            }
            $sql .= " WHERE id=?";
            $params[] = $id;
            $types .= 'i';

            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
        } else {
            // INSERT
            $sql = "INSERT INTO packages (p_name, category, price_inr, price_usd, duration, description, p_image, status, slug, visa_status, stay_type, cuisine, car_rental, cuisine_name, cuisine_image, car_link, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssddsssssssssssss', $p_name, $category, $price_inr, $price_usd, $duration, $description, $p_image, $status, $slug, $visa_status, $stay_type, $cuisine, $car_rental, $cuisine_name, $cuisine_image, $car_link, $image);
        }

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => $id ? 'Package updated' : 'Package added']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
        }
        break;

    case 'DELETE':
        // DELETE
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];

        $stmt = $conn->prepare("DELETE FROM packages WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Package deleted']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        break;
}

$conn->close();
?>
