<?php

ini_set('display_errors', '1');
if (strtoupper($_SERVER['REQUEST_METHOD']) == "POST") {
  session_start();
  $session_userid = $_SESSION['UserID'];
  $session_username = $_SESSION['UserName'];
  if (is_null($session_userid)) {
    header('Location: login.php');
  }
  $ChangedUsername = $_POST['ChangedUsername'];
  $ChangedPassword = $_POST['ChangedPassword'];
  $CurrentPassword = $_POST['CurrentPassword'];
  $ChangedUserPhoneNumber = $_POST['ChangedUserPhoneNumber'];
  $ChangedUserDate = $_POST['ChangedUserDate'];
  $New_password = $_POST['new_password'];
  $New_password_confirm = $_POST['new_password_confirm'];
  $db = '
    (DESCRIPTION = 
        (ADDRESS_LIST=
            (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
        )
        (CONNECT_DATA = 
        (SID = orcl)
        )
    )';
  if (!is_null($CurrentPassword)) {
    $connect = oci_connect("DBA2022G5", "test1234", $db);
    $sql = "SELECT * FROM UserTable WHERE UserName = '$session_username'";
    $result = oci_parse($connect, $sql);
    oci_execute($result);
    while ($row = oci_fetch_array($result)) {
      $encrypted_password = $row['UserPassword'];
    }
    if (!empty($CurrentPassword)) {
      if (password_verify($CurrentPassword, $encrypted_password)) {
        if (!empty($ChangedPassword)) {
          if ($ChangedPassword == $New_password_confirm) {
            $changed_encrypted_password = password_hash($ChangedPassword, PASSWORD_DEFAULT);
            $sql_changed_user = "UPDATE UserTable SET UserPassword='" . $changed_encrypted_password . "',UserName='" . $ChangedUsername . "',\
                         UserDate=TO_DATE('$ChangedUserDate', 'YYYY-MM-DD'),UserPhoneNumber='" . $ChangedUserPhoneNumber . "' WHERE UserID='" . $UserID . "'";
            oci_execute(oci_parse($connect, $sql_changed_user));
            oci_close($connect);
            echo "<script>alert('회원정보가 수정 되었습니다');</script>";
            echo "<script type='text/javascript'>
              location.href='http://203.249.87.56:9302/5015/main/loginmain.php' 
              </script>";
          } else {
            echo "<script>alert('변경될 비밀번호 확인값이 누락됬거나 다릅니다.');</script>";
          }

        } else {
          if (!empty($New_password_confirm)) {
            echo "<script>alert('변경될 비밀번호를 입력해주세요.');</script>";
            #확인값만 있을경우
          } else {
            $sql_changed_user = "UPDATE UserTable SET UserPassword='" . $changed_encrypted_password . "',UserName='" . $ChangedUsername . "',\
                         UserDate=TO_DATE('$ChangedUserDate', 'YYYY-MM-DD'),UserPhoneNumber='" . $ChangedUserPhoneNumber . "' WHERE UserID='" . $UserID . "'";
            oci_execute(oci_parse($connect, $sql_changed_user));
            oci_close($connect);
            echo "<script>alert('회원정보가 수정 되었습니다');</script>";
            echo "<script type='text/javascript'>
            location.href='http://203.249.87.56:9302/5015/main/loginmain.php' 
              </script>";

          }

        }
      }
    }
  }
}
?>
<!doctype html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <title>회원정보 변경</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 14px;
    }

    input,
    button {
      font-family: inherit;
      font-size: inherit;
    }
  </style>
</head>

<body>
  <h1>비밀번호 변경</h1>
  <form action="update_proc.php" method="POST">
    <p><input type="hidden" name="UserID" value="<?php echo $session_userid;?>" ></p>
    <p><input type="hidden" name="Username" value="<?php echo $session_username; ?> "></p>
    <p><input type="password" name="CurrentPassword" placeholder="현재 비밀번호" required></p>
    <p><input type="password" name="ChangedPassword" placeholder="새 비밀번호" required></p>
    <p><input type="password" name="new_password_confirm" placeholder="새 비밀번호 확인" required></p>
    <p>핸드폰 번호 <input type="text" name="ChangedUserPhoneNumber" placeholder="010-0000-0000" required></p>
    <p>생년월일 <input type="date" name="ChangedUserDate" required></p>
    <p><input type="submit" value="회원정보 변경"></p>
  </form>
</body>

</html>