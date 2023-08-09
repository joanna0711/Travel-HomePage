<html lang="en">
<head> 
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="info.css" rel="stylesheet"> 
<title>개인정보 수정하기</title>
<script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
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

//인포화면 - 세션입력 ,css

$con = oci_connect("DBA2022G5", "test1234", $db,'AL32UTF8');

if (!$con) {
echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
exit();
}
echo "디비 연결 성공";
$UserID = $_SESSION['UserID'];
$sql = "SELECT * FROM USERTABLE WHERE USERID='$UserID'";
$result = oci_parse($con,$sql);
oci_execute($result);
if(!$result){
        echo"데이터 없음";
}
else{
        echo"데이터 있음";
        $row = oci_fetch_array($result, OCI_ASSOC + OCI_RETURN_NULLS);
	$pw = $row["USERPASSWORD"];
	$name = $row['USERNAME'];
	$number = $row['USERPHONENUMBER'];
        $birth = $row['USERDATE'];
	$gender = $row['USERSEX'];

}
echo"$UserID";
echo "$name  $pw  $number  $birth  $gender";

    //값조회 -> 변수 저장해 -> post로 제대로 넘기고 인포에서 뷰인포로 넘기고 디비에 들어갔는지 확인
                //->value값에 저장할때는 html 잠깐 끊고 php 다시 실행??

                //(과정)
                //빈칸에 입력한값이 뷰인포에 포스트로 제대로 값 들어갔는지 1번
                //넌ㅁ어간 값으로 업데이트해서 디비 정보가 수정이 제대로되는지
                //Info 에서 디비정보조회되는지
                //input 태그안에서 빈칸안에 채워지게 ((value = 변수 ))출력시키는거
?>

<form name="info" method="post" action="view_info.php">
    <ul>
    <!--<li>아 &nbsp;이 &nbsp;디 : <input type="text" name="UserID" value = <?= $UserID?>  placeholder="영문&숫자"></li>-->
    <li>비밀번호 : <input type="password" name="UserPassword" value=<?= $pw?>  placeholder="영문&숫자"></li>
    <li>이&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;름 : <input type="name" name="UserName" value=<?=$name?>  placeholder="실명을 기입하세요."></li>
    <li>전화번호: <input type="text" value = <?=$number?>  name="PhoneNumber"></li>
    <li>생년월일 : <input type="text" name="UserDate" value = <?=$birth?>  placeholder="YYYYMMDD"></li>
        <li>성&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;별 : 남성 <input type="radio" name="UserSex" value="m">
            여성 <input type="radio" name="UserSex" value ="f"> </li>
        <li><input type="submit" value="저장"></li>
    </ul> 

    <!-- 글 내용 :<br> 
    <textarea rows="5" cols="60" name="content"></textarea>     
    <br><br> 
    <input type="submit" value="확인">  -->

</form>
</body>
</html>

