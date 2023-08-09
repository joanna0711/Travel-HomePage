<meta name="viewport" content="width=device-width" initial-scale=1.0>

<?php

ini_set('display_errors', '0');


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

    // 사진데이터 처리
    /*$file_name = $_FILES['photo']['name'];
    $tmp_file = $_FILES['photo']['tmp_name'];
    $file_path='./img/'.$file_name;
    move_uploaded_file($tmp_file, $file_path);
    echo "img폴더에 사진 등록 완료";*/

    // $sql = "insert into ProductInformation (IMG) values ('$file_name')";
    // $ret = oci_execute(oci_parse($con, $sql));

$Title = $_POST["Title"];
echo $Title;
$Content = $_POST["Content"];
echo $Content;
    //$photo = $file_name;
    $Post_date = date("Y-m-d H:i:s");
    echo "$Post_date";
    $query = "SELECT COUNT(*) AS CNT FROM POSTTABLE";
    $result = oci_parse($con,$query);
    oci_execute($result);
    $row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS);
    $num = $row['CNT'];
    $num++;
    if(!isset($num)){
	    //$num = 1;
}
    echo "===$num===";
    $sql = "INSERT INTO POSTTABLE(TITLE, CONTENT, NUM, POST_DATE, HEART) VALUES ('$Title', '$Content', '$Num', '$Post_date', '0')";
    echo $sql;
    $ret = oci_execute(oci_parse($con, $sql));
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


