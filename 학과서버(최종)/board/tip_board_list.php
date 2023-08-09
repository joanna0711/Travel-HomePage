<?php
session_start();
ini_set("display_errors", 1);
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 상태가 아닙니다');</script>";
    echo "<script>location.replace('/../../standard/login_form.php');</script>";
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
    <div class="board_wrap">
        <div class="board_title">
            <strong>팁 게시판</strong>
            <p>학교 생활의 팁을 공유해보세요.</p>
        </div>
        <div class="board_list_wrap">
            <div class="board_list">
                <thread>
                    <div class="top">

                        <div class="title">제목</div>
                        <div class="writer">글쓴이</div>
                        <div class="date">작성일</div>
                        <div class="count">태그</div>
                        <div class="count">조회</div>

                    </div>
                </thread>
                <?php
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
                $query = "select * from tpbd order by ptime DESC";
                $result = oci_parse($connect, $query);
                $success = oci_execute($result);

                while ($row = oci_fetch_array($result, OCI_NUM)) {
                    $title = $row[2];
                    $id = $row[1];
                    $time = $row[4];
                    $tag = $row[5];
                    $tpk = $row[0];

                ?>
                <tbody>
                    <div>
                        <div class="title"><a href="tip_board_read.php?tpk=<?php echo $tpk; ?> ">
                                <?php echo $title; ?>
                            </a>
                        </div>
                        <div class="writer">
                            <?php echo $id ?>
                        </div>
                        <div class="date">
                            <?php echo $time ?>
                        </div>
                        <div class="count">
                            <?php echo $tag ?>
                        </div>
                        <?php } ?>
                    </div>
                </tbody>
                <div class="bt_wrap">
                    <a href="write.html" class="on">등록</a>
                    <!--<a href="#">수정</a>-->
                </div>
            </div>
        </div>
</body>

</html>