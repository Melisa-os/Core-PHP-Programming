<?php

$users = [
    [
        'id' => 1,
        'fname' => 'Peter',
        'lname' => 'Andersen',
        'email' => 'peter@gmail.com'
    ],
    [
        'id' => 2,
        'fname' => 'John',
        'lname' => 'Miller',
        'email' => 'john@gmail.com'
    ],
    [
        'id' => 3,
        'fname' => 'Thomas',
        'lname' => 'Swift',
        'email' => 'thomas@gmail.com'
    ]
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Table</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>User Information</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
       
        for ($i = 0; $i < count($users); $i++) {
            echo "<tr>";
            echo "<td>" . $users[$i]['id'] . "</td>";
            echo "<td>" . $users[$i]['fname'] . "</td>";
            echo "<td>" . $users[$i]['lname'] . "</td>";
            echo "<td>" . $users[$i]['email'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
