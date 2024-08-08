<!DOCTYPE html>
<html>
<head>
    <title>Complementary Product Analysis</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <?php
    // Enter your database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog_samples";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to find complementary product pairs, //p1,p2,oi1,oi2 are aliases
    $query = "SELECT p1.name AS product1, p2.name AS product2, COUNT(*) AS frequency
              FROM OrderItems oi1
              JOIN OrderItems oi2 ON oi1.order_id = oi2.order_id AND oi1.id < oi2.id
              JOIN Products p1 ON oi1.id = p1.id
              JOIN Products p2 ON oi2.id = p2.id
              GROUP BY oi1.id, oi2.id
              ORDER BY frequency DESC
              LIMIT 10";

    // Execute the query
    $result = $conn->query($query);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Create an array to store the data for the chart
        $data = array();

        // Create a table to display the results
        echo "<table>
                <tr>
                    <th>Product 1</th>
                    <th>Product 2</th>
                    <th>Frequency</th>
                </tr>";

        // Loop through the query results
        while ($row = $result->fetch_assoc()) {
            // Add the data for the chart
            $data[] = array(
                "product1" => $row["product1"],
                "product2" => $row["product2"],
                "frequency" => $row["frequency"]
            );

            // Display the table row
            echo "<tr>
                    <td>" . $row["product1"] . "</td>
                    <td>" . $row["product2"] . "</td>
                    <td>" . $row["frequency"] . "</td>
                </tr>";
        }

        echo "</table>";

        // Generate the chart using the data
        echo "<div id='chart'></div>
              <script>
                  var data = " . json_encode($data) . ";

                  var product1 = data.map(function(item) {
                      return item.product1;
                  });

                  var product2 = data.map(function(item) {
                      return item.product2;
                  });

                  var frequency = data.map(function(item) {
                      return item.frequency;
                  });

                  var trace = {
                      x: product1,
                      y: product2,
                      mode: 'markers',
                      marker: {
                          size: frequency,
                          sizemode: 'diameter',
                          sizeref: 0.1,
                          sizemin: 1
                      },
                      type: 'scatter'
                  };

                  var layout = {
                      title: 'Complementary Product Analysis',
                      xaxis: {
                          title: 'Product 1'
                      },
                      yaxis: {
                          title: 'Product 2'
                      }
                  };

                  var data = [trace];

                  Plotly.newPlot('chart', data, layout);
              </script>";
    } else {
        echo "No complementary product data found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>