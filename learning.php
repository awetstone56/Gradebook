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
<!--student-->
    <h1 align ="center"><b>Gradebook</b></h1>
<form action="learning.php" method="post">
        Student Name: <br>
        <input type="text" name="name">
        <input type="submit" value="Add Student">
</form>
    
<!--class-->
<form action="learning.php" method="post">
        Class Name: <br>
        <input type="text" name="class">
        <input type="submit" value="Add Class">
</form>
    
<!--assignment-->
<form action="learning.php" method = "post"> <!-- Write your comments here -->
    <br><b>Create Assignment Category</b><br><br>
    Class ID number:<br>
    <input type="text" name="classID">
    <br>
    Name of Category:<br>
    <input type="text" name="category">
    <br>
    Weight of Category:<br>
    <input type="text" name="weight">
    <br><br>
    <input type="submit" value="Add Category">
    <br>
</form>
      

    
<!--for changing assignment type table-->
<form action="updateAssignment.php">
    <input type="submit" value="Change Category/View Categories">
    <br>
</form>
  
<?php
error_reporting(0);
$stmt = "SELECT classID FROM classes";
$check = $conn->query($stmt);
while($row = $check->fetch_assoc())
{
    $classID=$row["classID"];

    $stmt = "SELECT SUM(gradeWorth) AS newCol FROM assignmenttype WHERE classID='$classID'";
    $weightCheck = $conn->query($stmt);
    $weightCheck = $weightCheck->fetch_assoc();
    $weightCheck = (int) $weightCheck["newCol"];

    if($weightCheck!=100)
    {
        echo "ERROR total category percentage for class ".$classID." does not equal 100. Total percentage is: ".$weightCheck."<br>";
    }
    else
    {
        echo "Total category percentage for class ".$classID." equals 100.<br>";
    }
}
?>
    
<!--grade-->
<form action="learning.php" method="post">
    <br><b>Add Grade</b><br><br>
    Class ID number: <br> <input type="text" name="classID"> <br>
    Assignment category: <br> <input type="text" name="type"> <br>
    Assignment name: <br> <input type="text" name="assignmentName"> <br>
    Student name: <br> <input type="text" name="stuName"> <br>
    Grade: <br> <input type="text" name="grade"> <br><br>
<input type="submit" value="Add Grade">
</form>
    
<form action="updateGrade.php">
<input type="submit" value="Change Grades/View Grades">
</form>
    
<!--to go to final grade page-->
<form action="displayFinal.php">
    <input type="submit" value="View Final Grades">
</form>
    
</body>
</html>
  
<?php
error_reporting(0);
if($_POST!=NULL)
{
    //for studnet name
    if($_POST["name"]!=NULL)
    {
        echo $_POST["name"];

        $stuname = $_POST["name"];

        $sql = "INSERT INTO student (name) VALUES ('$stuname')";

        if ($conn->query($sql) === TRUE)
        {
            echo "New Student added successfully";
        } 
        else 
        {
            echo "Error: " . $conn->error;
        }
    }
    
    //for class name
    elseif($_POST["class"]!=NULL)
    {
        echo $_POST["class"];

        $className = $_POST["class"];

        $sql = "INSERT INTO classes (className) VALUES ('$className')";

        if ($conn->query($sql) === TRUE)
        {
            echo "New class added successfully";
        } 
        else 
        {
            echo "Error: " . $conn->error;
        }
    }
    
    //for assignment table
    elseif($_POST["classID"]!=NULL && $_POST["category"]!=NULL && $_POST["weight"]!=NULL)
    {
        echo $_POST["classID"].$_POST["category"].$_POST["weight"];

        $class = $_POST["classID"];
        $cate = $_POST["category"];
        $weight = $_POST["weight"];

        $sql = "INSERT INTO assignmenttype (classID,gradeWorth,type) VALUES ('$class','$weight','$cate')";

        if ($conn->query($sql) === TRUE)
        {
            echo "New assignment type created successfully";
        } 
        else 
        {
            echo "Error: " . $conn->error;
        }
    }
    
    //for adding a grade
    elseif($_POST["classID"]!=NULL&&$_POST["type"]!=NULL&&$_POST["assignmentName"]!=NULL&&$_POST["stuName"]!=NULL&&$_POST["grade"]!=NULL)
    {

        $classID = $_POST["classID"];
        $type = $_POST["type"];
        $assName = $_POST["assignmentName"];
        $studentName = $_POST["stuName"];
        $grade = $_POST["grade"];

        $sql = "SELECT studentID FROM student WHERE name = '$studentName'";
        
        $result = $conn->query($sql);
        $studentID = $result->fetch_assoc();
        $studentID = $studentID["studentID"];
        
        $sql = "INSERT INTO assignments (classID,type,assignmentName,studentID,grade) VALUES ('$classID','$type','$assName','$studentID','$grade')";
        
        if ($conn->query($sql) === TRUE)
        {
            echo "Assignment added successfully!";
        }
        else 
        {
            echo "Error: " . $conn->error;
        }
    }
}

$query = "SELECT * FROM classes";
$result = $conn->query($query);

echo "<table align='center' border=2px>"; // start a table tag in the HTML

//printing the classID table
echo "<tr><td>classID</td><td>className</td>";
while($row = $result->fetch_assoc()){   //Creates a loop to loop through results
echo "<tr><td>" . $row['classID'] . "</td><td>" . $row['className'] . "</td></tr>";
}

echo "</table>";
?>