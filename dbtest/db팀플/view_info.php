<html> 
<head> 
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="info.css" rel="stylesheet"> 
</head> 
<body> 
<?php 
ini_set('display_errors', '0');

session_start();


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
echo "디비 연결 성공";

    // $id = $_POST["id"]; 				
    // $pass = $_POST["pass"]; 	
    // $name = $_POST["name"]; 	
    // $phone = $_POST["phonenumber"]; 	
    // $userdate= $_POST["userdate"]; 	
    // $sex = $_POST["sex"]; 	수정중..

    $UserID = $_SESSION["UserID"]; 				
    $UserPassWord = $_SESSION["UserPassword"]; 
    $UserName =$_SESSION("UserName");		
    $UserPhoneNumber = $_SESSION["UserPhoneNumber"]; 	
    $UserDate= $_SESSION["UserDate"]; 	
    $UserSex = $_SESSION["UserSex"]; 	

    $sql = "UPDATE USERTABLE SET USERID='$UserID',USERPASSWORD='$UserPassword',USERNAME='$UserName',USERPHONENUMBER='$UserPhoneNumber',USERDATE='$UserDate'USERSEX='$UserSex' WHERE USERID = '$UserID'";
    echo $sql;
    $ret = oci_execute(oci_parse($con, $sql));

//업데이트 문으로 조건 웨얼 유저 아이디는 프라이머리 키니까 수정불가하게 해야 SEt 다음에 웨얼 유저아이디는 세션에서 받은 아이디;


?>
    <ul>
        <li>아 &nbsp;이 &nbsp;디 : <?= $UserID?></li> 	
        <li>비밀번호 : <?=   $UserPassword?></li>  
        <li>이&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;름 :<?=$UserName?></li> 
        <li>전화번호 : <?=$UserPhoneNumber?></li> 
        <li>생년월일 : <?=$UserDate?></li> 
        <li>성&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;별: <?= $UserSex?></li> 		
    </ul> 

    
</body> 
</html>