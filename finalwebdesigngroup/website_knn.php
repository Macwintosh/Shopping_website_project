<?php
require_once 'vendor/autoload.php';

use Phpml\Classification\KNearestNeighbors;

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "groupproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch sales records from the MySQL table
$query = "SELECT price, category FROM products";
$result = $conn->query($query);

$records = [];
$labels = [];

// Loop through the query results and populate the records and labels arrays
while ($row = $result->fetch_assoc()) {
    $records[] = [$row["price"]];
    $labels[] = $row["category"];
}

// Close the database connection
$conn->close();

// Split the dataset into training and testing sets
$splitRatio = 0.8;
$randomSeed = 42;
$datasetSize = count($records);
$trainSize = (int) ($splitRatio * $datasetSize);
$shuffleKeys = array_keys($records);
shuffle($shuffleKeys);
$trainKeys = array_slice($shuffleKeys, 0, $trainSize);
$testKeys = array_slice($shuffleKeys, $trainSize);

$trainSamples = [];
$trainLabels = [];
$testSamples = [];
$testLabels = [];

foreach ($trainKeys as $key) {
    $trainSamples[] = $records[$key];
    $trainLabels[] = $labels[$key];
}

foreach ($testKeys as $key) {
    $testSamples[] = $records[$key];
    $testLabels[] = $labels[$key];
}

// Create a k-NN classifier
$k = 5;
$classifier = new KNearestNeighbors($k);

// Train the classifier
$classifier->train($trainSamples, $trainLabels);

// Predict the labels for the test samples
$predictions = $classifier->predict($testSamples);

// Evaluate the accuracy of the predictions
$correctPredictions = 0;
$totalPredictions = count($predictions);

for ($i = 0; $i < $totalPredictions; $i++) {
    if ($predictions[$i] === $testLabels[$i]) {
        $correctPredictions++;
    }
}

$accuracy = $correctPredictions / $totalPredictions;

// Display the predictions and accuracy
echo "<h3 style='text-align: center'>Pricing Predictions:</h3>";
echo "<table style='margin: auto'>
        <tr>
            <th>Price &nbsp &nbsp</th>
			
            <th>Actual Category &nbsp &nbsp</th>
			
            <th>Predicted Category</th>
        </tr>";

for ($i = 0; $i < $totalPredictions; $i++) {
    echo "<tr>
            <td>" . $testSamples[$i][0] . "</td>
            <td>" . $testLabels[$i] . "</td>
            <td>" . $predictions[$i] . "</td>
        </tr>";
}

echo "</table>";

echo "<h3 style='text-align: center'>Accuracy: ". round($accuracy * 100, 2). "%</h3>";
?>