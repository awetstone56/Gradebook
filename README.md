# Gradebook
Gradebook Overview
--------
The application keeps tracks of a teacher’s classes, students, and graded assignments. It uses this data to efficiently calculate the final grade. It also allows the teacher to view all this information in organized tables.

How to Install and Run Application
----------------------------------
Before Installation XAMPP needs to be installed. Start Apache and MySQL in XAMPP. The next step is to put the necessary source code files into the right place. Place the folder “Gradebook” and place it into C:/xampp/htdocs. To run the program, type localhost/gradebook into an internet browser. Then select “learning.php.”

Add Student
-----------
To add a student, enter his or her name into the text box called “Student Name” and click the button “Add Student”.
Add Class
To add a class, enter the class name into the text box under “Class Name” and click the button “Add Class”.
Add Assignment Category
To add an assignment category to a class use the text boxes under “Create Assignment Category” to enter in the class ID, name of the assignment category, and the weight that category would have in the class. Use 0-100 for the category percentage. To find out the class ID, the homepage displays a table showing class ID and the class name. If the total percentage for a class is not equal to 100 an error will be displayed. If it does equal 100, a message will let the user know that it equals 100.


Delete Assignment Category
--------------------------
If a category is entered in incorrectly or is incorrect the solution is to go to “Change Category/View Categories”. This will take you to a different page where all of the assignment category’s for all the classes and their weights are displayed. To delete a row, enter in its corresponding data into the text field and click “Delete Row”. This will delete that assignment category and all assignments that belong to that category.

Add Grade
---------
To add a grade, stay on the homepage and use the text boxes under “Add Grade.” Enter the class ID(can be found in table), assignment category, student name, and grade. Once all boxes are filled with the right data select “Add Grade.” Make sure to fill in all grades for all assignment categories for each student.

Delete Grade
------------
If a grade is entered incorrectly the only option is to delete the grade and reenter it. Select “Change Grades/View Grades”. This will take you to a different page that will display all the grades in all the classes. To delete a row, enter the data into the text boxes that you would like to delete and select “Delete Row.”

View Final Grades
-----------------
To view the final grades select “View Final Grades.” This will calculate the final grades for all the students and display them. If the grade percentage is not 100% for all the classes the final grades will not be shown. Make sure to enter in all data and that the data was entered correctly before viewing final grades. 
