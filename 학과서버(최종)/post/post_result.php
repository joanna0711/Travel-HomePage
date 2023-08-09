me="viewport" content="width=device-width" initial-scale=1.0>

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


$con = oci_connect("DBA2022G5", "test1234", $db, 'AL32UTF8');

if (!$con) {
echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
exit();
}
echo "디비 연결 성공";

    // 사진데이터 처리
    /*$file_name = $_FILES['photo']['name'];
    $tmp_file = $_FILES['photo']['tmp_name'];
    $file_path='./img/'.$file_name;
    move_uploaded_file($tmp_file, $file_path);
    echo "img폴더에 사진 등록 완료";*/

    // $sql = "insert into ProductInformation (IMG) values ('$file_name')";
    // $ret = oci_execute(oci_parse($con, $sql));

    
$UserID = $_SESSION['UserID'];
if(!isset($UserID)){
echo "아이디 안불러와짐";
}
else{
echo "ID : $UserID";
}
$Title = $_POST["Title"];
echo "$Title";
$Content = $_POST["Content"];
echo "$Content";

    //$photo = $file_name;
    $Post_date = date("Y-m-d H:i:s"); //날짜정보 괄호안 형식으로 불러오기
echo "$Post_date";
if(!isset($Post_date)){
	echo"날짜 안불러와짐";
}

    $tag = $_POST["tag"];
    $tags = explode(" ", $tag); //문자열 나누는함수 , 띄어쓰기로 구분하려고
    $tag_size = sizeof($tags); //태그 개수 세기위해
    $region = $_POST["TagTitle"];
     

    $query = "SELECT COUNT(*) AS CNT FROM POSTTABLE"; //포스트테이블 레코드개수(count) 조회 :게시물삭제구현을 안해서 간단함 //줄개수세기
    $result = oci_parse($con,$query);
    oci_execute($result);
    $row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS);
    $num = $row['CNT'];
    $num++;
    if(!isset($num)){
	    //$num = 1;
}
echo "===$num===";
echo "title: $Title , content: $Content , num: $num , date: $Post_date";  //값을 넣을 칼럼지정해준것 , 순서대로 값을 집어넣겠다
    $sql = "INSERT INTO POSTTABLE(TITLE, CONTENT, NUM, POST_DATE, HEART, USERID, REGIONTITLE, TAGTITLE) VALUES ('$Title', '$Content', '$num', '$Post_date', '0', '$UserID', '$region', '$tag')";
    echo $sql;
$ret = oci_execute(oci_parse($con, $sql));    
if($tag_size>1){                          //태그개수 1 이상이면
        echo "tag2";                       //test목적
	for($i = 0; $i < $tag_size; $i++){   //num이 외래키로 설정되어있음 ->  참조설정??
            $tag = $tags[$i];
            //$sql1 = "INSERT INTO TAGTABLE(TAGTITLE, NUM) VALUES ('$tag', '$num')";
            
	    echo $sql1;
	    oci_execute(oci_parse($con,"INSERT INTO TAGTABLE(TAGTITLE, NUM) VALUES ('$tag', '$num')"));
		//oci_execute(oci_parse($con, $sql1));
        }
    }
    else{
	echo "tag1";
        $sql1 = "INSERT INTO TAGTABLE(TAGTITLE, NUM) VALUES ('$tag', '$num')";
    }
    $sql2 = "INSERT INTO REGIONTABLE(REGIONTITLE, NUM) VALUES ('$region', '$num')";
    
    //$ret = oci_execute(oci_parse($con, $sql));
    $ret2 = oci_execute(oci_parse($con, $sql2));   
    //$r = oci_parse($con,$sql);
    //oci_execute($r);
    if($ret){
        echo "데이터 입력 성공";
    }
    else{
        echo "데이터 입력 실패";
    }

    oci_close($con);
echo "<script>location.replace('post.php');</script>";




?>




