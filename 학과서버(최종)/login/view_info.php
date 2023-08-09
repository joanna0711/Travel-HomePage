<?php
include_once "/var/www/html/a_team/a_team5/project/login/encrypted_password.php";
ini_set('display_errors', '1');




$db = '
(DESCRIPTION = 
(ADDRESS_LIST=
    (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
)
(CONNECT_DATA = 
(SID = orcl)
)
)';


$con = oci_connect("DBA2022G5", "test1234", $db);

if (!$con) {
	echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
	exit();
}
session_start();
$UserID = $_SESSION['UserID'];
$UserName = $_POST["UserName"];
$UserPhoneNumber = $_POST["PhoneNumber"];
$UserDate = $_POST["UserDate"];
$UserSex = $_POST["UserSex"];
$prevpassword = $_POST["prevpassword"];
$newpassword = $_POST["newpassword"];



if ($prevpassword == null) {
	echo "<script>alert('비밀번호란이 비어있습니다.')</script>";
	echo "<script>location.replace('info.php');</script>";
	exit;
}
if ($newpassword == null) {
	echo "<script>alert('비밀번호확인란이 비어있습니다.')</script>";
	echo "<script>location.replace('info.php');</script>";
	exit;
}
if ($prevpassword != $newpassword) {
	echo "<script>alert('비밀번호 확인 틀림')</script>";
	echo "<script>location.replace('info.php');</script>";
	exit;
}


$sqls = "SELECT * FROM USERTABLE WHERE USERID='$UserID'";
$stir = oci_parse($con, $sqls);
oci_execute($stir);

while (($row2 = oci_fetch_array($stir, OCI_ASSOC)) == true) {
	$pwpw = $row2['USERPASSWORD'];

	if ((password_verify($newpassword, $pwpw))) {
		echo "<script>alert('중복된 비밀번호 입니다')</script>";
		echo "<script>location.replace('info.php');</script>";
		exit;
	} else {
		$new_encrypt_pw = password_hash($newpassword, PASSWORD_DEFAULT);
		$sql = "UPDATE USERTABLE SET USERPASSWORD = '$new_encrypt_pw', USERNAME = '$UserName', USERPHONENUMBER = '$UserPhoneNumber', USERDATE = TO_DATE('$UserDate', 'YYYY-MM-DD'), USERSEX = '$UserSex' WHERE USERID = '$UserID'";
		$result = oci_parse($con, $sql);
		$success = oci_execute($result);
		//echo "<script>alert('변경이 완료되었습니다.');</script>";
		//cho "<script>location.replace('./../login/info.php');</script>";
		oci_free_statement($result);
	}
}
oci_free_statement($stir);
oci_close($con);

if ($success) {
	echo "<script>alert('변경이 완료되었습니다.');</script>";
	echo "<script>location.replace('./../login/loginmain.php');</script>";
} else {
	echo "<script>alert('변경을 실패하였습니다.');</script>";
	echo "<script>location.replace('http://software.hongik.ac.kr/a_team/a_team5/project/login/loginmain.php');</script>";
}
//업데이트 문으로 조건 웨얼 유저 아이디는 프라이머리 키니까 수정불가하게 해야 SEt 다음에 웨얼 유저아이디는 세션에서 받은 아이디;
?>



</body>

</html>