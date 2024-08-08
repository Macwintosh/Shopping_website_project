<?php
	// Enter your database credentials
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "groupproject";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	    // Query to find complementary product pairs, //p1,p2,oi1,oi2 are aliases
    $query = "SELECT name, category, price, quantity FROM products ";

    // Execute the query
    $result = $conn->query($query);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Create an array to store the data for the chart
        $data = array();

        // Create a table to display the results
        echo "<table style='margin: auto'>
                <tr>
                    <th>Name &nbsp &nbsp</th>
                    <th>Category &nbsp &nbsp</th>
                    <th>Price &nbsp &nbsp</th>
					<th>Stock</th>
                </tr>";

        // Loop through the query results
        while ($row = $result->fetch_assoc()) {
            // Add the data for the chart
            $data[] = array(
				"name" => $row["name"],
                "Category" => $row["category"],
                "Price" => $row["price"],
                "quantity" => $row["quantity"]
            );

            // Display the table row
            echo "<tr>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["category"] . "</td>
                    <td>" . $row["price"] . "</td>
					<td>" . $row["quantity"] . "</td>
                </tr>";
        }

        echo "</table>";
	
	
	
	}
?>