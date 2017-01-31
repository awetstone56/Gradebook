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
    <h1 align = "center"><b>Final Grades</b></h1>
<body>


<?php
    error_reporting(0);
    
    $flag = true;
    
    $stmt = "SELECT DISTINCT classID, studentID FROM assignments"; 
    $result=$conn->query($stmt);
    
    //fills first two columns of finalgrade table
    while($IDs = $result->fetch_assoc())
    {
        $classID=(int)$IDs["classID"];
        $stuID=(int)$IDs["studentID"];
        $stmt = "INSERT INTO finalgrade (classID,studentID) VALUES ('$classID','$stuID')";
            
        if ($conn->query($stmt) === TRUE)
        {
            
        }
        else 
        {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    //checks category worth sum = 100
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
            echo "ERROR total category percentage for class ".$classID." does not equal 100";
            $flag=false;
        }
    }
    
    
    if($flag)
    {
        //calculates finale grades for all students in the final grade table
        $stmt = "SELECT classID,studentID FROM finalgrade";
        $step1 = $conn->query($stmt);
        $gradeSum = 0;
        $weight = 0;

        //fetches class id and student id from finalgrade table
        while($IDs = $step1->fetch_assoc())
        {
            $classID=(int)$IDs["classID"];
            $stuID=(int)$IDs["studentID"];

            $stmt = "SELECT classID,gradeWorth,type FROM assignmenttype WHERE classID = '$classID'";
            $step2 = $conn->query($stmt);

            //calculates the average grade for the student
            while($assType = $step2->fetch_assoc())
            {
                $weight=(int)$assType["gradeWorth"];
                $type = $assType["type"];

                $stmt = "SELECT AVG(grade) AS avgGrade FROM assignments WHERE type = '$type' && studentID = '$stuID' && classID = '$classID'";
                $step3 = $conn->query($stmt);
                $hold = $step3->fetch_assoc();

                $gradeSum = $gradeSum + ($hold["avgGrade"])*($weight/100);
            }

            //updates the table to store the grade
            $stmt = "UPDATE finalgrade SET finalGrade = '$gradeSum' WHERE classID = '$classID' && studentID = '$stuID'";
            $conn->query($stmt);

            $gradeSum = 0;
        }

        //display table of final grades
        $query = "SELECT * FROM finalgrade ORDER BY classID";
        $result = $conn->query($query);

        echo "<table align='center' border=2px>"; // start a table tag in the HTML

        echo "<tr><td>Class</td><td>Student</td><td>Final Grade</td>";
        while($row = $result->fetch_assoc()){   //Creates a loop to loop through results
            $studentID = (int)$row['studentID'];
            $query = "SELECT name FROM student WHERE studentID = '$studentID'";
            $hold = $conn->query($query);
            $hold = $hold->fetch_assoc();
            $hold = $hold["name"];

            $classID = (int)$row['classID'];
            $query = "SELECT className FROM classes WHERE classID='$classID'";
            $cu = $conn->query($query);
            $cu = $cu->fetch_assoc();
            $cu = $cu["className"];

            echo "<tr><td>" . $cu . "</td><td>" . $hold ."</td><td>" . $row['finalGrade']. "</td></tr>";
        }

        echo "</table>";
    }
?>  
<form action="learning.php">
    <input type = "submit" value = "To Home Page">
</form>
</body>
</html>