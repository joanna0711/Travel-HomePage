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
$loged_ID = $_SESSION['UserID'];
?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>게시판</title>
</head>

<body>
    <?php
    $num = $_GET['num'];
    $sql = "SELECT * FROM POSTTABLE WHERE NUM = '$num'";
    $result = oci_parse($con,$sql);
    oci_execute($result);
    $row = oci_fetch_array($result, OCI_ASSOC + OCI_RETURN_NULLS);  //while 이 없음 : 애초에 검색조건이딱 하나만 조회하니까 (위의 쿼리문을 보면 num 만조회)
    $Title = $row['TITLE'];
    $UserId = $row['USERID'];
    $Post_date = $row['POST_DATE'];
    $content = $row['CONTENT'];
    ?>
    <div id="board_read">
        <h2>
            <?php echo $Title; ?>
        </h2>
        <div id="user_info">
            <?php echo "@$UserId"; ?>
            <?php echo $Post_date; ?>
            <div id="bo_line"></div>
        </div>
        <div id="bo_content">
            <?php echo nl2br($content); ?>
        </div>
        <div id="bo_ser">
            <ul>
                <li><a href="http://203.249.87.56:9302/5015/infotest/post.php">[목록으로]</a></li>
            </ul>
        </div>
    </div>
</body>
</html>

<div class="reply_view">
	<h3>댓글목록</h3>
		<?php
			$sql1 = "SELECT * FROM COMENTTABLE where NUM = '$num' order by COMENT_DATE desc"; //코멘트테이블에서 num 값을 가진 댓글의 모든 정보를 날짜 내림 차순으로 조회  (desc 내림차순 , asec 오름차순)
        $result1 = oci_parse($con, $sql1); //명령어 실행준비                                                                          
        oci_execute($result1);              //명령어 실행
			while($row1 = oci_fetch_array($result1, OCI_ASSOC + OCI_RETURN_NULLS)){ 
            $id = $row1['USERID'];
            $c_content = $row1['COMENT'];
            $c_date = $row1['COMENT_DATE'];
		?>
		<div class="dap_lo">
			<div><b><?php echo $id;?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$c_content"); ?></div>
			<div class="rep_me dap_to"><?php echo $c_date; ?></div>
		</div>
	<?php } ?>

	<div class="dap_ins">
		<form action="http://203.249.87.56:9302/5015/infotest/comment.php?num=<?php echo $num; ?>" method="post">
			<div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt">댓글</button>
			</div>
		</form>
	</div>
</div>
<div id="foot_box"></div>
</div>
</body>
</html>
