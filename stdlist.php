<?php

include "MysqlDatabase.php";
include "Student.php";

$database = new MysqlDatabase();
$stud = new Student();
$stud->setDebug(1);
if(isset($_GET['delete'])){
	$delete_id=$_GET["delete"];
	$delete=$stud->deleteStudent($delete_id); 
	}

$student_insert = $stud->insertStudent($_POST);
$list=$stud->stdentList();



echo '<table border =1 style="width:100%">';
echo "<tr>";
echo " <th>id</th>";
echo " <th>name</th>";
echo " <th>age</th>";
echo " <th>sex</th>";
echo " <th>city</th>";
echo " <th>address</th>";
echo " <th>qualification</th>";
echo " <th>grade</th>";
echo " <th>delete</th>";
echo " <th>edit</th>";
echo "</tr>";

foreach ($list as $key => $value1) {
	echo "<tr>";
	echo "<td>". $value1["id"] . "</td>";
	echo "<td>". $value1["name"] . "</td>";
	echo "<td>". $value1["age"] . "</td>";
	echo "<td>". $value1["gender"] . "</td>";
	echo "<td>". $value1["city"] . "</td>";
	echo "<td>". $value1["address"] . "</td>";
	echo "<td>". $value1["qualification"] . "</td>";
	echo "<td>". $value1["grade"] . "</td>";	
	$id=$value1["id"];
	echo '<td> <a href="stdlist.php?delete='.$id.'" onclick= "return confirm(\'Are u sure ?\');"> DELETE </a></td> ';
	echo '<td> <a href="edit.php?edit='.$id.'" onclick= "return confirm(\'Are u sure ?\');"> EDIT </a></td> ';
	echo "</tr>";
	}
	echo  "</table> ";
			


?>


