<?php
require_once('../db/dbtest.php');
$userid = $_GET['userid'];
$checkcounter = 0;
if (!$userid) {
    echo "
        <p>아이디를 입력해주세요.</p>
        <center><input type=button value=창닫기 onclick='self.close()'></center>
        ";
} else {
    $sql = "SELECT * FROM register WHERE userid='.$userid.'";
    $result = oci_parse($connect, $sql);

    oci_execute($result);
    while ( $row = mysqli_fetch_array( $result ) ) {
        $userid_e = $row['userid'];
      }
      if ( $userid == $userid_e ) {
        $wu = 1;
      }
    if ($wu = 1) {
        echo "
                <p>이미 존재하는 아이디입니다.</p>
                <center><input type=button value=창닫기 onclick='self.close()'></center>
                ";
    } else {
        echo "
                <p>사용 가능한 아이디입니다.</p>
                <center><input type=button value=창닫기 onclick='self.close()'></center>
                ";
        
    }
}
?>
<!DOCTYPE html>
<html lang="kor">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>중복확인</title>
</head>

</html>