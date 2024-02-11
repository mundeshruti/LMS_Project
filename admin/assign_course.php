<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Data</title>

    <style>
        
        table {
            /* width: 100%; */
            border-collapse: collapse;
            font-size: 14px; /* Increased font size for better readability */
        }

        th,
        td {
            border: 1px solid #ddd;
         
        }

        th {
            background-color: #f2f2f2;
           
            color: #333; /* Darken the text color */
        }

        /* Styling for the form within the table */
        form {
            margin: 0;
        }

        /* Styling for the file input and submit button */
        input[type="file"] {
            display: inline-block;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Responsive styles for smaller screens */
        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table thead {
                display: none;
            }

            table tbody tr {
                border: 1px solid #ddd;
                margin-bottom: 10px;
                display: block;
            }

            table tbody td {
                display: block;
                text-align: center;
            }

            input[type="file"],
            input[type="submit"] {
                /* width: 100%; */
            }
        }
    </style>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lms_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT * FROM courses";
    $result = $conn->query($sql);

    // Check if there are rows in the result set
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table>
        <tr>
             <th>Course Name</th>
             <th>Date</th>
             <th>Course Description</th>
             <th>Course Link</th>
             <th>Practical Link</th>
             <th>Assign Course </th>
        </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["coursename"] . "</td>
                <td>" . $row["date"] . "</td>
                <td>" . $row["coursedescription"] . "</td>
                <td><a href='" . $row["courselink"] . "' target='_blank'>" . $row["courselink"] . "</a></td>
                <td><a href='" . $row["practicallink"] . "' target='_blank'>" . $row["practicallink"] . "</a></td>
                <td><a href='stdcourses.php'><button class='inline-btn'>Assign</button></a></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
    ?>
</body>

</html>