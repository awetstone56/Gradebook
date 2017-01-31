<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gradebook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
<html>
<body>
    <h1 align = "center"><b>Update/View Grades</b></h1>
<form action="learning.php">
  <input type="submit" value="To Home Page">
</form> 

    
<!--Input Text boxes-->
<form action="updateGrade.php" method = "post">
    <br><b>Which row to delete?</b><br>
    Class ID:<br>
    <input type="text" name="classID">
    <br><br>
    Assignment type:<br>
    <input type="text" name="assignmentType">
    <br><br>
    Assignment name:<br>
    <input type="text" name="assignmentName">
    <br><br>
    Student:<br>
    <input type="text" name="stuName">
    <br><br>
    
    <input type="submit" value="Delete Row">
    <br><br>
</form>
    
</body>
</html>

<?php
error_reporting(0);

//checks for stuff in text boxes and deletes rows
if($_POST!=NULL)
{
    if($_POST["classID"]!=NULL && $_POST["assignmentType"]!=NULL && $_POST["assignmentName"]!=NULL && $_POST["stuName"]!=NULL )
    {
        $classID = $_POST["classID"];
        $cat = $_POST["assignmentType"];
        $assName = $_POST["assignmentName"];
        $stuName = $_POST["stuName"];
        
        //selects student Id associated with student name
        $sql = "SELECT studentID FROM student WHERE name = '$stuName'";
        $stuID = $conn->query($sql);
        $stuID = $stuID->fetch_assoc();
        $stuID = (int)$stuID["studentID"];
        
        //delete row
        $sql = "DELETE FROM assignments WHERE classID = '$classID' && type='$cat' && assignmentName='$assName' && studentID='$stuID'";
        if ($conn->query($sql) === TRUE)
        {
            echo "Assignment removed";
        } 
        else 
        {
            echo "Error: " . $conn->error;
        }
    }
}

//displaying assignment table
$sql = "SELECT * FROM assignments ORDER BY classID ASC, type ASC";
$result = $conn->query($sql);

echo "<table align='center' border=2px>"; // start a table tag in the HTML
echo "<tr><td>classID</td><td>type</td><td>assignment name</td><td>student</td><td>grade</td></tr>";
 while($row = $result->fetch_assoc()){
     
     //selecting name with student id
    $studentID = (int)$row['studentID'];
    $query = "SELECT name FROM student WHERE studentID = '$studentID'";
    $hold = $conn->query($query);
    $hold = $hold->fetch_assoc();
    $hold = $hold["name"];
    
    echo "<tr><td>" . $row['classID'] . "</td><td>" . $row['type'] . "</td><td>" . $row['assignmentName'] . "</td><td>". $hold . "</td><td>". $row['grade']. "</td></tr>";

 }
echo "</table>";


?>