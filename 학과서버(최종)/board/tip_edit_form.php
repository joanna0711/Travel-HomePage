<?php
session_start();
ini_set("display_errors", 1);
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

while ($row = oci_fetch_array($result, OCI_NUM)) {
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
    <title>공지사항</title>
    <link rel="stylesheet" href="./../../css/edit.css">
</head>

<body>
    <form name="tip_edit_form" method="POST" action="tip_edit_proce.php?pk=<?php echo $pk; ?>">
        <div class="board_wrap">
            <div class="board_title">
                <strong>팁 게시판</strong>
                <p>학교 생활 팁을 공유해보세요.</p>
            </div>
            <div class="board_write_wrap">
                <div class="board_write">
                    <div class="title">
                        <dl>
                            <dt>제목</dt>
                            <dd>
                                <?php echo $title; ?>
                            </dd>
                        </dl>
                    </div>
                    <div class="info">
                        <dl>
                            <dt>글쓴이</dt>
                            <dd>
                                <?php echo $id; ?>
                            </dd>
                        </dl>
                        <dl>
                            <dt>태그</dt>
                            <dd><input type="text" name="tag" placeholder="#태그" value=<?php echo $tag; ?>></dd>
                        </dl>

                    </div>
                    <div class="cont">
                        <textarea name="content"><?php echo $content; ?></textarea>
                    </div>
                    <div class="info">
                        <dl>
                            <dt>비밀번호</dt>
                            <dd><input type="password" name="pw" placeholder="비밀번호 입력"></dd>
                        </dl>
                    </div>
                    <div class="bt_wrap">
                        <input style="height:26px; width:47px; font-size:16px;" type="submit" value="작성">
                        <a href="tip_delete_form.php?pk=<?php echo $pk; ?>">삭제</a>
                    </div>
                </div>
            </div>
</body>

</html>