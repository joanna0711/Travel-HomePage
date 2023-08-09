<?php
$db = '
(DESCRIPTION =
(ADDRESS_LIST=
    (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orcl)
)
)';


$con = oci_connect("DBA2022G5", "test1234", $db, 'AL32UTF8');

if (!$con) {
    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
    exit();
}
session_start();
$loged_ID = $_SESSION['UserID']; //로그인아이디 할당받기 
    $num = $_GET['num'];    // 몇번째 댓글인지  // 포스트보다 보안성이 좀 떨어짐
$content = $_POST['content']; //댓글내용
$comment_date = date("Y-m-d H:i:s"); //댓글시간
$sql = "INSERT INTO COMENTTABLE(COMENT, COMENT_DATE, USERID, NUM) values('$content', '$comment_date', '$loged_ID', '$num')";
$result = oci_execute(oci_parse($con, $sql));
    if($result){
        echo "<script>location.replace('http://software.hongik.ac.kr/a_team/a_team5/project/post/view_post.php?num=$num');</script>";
    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    }
?>
