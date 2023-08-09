<?php
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 상태가 아닙니다');</script>";
    echo "<script>location.replace('/../../standard/login_form.php');</script>";
}

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
$query = "select * from tpbd where tpk = '$pk'";
$result = oci_parse($connect, $query);
$success = oci_execute($result);

while($row = oci_fetch_array($result, OCI_NUM)){
    $title = $row[2];
    $id = $row[1];
    $time = $row[4];
    $tag = $row[5];
    $content = $row[3];
    

}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>팁 게시판</title>
    <link rel="stylesheet" href="./../../css/edit.css">
</head>

<body>
    <div class="board_wrap">
        <div class="board_title">
            <strong>팁 게시판</strong>
            <p>학교 생활의 팁을 공유해보세요.</p>
        </div>
        <div class="board_view_wrap">
            <div class="board_view">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="info">
                    <dl>
                        <dt>작성자</dt>
                        <dd><?php echo $id; ?></dd>
                    </dl>
                    <dl>
                        <dt>작성일</dt>
                        <dd><?php echo $time; ?></dd>
                    </dl>
                    <dl>
                        <dt>태그</dt>
                        <dd><?php echo $tag; ?></dd>
                    </dl>
                    <dl>
                        <dt>조회</dt>
                        <dd>33</dd>
                    </dl>
                </div>
                <div class="cont">
                    <?php echo $content; ?>
                </div>
            </div>
            <div class="bt_wrap">
                <a href="tip_list.php" class="on">목록</a>
            </div>
        </div>
    </div>
</body>

</html>