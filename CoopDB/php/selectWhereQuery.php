<!doctype html>
<!-- (C) Kevin Mah and Kai Sugihara -->
<html>
<head>
    <title>Display Records of a table</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <?php
    $servername = "localhost";
    $dbname = "Coop";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color:green'>Connection Was Successful</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'> Connection Failed: " . $err->getMessage() . "</p>\r\n";
    }

    try {
        $sql = "SELECT Student_ID,Company_Name,Application_Date,Position,Hired FROM Student_Apply_Company_Position WHERE Company_Name = '$_POST[comp]'";

        $stmnt = $conn->prepare($sql);

        $stmnt->execute();

        $row = $stmnt->fetch();
        if ($row) {
            echo '<table>';
            echo '<tr> <th>StudentID</th> <th>Company Name</th> <th>Application Date</th> <th>Position</th> <th>Hired</th> </tr>';
            do {
                echo "<tr><td>$row[Student_ID]</td><td>$row[Company_Name]</td><td>$row[Application_Date]</td><td>$row[Position]</td><td>";
                if ("$row[Hired]" == 1){
                    echo "Hired</td></tr>";
                } else if ("$row[Hired]" == 0) {
                    echo "Not Hired</td></tr>";
                } else {
                    echo "Status Pending</td></tr>";
                }
            } while ($row = $stmnt->fetch());
            echo '</table>';
        } else {
            echo "<p> No Record Found!</p>";
        }
    } catch (PDOException $err) {
        echo "<p style='color:red'>Record Retrieval Failed: " . $err->getMessage() . "</p>\r\n";
    }
    // Close the connection
    unset($conn);

    echo "<a href='../index.html'>Back to the Homepage</a>";

    ?>
</body>

</html>