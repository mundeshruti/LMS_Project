<?php
// Include your database connection file
include 'connect_db.php';

// Function to fetch admin data based on date range
function fetchAdminData($conn, $from = null, $to = null) {
    // Initialize SQL query to fetch all admin data
    $sql = "SELECT * FROM admins";

    // Check if a date range filter is provided
    if ($from !== null && $to !== null) {
        // Sanitize input values
        $from = mysqli_real_escape_string($conn, $from);
        $to = mysqli_real_escape_string($conn, $to);
        
        // Modify the SQL query to include the date range filter
        $sql .= " WHERE created_at >= '$from' AND created_at <= '$to'";
    }

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        // Handle query errors
        return false;
    }

    return $result;
}

// Function to generate Excel file
function generateExcel($result) {
    // Set headers for Excel file download
    header("Content-type: application/vnd.ms-excel");
    $filename = 'admin_report_' . date('Y-m-d_H-i-s') . '.xls';
    header("Content-Disposition: attachment; filename=$filename");

    // Output Excel file content
    echo "<table>";
    echo "<tr><th>Sr No.</th><th>Name</th><th>Email</th></tr>";
    $serialNumber = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$serialNumber}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "</tr>";
        $serialNumber++;
    }
    echo "</table>";
}

// Fetch data from the admins table based on the selected date range
if (isset($_GET['from']) && isset($_GET['to'])) {
    $from = $_GET['from'];
    $to = $_GET['to'];

    // Fetch admin data
    $result = fetchAdminData($conn, $from, $to);

    if ($result === false) {
        // Handle database query error
        echo "Error fetching admin data.";
        exit;
    }

    // Generate and output Excel file
    generateExcel($result);
} else {
    // Fetch all admin data
    $result = fetchAdminData($conn);

    if ($result === false) {
        // Handle database query error
        echo "Error fetching admin data.";
        exit;
    }

    // Generate and output Excel file
    generateExcel($result);
}
?>
