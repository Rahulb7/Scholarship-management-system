<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    session_start();
    $currentUserID=$_SESSION['currentUserID'];
      if($currentUserID==NULL){
        header("Location:../index.php");
      }
        $conn = new mysqli("localhost","root","","sms");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if(isset($_POST['blk_unblk_app']) AND $_POST['blk_unblk_app'] == "blockapp"){
            $appID = $_POST['appID'];
            $app_sql = "UPDATE application SET previous_appstatus=appstatus, appstatus = 'inactive',previous_verifiedBySignatory=verifiedBySignatory, verifiedBySignatory = 'currently blocked' WHERE applicationID = '$appID'";
            if ($conn->query($app_sql) === TRUE) {
              ?>
              <script type="text/javascript">
                alert('Successfully Blocked Application');
                location.replace('../signatory/tempSigApplication.php');
              </script>
            <?php
            } else {
              ?>
                <script type="text/javascript">
                  alert( "Unable to Block Application");
                  location.replace('../signatory/tempSigApplication.php');
                </script>
              <?php
            }
        } else if(isset($_POST['blk_unblk_app']) AND $_POST['blk_unblk_app'] == "unblockapp"){
          $appID = $_POST['appID'];
          $app_sql = "UPDATE application SET appstatus = previous_appstatus, verifiedBySignatory = previous_verifiedBySignatory WHERE applicationID = '$appID'";
          if ($conn->query($app_sql) === TRUE) {
            ?>
            <script type="text/javascript">
              alert('Successfully UnBlocked Application');
              location.replace('../signatory/tempSigApplication.php');
            </script>
          <?php
          } else {
            ?>
              <script type="text/javascript">
                alert( "Unable to UnBlock Application");
                location.replace('../signatory/tempSigApplication.php');
              </script>
            <?php
          }
        } else{
          ?>
            <script type="text/javascript">
              alert('Invalid Request');
              location.replace('../signatory/tempSigHome.php');
            </script>
          <?php
        }
    ?>
  </body>
</html>
