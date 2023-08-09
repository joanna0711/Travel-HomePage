<?php
session_start();
if(!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 상태가 아닙니다');</script>";
    echo "<script>location.replace('/../../standard/login_form.php');</script>";            
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>팁 게시판</title>
    <link rel="stylesheet" href="/../../css/boardcss.css" type="text/css" media="all" />
</head>

<body>
    <form name="tip_write_form" method="POST" action="tip_write_proce.php">
        <!-- method : POST!!! (GET X) -->
        <table style="padding-top:50px" align=center width=auto border=0 cellpadding=2>
            <tr>
                <td style="height:40; float:center; background-color:#3C3C3C">
                    <p style="font-size:25px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>게시글 작성하기</b></p>
                </td>
            </tr>
            <tr>
                <td bgcolor=white>
                    <table class="table2">
                        <tr>
                            <td>작성자</td>
                            <td><input type="text" name="id" size=30></td>
                        </tr>

                        <tr>
                            <td>제목</td>
                            <td><input type="text" name="title" size=70></td>
                        </tr>

                        <tr>
                            <td>내용</td>
                            <td><textarea name="content" cols=75 rows=15></textarea></td>
                        </tr>

                        <tr>
                            <td>비밀번호</td>
                            <td><input type="password" name="pw" size=15 maxlength=15></td>
                        </tr>
                        <tr>
                            <td>태그</td>
                            <td><input type="text" name="tag" size=15 maxlength=15></td>
                        </tr>
                    </table>

                    <center>
                        <input style="height:26px; width:47px; font-size:16px;" type="submit" value="작성">
                        <button type="button" style="height:26px; width:47px; font-size:16px;" onclick="location.href='tip_list.php'"> 취소</button>
                    </center>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>