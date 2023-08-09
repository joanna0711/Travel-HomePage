<?php
session_start();
$UserID = $_SESSION['UserID'];
$db = '
(DESCRIPTION=
    (ADDRESS_LIST=
        (ADDRESS=(PROTOCOL=TCP)(HOST=203.249.87.57)(PORT=1521))
        )
    (CONNECT_DATA=
    (SID=orcl)
    )
)';
$connect = oci_connect("DBA2022G5", "test1234", $db);

if (!$connect) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$SQL = "DELETE FROM UserTable where UserID='$UserID'"; //지우겠다 전체를 
$result = oci_parse($connect, $SQL);
$success = oci_execute($result);

oci_free_statement($result);
oci_close($connect);

if ($success) {
    echo "<script>alert('회원탈퇴 완료');</script>";
    echo "<script type='text/javascript'>
      location.href='http://software.hongik.ac.kr/a_team/a_team5/project/main/main.html' 
      </script>";
    exit;
} else {
    echo "<script>alert('회원탈퇴 실패');</script>";
    echo "<script type='text/javascript'>
      location.href='http://software.hongik.ac.kr/a_team/a_team5/project/login/info.php' 
      </script>";
      exit;
}

?>