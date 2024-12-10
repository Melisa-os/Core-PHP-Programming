<?php
$servername = "localhost";
$username = "root"; 
$password = "Tele23@fon_lik"; 
$dbname = "user_data";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Konekcija nije uspela: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insert'])) {
       
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];

        $sql = "INSERT INTO users (fname, lname, email) VALUES ('$fname', '$lname', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Novi korisnik je uspešno unet.<br><br>";
        } else {
            echo "Greška: " . $sql . "<br>" . $conn->error . "<br><br>";
        }
    } elseif (isset($_POST['select'])) {
        
        $sql = "SELECT id, fname, lname, email FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Korisnici:</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["fname"] . "</td>
                        <td>" . $row["lname"] . "</td>
                        <td>" . $row["email"] . "</td>
                      </tr>";
            }
            echo "</table><br><br>";
        } else {
            echo "Nema podataka u bazi.<br><br>";
        }
    } elseif (isset($_POST['delete'])) {
        
        $id = $_POST['user_id'];

        $sql = "DELETE FROM users WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Korisnik je uspešno obrisan.<br><br>";
        } else {
            echo "Greška prilikom brisanja korisnika: " . $conn->error . "<br><br>";
        }
    }
}

// Zatvaranje konekcije
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
</head>
<body>
    <h2>Unesite podatke korisnika</h2>
    <form method="POST">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required><br><br>
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" name="insert" value="Insert">
        <input type="submit" name="select" value="Select">
        <input type="submit" name="delete_option" value="Delete"><br><br>
    </form>

    <?php
    
    if (isset($_POST['delete_option'])) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Konekcija nije uspela: " . $conn->connect_error);
        }

        $sql = "SELECT id, fname, lname FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Izaberite ID korisnika za brisanje:</h2>";
            echo "<form method='POST'>";
            echo "<select name='user_id'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['fname'] . " " . $row['lname'] . " (ID: " . $row['id'] . ")</option>";
            }
            echo "</select><br><br>";
            echo "<input type='submit' name='delete' value='Delete'>";
            echo "</form>";
        } else {
            echo "Nema korisnika za brisanje.<br><br>";
        }
        $conn->close();
    }
    ?>
</body>
</html>

