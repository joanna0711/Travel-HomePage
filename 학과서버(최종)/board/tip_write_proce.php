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

$id = $_POST['id']; //Writer
$pw = $_POST['pw']; //Password
$title = $_POST['title']; //Title
$content = $_POST['content'];
$tag = $_POST['tag']; //Content
$date = date('Y-m-d H:i:s'); //Date


if ($id == $userid) {
    $query_pw = "select pw from member_dbag2 where id = '$id'";
    $result_pw = oci_parse($connect, $query_pw);
    $success_pw = oci_execute($result_pw);

    while ($row_pw = oci_fetch_array($result_pw, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $encrypt_pw = $row_pw['PW'];
    }
    if ((password_verify($pw, $encrypt_pw)) == true) {
        if ($title == null) {
            echo "<script>alert('글 제목이 입력되지 않았습니다.');</script>";
            echo "<script>location.replace('tip_write_form.php');</script>";
        } elseif ($tag == null) {
            echo "<script>alert('태그가 입력되지 않았습니다.');</script>";
            echo "<script>location.replace('tip_write_form.php');</script>";

        } else {
            $tpk = uniqid();

            $query_board = "insert into tpbd values('$tpk', '$id', '$title', '$content', '$date', '$tag')";
            $result_board = oci_parse($connect, $query_board);
            $success_board = oci_execute($result_board);
            oci_free_statement($result_board);
        }

    } elseif ($pw == null) {
        echo "<script>alert('비밀번호가 입력되지 않았습니다.');</script>";
        echo "<script>location.replace('tip_write_form.php');</script>";
    } else {
        echo "<script>alert('비밀번호가 틀렸습니다.');</script>";
        echo "<script>location.replace('tip_write_form.php');</script>";
    }

    oci_free_statement($result_pw);
} elseif ($id == null) {
    echo "<script>alert('아이디가 입력되지 않았습니다.');</script>";
    echo "<script>location.replace('tip_write_form.php');</script>";
} else {
    echo "<script>alert('현재 로그인된 아이디와 일치하지 않습니다.');</script>";
    echo "<script>location.replace('tip_write_form.php');</script>";
}

oci_close($connect);

if ($success_board) {
    echo "<script>alert('작성 완료')</script>";
    echo "<script>location.replace('./../index.php');</script>";
} else {
    echo "<script>alert('작성 실패')</script>";
    echo "<script>location.replace('tip_write_form.php');</script>";
}
?>