<?php
session_start();
if(!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 상태가 아닙니다');</script>";
    echo "<script>location.replace('/../../standard/login_form.php');</script>";
}
$userid = $_SESSION['userid'];
$pk = $_GET['pk'];

$db = '
(DESCRIPTION=
    (ADDRESS_LIST=
        (ADDRESS=(PROTOCOL=TCP)(HOST=203.249.87.57)(PORT=1521))
        )
    (CONNECT_DATA=
    (SID=orcl)
    )
)';
$username = "DBA2022G2";
$password = "test1234";
$connect = oci_connect($username, $password, $db);

if (!$connect) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

}

$query_id = "select id from tpbd where tpk = '$pk'";
$result_id = oci_parse($connect, $query_id);
$success_id = oci_execute($result_id);

while ($row_id = oci_fetch_array($result_id, OCI_NUM)) {
    $id = $row_id[0];
}

if($userid == $id){
    echo "<script>location.replace('tip_board_read.php?pk=$pk');</script>";
}
else{
    echo "<script>location.replace('tip_read_third.php?pk=$pk');</script>";
}



?>