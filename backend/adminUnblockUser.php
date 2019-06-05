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

        if(isset($_POST['unblockUser']) AND $_POST['unblockUser'] == "unblockStudent"){
            $studentID = $_POST['ID'];
            $student_sql = "UPDATE student SET status = 'active' WHERE studentID = '$studentID'";
            if ($conn->query($student_sql) === TRUE) {
              $app_sql = "UPDATE application SET appstatus = previous_appstatus, verifiedBySignatory = previous_verifiedBySignatory WHERE studentID = '$studentID'";
              if ($conn->query($app_sql) === TRUE) {
              ?>
                <script type="text/javascript">
                  alert('Successfully Unblocked the Student and corresponding Applicaitons');
                  location.replace('../tempStudentShow.php');
                </script>
              <?php
              } else {
                ?>
                  <script type="text/javascript">
                    alert( "Unable to Unblock Applications");
                    location.replace('../tempStudentShow.php');
                  </script>
                <?php
              }
            } else {
            ?>
              <script type="text/javascript">
                alert( "Unable to Unblock Student");
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
