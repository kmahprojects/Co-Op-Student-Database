<!doctype html>
<!-- (C) Kevin Mah and Kai Sugihara -->
<html>
<head>
    <title>Update a record of a table</title>
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
        $true = true;
	    $false = false;
        $null = NULL;
        $sql = "UPDATE $dbname.Student_Apply_Company_Position SET HIRED = :hired WHERE Student_ID = :stdId AND Company_Name = :cName AND Position = :position";
        $stmnt = $conn->prepare($sql);         // read about prepared statement here: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmnt->bindParam(':stdId', $_POST['stdId']);
        $stmnt->bindParam(':cName', $_POST['cName']);
        $stmnt->bindParam(':position', $_POST['position']);
        if ($_POST['hired'] == 'Hired'){
            $stmnt->bindParam(':hired', $true);
        }else if ($_POST['hired'] == 'Not Hired'){
            $stmnt->bindParam(':hired', $false);
        } else if ($_POST['hired'] == 'Status Pending') {
            $stmnt->bindParam(':hired', $null);
        }

        $stmnt->execute();
        echo "<p style='color:green'>Record Updated Successfully</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'>Record Update Failed: " . $err->getMessage() . "</p>\r\n";
    }
    // Close the connection
    unset($conn);

    echo "<a href='../index.html'>Back to the Homepage</a>";

    ?>
</body>

</html>