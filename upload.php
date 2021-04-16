<?php

$conn = mysqli_connect("localhost","root","","phpproject01");

if(isset($_POST["submit"])){

    $temp_location = $_FILES["file"]["tmp_name"];
    $csv_name = $_FILES["file"]["name"];

    move_uploaded_file($temp_location,"csv/" . $csv_name);

    $conn->query("INSERT INTO csv(name) VALUES('$csv_name')");
    $conn->close();

    header("location: csv.php");
}