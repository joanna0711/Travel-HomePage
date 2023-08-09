<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="post.css">
    <script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
</head>

<body>
    <div class="nav_container">
        <div class="search_nav">
            <ul>
                <li>MADIA</li>
                <li class="mainsearch">
                    <form id="mainsearch" action="/">
                        <input type="text" name="mainsearch" placeholder="메인 검색">
                        <button><i class="fas fa-search"></i></button>
                    </form>
                </li>
                <li>
                    <i class="fas fa-user-circle"></i>
                    <i class="fas fa-heart"></i>
                    <i class="fas fa-bell"></i>
                    <i class="fas fa-bars"></i>
                </li>
            </ul>
        </div>
        <div class="nav">
        <ul>
                <li><i class="fas fa-bars" style="margin-right: 10px;"></i>카테고리</li>
                <li><a href="http://software.hongik.ac.kr/a_team/a_team5/project/post/post.php">지역별보기</a></li>
                <li><a href="http://software.hongik.ac.kr/a_team/a_team5/project/recommand/recommend.html">추천여행지</a></li>
                <ul class="menu">
                    <li style="margin-left: -140px; margin-right: 100px;">테마여행
                      <ul class="depth" style="margin-left: 0px; margin-top: 5px;">
                        <li style="width: 160px"><a href="http://software.hongik.ac.kr/a_team/a_team5/project/tema/tema_date.html">데이트</a></li>
                        <li style="width: 160px"><a href="http://software.hongik.ac.kr/a_team/a_team5/project/tema/tema_family.html">가족여행</a></li>
                        <li style="width: 160px"><a href="http://software.hongik.ac.kr/a_team/a_team5/project/tema/tema_onchen.html">온천</a></li>
                        <li style="width: 160px"><a href="http://software.hongik.ac.kr/a_team/a_team5/project/tema/tema_moutain.html">산</a></li>
                        <li style="width: 160px"><a href="http://software.hongik.ac.kr/a_team/a_team5/project/tema/tema_sports.html">스포츠</a></li>
                      </ul>
                    </li>
                </ul>  
                <li> <a href="http://software.hongik.ac.kr/a_team/a_team5/project/tema/tag.html">오늘의태그</a>
                    </li>
                <li> <a href="http://software.hongik.ac.kr/a_team/a_team5/project/mypage/view_radio.php">마이페이지</a>
                </li>
            </ul>

            <ul>
                <div class="link">
                    <a href="http://software.hongik.ac.kr/a_team/a_team5/project/mypage/view_radio.php">마이페이지</a>
                    <a href="http://software.hongik.ac.kr/a_team/a_team5/project/login/info.php">회원정보수정</a>
                    <a href="http://software.hongik.ac.kr/a_team/a_team5/project/login/logout.php">로그아웃</a>
                </div>
            </ul>
        </div>
    </div>
    <div class="main">
        <span style="background-color:#FBE571"><b>지역이름</b></span>
        <div class="search">
            <form method="get" action="search_result.php">
                <input name="search" type="text" placeholder="검색어 입력">
                <img class="rg" src="https://s3.ap-northeast-2.amazonaws.com/cdn.wecode.co.kr/icon/search.png" alt="">
        </div>
        <select class="subtag" name="catgo">
            <option value="subject">제목</option>
            <option value="tag">태그</option>
            <option value="region">지역</option>
        </select>
        </form>
    </div>

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


    $con = oci_connect("DBA2022G5", "test1234", $db, 'AL32UTF8');       //지워도됌

    if (!$con) {
        echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
        exit();
    }

    ?>
    <div class="result" style="height: 500px; overflow-y: auto">
        <table border="1" width='1060' height="320" align="center">
            <thead>
                <tr bgcolor="C7C7C7" align="center">
                    <th>번호</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search_type = $GET["catgo"];
                $region = $GET["search"];
                if ($search_type == "region") {
                    $sql1 = "SELECT NUM FROM REGIONTABLE WHERE REGIONTITLE = '$region'";
                    $result = oci_parse($con, $sql1);
                    oci_execute($result);
                    while ($row1 = oci_fetch_array($result, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        $num1 = $row1['NUM'];
                        $sql = "SELECT * FROM POSTTABLE WHERE NUM = '$num1' ORDER BY POST_DATE DESC";

echo "<h1>$sql</h1>";


                        //$sql = "SELECT * FROM POSTTABLE ORDER BY POST_DATE DESC";
                        $all = oci_parse($con, $sql);
                        oci_execute($all);
                        $num_rows = oci_num_rows($all);
                        if (!$all)
                            echo "데이터가 없습니다!";
                        else {
                            while ($row = oci_fetch_array($all, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                $Num = $row['NUM'];
                                $Title = $row['TITLE'];
                                $UserId = $row['USERID'];
                                $Post_date = $row['POST_DATE'];
                ?>
                <tr>
                    <td style="text-align: center;">
                        <a href="http://203.249.87.56:9302/5015/infotest/view_post.php?num=<?php echo "$Num"; ?>">
                            <?= $Num ?>
                        </a>
                    </td>
                    <td>
                        <a href="http://203.249.87.56:9302/5015/infotest/view_post.php?num=<?php echo "$Num"; ?>">
                            <?= $Title ?>
                        </a>
                    </td>
                    <td style="text-align: center;">
                        <a href="http://203.249.87.56:9302/5015/infotest/view_post.php?num=<?php echo "$Num"; ?>">
                            <?= $UserId ?>
                        </a>
                    </td>
                    <td style="text-align: center;">
                        <a href="http://203.249.87.56:9302/5015/infotest/view_post.php?num=<?php echo "$Num"; ?>">
                            <?= $Post_date ?>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
                            }
                        }
                    }
                }
                ?>
