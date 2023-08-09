<?php
session_start();
ini_set("display_errors", 1);
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 상태가 아닙니다');</script>";
    echo "<script>location.replace('/../../standard/login_form.php');</script>";
}
?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>팁 게시판</title>
    <link rel="stylesheet" type="text/css" href="./../../css/list.css" />
</head>

<body>
    <div id="board_area">
        <h1>팁 게시판</h1>
        <h4>학교 생활의 팁을 공유해보세요.</h4>
        <div class="bt_wrap">
            <a href="./../index.php" class="on">메인</a>
        </div>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">태그</th>
                </tr>
            </thead>
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
                $pk = $row[0];

            ?>
            <tbody>
                <tr>
                    <td width="500"><a href="tip_read_authority.php?pk=<?php echo $pk; ?> ">
                            <?php echo $title; ?>
                        </a></td>
                    <td width="120">
                        <?php echo $id ?>
                    </td>
                    <td width="100">
                        <?php echo $time ?>
                    </td>
                    <td width="100">
                        <?php echo $tag ?>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <div id="write_btn">
            <a href="tip_write_form.php"><button>글쓰기</button></a>
        </div>
    </div>
</body>

</html>