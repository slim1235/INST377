<!DOCTYPE html>
<html>
<head>	
<style>
	div {
		margin-top: 20px;
		margin-bottom: 20px;
	}
</style>

<script>
function validateForm() {
    // you can write a code for validating your forms 
        (if you want).
}
</script>

</head>
<body>

<?php

$server = "localhost";
$username = "root";
$password = "root";
$db = "sakila";

// Create connection
$conn = mysqli_connect($server, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br><br>";


echo "<br><br>";

//  Task 1 :
//  "customer" table, select the 10th customer when sorted the "customer" table based on the "last_name" in alphabetical order. Also, join "address" and "city" tables when querying to the "customer" table.
    
$sql = "SELECT first_name, last_name, email, address, city from customer as c 
        JOIN address as a on c.address_id = a.address_id 
        JOIN city as t on t.city_id = a.city_id
        ORDER BY c.last_name DESC
        WHERE ROWNUM = 10
        ;";
//Save the query result in a PHP variable so that you can use it in the next task.
$result = mysqli_query($conn, $sql);

//# 2. Dynamic Form Generation 
echo "<form method='post' action='form_display.php' name='edit'>
<table class='container'>";
if (mysqli_num_rows($result) > 0) {   
    //$row always first row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='customer'></tr>
        <tr class='setting'>
        <td class='info'>
        First Name: <input name="first_name" type='text'><br>
        Last name: <input name="last_name" type='text'>
        <br>
        email: <input name="email" type='email'>
        <br>
        address: <input name="address" type='text'>
        <br>
        city: <input name="city" type='text'>
        <br>
        submit: <input class='save' name='update' value='update' type='submit'>
        </td></tr>";
    }
} else {
    echo "No results..";
}
echo "</table></form>";

// Close the connection.
mysqli_close($conn);
?>

</body>
</html>