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
    <h1 align = "center"><b>Update/View Assignment Categories</b></h1>
<form action="learning.php">
  <input type="submit" value="To Home Page">
</form> 

<!--Input Text boxes-->
<form action="updateAssignment.php" method = "post">
    <br><b>Which row to delete?</b><br>
    Class ID:<br>
    <input type="text" name="classID">
    <br><br>
    Catagory type:<br>
    <input type="text" name="category">
    <br><br>
    
    <input type="submit" value="Delete Row">
    <br><br>
</form>
    
</body>
</html>

<?php
error_reporting(0);

echo "</table>";
//checks for stuff in text boxes and deletes rows
if($_POST!=NULL)
{
    if($_POST["classID"]!=NULL && $_POST["category"]!=NULL)
    {
        $classID = $_POST["classID"];
        $cat = $_POST["category"];

        $sql = "DELETE FROM assignmenttype WHERE classID = '$classID' && type='$cat'";

        if ($conn->query($sql) === TRUE)
        {
            echo "Assignment category removed";
        } 
        else 
        {
            echo "Error: " . $conn->error;
        }
    }
}

//display table
$query = "SELECT * FROM assignmenttype ORDER BY classID ASC";
$result = $conn->query($query);

echo "<table align='left' border=2px>"; // start a table tag in the HTML

echo "<tr><td>classID</td><td>gradeWorth</td><td>type</td>";
while($row = $result->fetch_assoc()){   //Creates a loop to loop through results
echo "<tr><td>" . $row['classID'] . "</td><td>" . $row['gradeWorth'] . "</td><td>" . $row['type']. "</td></tr>";
}

?>