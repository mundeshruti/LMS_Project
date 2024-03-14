<?php
// Include your database connection file
include 'connect_db.php';

// Function to fetch admin data based on date range
function fetchAdminData($conn, $from = null, $to = null) {
    // Initialize SQL query to fetch all admin data
    $sql = "SELECT * FROM register_student";

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

// Function to generate PDF
function generatePDF($result) {
    // Generate PDF
    require_once('libraries/tcpdf/tcpdf.php');

    // Create PDF instance
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('student Report');
    $pdf->SetHeaderData('', '', 'Student Report', '');
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Header
    $html = '<h1>Student Report</h1>';
    $html .= '<table border="1">';
    $html .= '<tr><th>Sr No.</th><th>Name</th><th>Email</th></tr>';

    // Fetch and add data to PDF
    $serialNumber = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $html .= '<td>' . $serialNumber . '</td>';
        $html .= '<td>' . $row['name'] . '</td>';
        $html .= '<td>' . $row['email'] . '</td>';
        $html .= '</tr>';
        $serialNumber++;
    }
    $html .= '</table>';

    // Write HTML content to PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF
    ob_end_clean(); // Clean the output buffer
    $pdf->Output('student_report.pdf', 'D');
    exit(); // Stop further execution after sending PDF
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

    // Generate and output PDF
    generatePDF($result);
} else {
    // Fetch all admin data
    $result = fetchAdminData($conn);

    if ($result === false) {
        // Handle database query error
        echo "Error fetching admin data.";
        exit;
    }

    // Generate and output PDF
    generatePDF($result);
}
?>


