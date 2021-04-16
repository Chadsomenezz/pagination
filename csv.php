<?php

$conn = mysqli_connect("localhost","root","","phpproject01");

$result = $conn->query("SELECT * FROM csv");

$csv_list = [];
while($row = $result->fetch_object()){
    $csv_list[] = $row->name;
}

?>

<style>
    table tr{
        border: 1px solid black;
    }
</style>
<ul>
    <?php
        foreach ($csv_list as $csv){
            echo "<li><a href='csv.php?q=$csv'>$csv</a></li>";
        }
    ?>
</ul>


<?php



ini_set("auto_detect_line_endings",true);

$handler = fopen("csv/{$_GET['q']}","r");
$flag = true;
$recordCount = 0;
$header = [];


echo "<table>";
while( ($data = fgetcsv($handler)) !== FALSE){
    $num = count($data);


    if($flag) {
        $flag = false;
        echo "<tr>";
        foreach ($data as $csv_header){
            echo "<th>{$csv_header}</th>";
        }
        echo "</tr>";
        continue;
    } //to style the first row of the file

    $recordCount++;
    echo "<tr>";
    for($i=0;$i<$num;$i++){
        echo "<td>{$data[$i]}</td>";
    }
    echo "</tr>";
}
echo "</table>";
fclose($handler);

$recordCount = ceil($recordCount / 50);

echo "<div style='text-align: center'>";
for ($i=1;$i<=$recordCount;$i++){
    echo "<a href='csv.php?q=$csv&page=$i'><h3 style='display: inline-block; margin-left: 5px;'>$i</h3></a>";
}
echo "</div>";
?>