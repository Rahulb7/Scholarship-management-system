<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
      $conn = new mysqli("localhost","root","","sms");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

        if(isset($_POST['blockUser']) AND $_POST['blockUser'] == "blockStudent"){
            $studentID = $_POST['ID'];
            $student_sql = "UPDATE student SET status = 'inactive' WHERE studentID = '$studentID'";
            if ($conn->query($student_sql) === TRUE) {
              $app_sql = "UPDATE application SET previous_appstatus=appstatus, appstatus = 'inactive',previous_verifiedBySignatory=verifiedBySignatory, verifiedBySignatory = 'currently blocked' WHERE studentID = '$studentID'";
              if ($conn->query($app_sql) === TRUE) {
              ?>
                <script type="text/javascript">
                  alert('Successfully Blocked the Student and corresponding Applicaitons');
                  location.replace('../tempStudentShow.php');
                </script>
              <?php
              } else {
                ?>
                  <script type="text/javascript">
                    alert( "Unable to Block Applications");
                    location.replace('../tempStudentShow.php');
                  </script>
                <?php
              }
            } else {
            ?>
              <script type="text/javascript">
                alert( "Unable to Block Student");
                location.replace('../tempStudentShow.php');
              </script>
            <?php
          }


        } else if(isset($_POST['blockUser']) AND $_POST['blockUser'] == "blockSignatory"){
          echo "Signatory";
        } else if(isset($_POST['blockUser']) AND $_POST['blockUser'] == "blockAdmin"){
          echo "Admin";
        } else{
          ?>
            <script type="text/javascript">
              alert('Invalid Page');
              location.replace("../tempAdmin.php");
            </script>
          <?php
        }
        $conn->close();
      ?>
  </body>
</html>
