<?php
include_once "./../../header/pw_verify.php";
session_start();
$userid = $_SESSION['userid'];

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

$pk = $_GET['pk'];
$pw = $_POST['pw'];

$query_pw = "select pw from member_dbag2 where id = '$userid'";
$result_pw = oci_parse($connect, $query_pw);
$success_pw = oci_execute($result_pw);

while ($row_pw = oci_fetch_array($result_pw, OCI_ASSOC + OCI_RETURN_NULLS)) {
    $encrypt_pw = $row_pw['PW'];
}

if((password_verify($pw,$encrypt_pw))==true){
    $query_delete = "delete from tpbd where tpk = '$pk'";
    $result_delete = oci_parse($connect, $query_delete);
    $success_delete = oci_execute($result_delete);

    oci_free_statement($result_delete);

}
elseif($pw == null){
    echo "<script>alert('비밀번호가 입력되지 않았습니다.');</script>";
    echo "<script>location.replace('tip_delete_form.php?pk=$pk');</script>";
}
else{
    echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
    echo "<script>location.replace('tip_delete_form.php?pk=$pk');</script>";
}
oci_free_statement($result_pw);
oci_close($connect);

if($success_delete){
    echo "<script>alert('게시글이 삭제되었습니다.');</script>";
    echo "<script>location.replace('tip_list.php');</script>";
}else{
    echo "<script>alert('게시글 삭제를 실패하였습니다.');</script>";
    echo "<script>location.replace('tip_list.php');</script>";
}
?>