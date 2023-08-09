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
                <li>지역별보기</li>
                <li>추천여행지</li>
                <li>테마여행</li>
                <li>오늘의태그</li>
                <li>고객센터</li>
            </ul>
            <ul>
                <li>로그인</li>
                <li>회원가입</li>
                <li>마이페이지</li>
            </ul>
        </div>
    </div>
    <div class="main">
        <span style="background-color:#FBE571"><b>지역이름</b></span>
        <div class="search">
            <form method="GET" action="post.php">
                <input name="search" type="text" placeholder="검색어 입력">
                <img class="rg" src="https://s3.ap-northeast-2.amazonaws.com/cdn.wecode.co.kr/icon/search.png" alt="">
            </form>
        </div>
        <select class="subtag" name="catgo">
            <option value="subject">제목</option>
            <option value="tag">태그</option>
            <option value="region">지역</option>
        </select>
    </div>

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


                $con = oci_connect("DBA2022G5", "test1234", $db, 'AL32UTF8');

                if (!$con) {
                    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
                    exit();
                }

                $s_region = $_GET['search'];
                //$region= $_POST["region"];
                //$query = "SELECT * FROM POSTTABLE WHERE NUM=(SELECT NUM FROM REGIONTABLE WHERE REGIONTITLE =$region)"; //지역검색기능
              
                //$tag= $_POST["tag"];
                //$query = "SELECT * FROM POSTTABLE WHERE NUM=(SELECT NUM FROM TAGTABLE WHERE TAGTITLE =$tag)"; //지역검색기능
              //이거 검색기능


                $num = 1;
                if(isset($s_region)){
                    $sql = "SELECT * FROM POSTTABLE WHERE REGIONTITLE = '$s_region' ORDER BY POST_DATE DESC";
                }
                else{
                    $sql = "SELECT * FROM POSTTABLE ORDER BY POST_DATE DESC";
                }
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
                <a href = "http://203.249.87.56:9302/5015/infotest/view_post.php?num=<?php echo"$Num";?>">
                        <?= $Num ?>
                </a>		    
                </td>
		        <td>
                <a href = "http://203.249.87.56:9302/5015/infotest/view_post.php?num=<?php echo"$Num";?>">
                        <?= $Title ?>
                </a>
                </td>
		        <td style="text-align: center;">
                <a href = "http://203.249.87.56:9302/5015/infotest/view_post.php?num=<?php echo"$Num";?>">
                        <?= $UserId ?>
                </a>		    
                </td>
		        <td style="text-align: center;">
                <a href = "http://203.249.87.56:9302/5015/infotest/view_post.php?num=<?php echo"$Num";?>">
                        <?= $Post_date ?>
                </a>		    
                </td>
		    </tr>
                <?php
                $num++;
                    }
                }       
                ?>
            </tbody>
        </table>
    </div>

    <div class="bottom">
        <button class="open">글쓰기</button>
    </div>

    <form method="post" action="post_result.php">
        <div class="modal">
            <div class="modal_body">
                <div class="m1">
                    <span style="font-size: 23px;"><b>새 글 작성</b></span>
                    <button class="close">
                        <img src="../image/close.png" alt="">
                    </button>
                </div>
                <div class="m2">
                    <span style="font-size: 20px;">제목</span>
                    <input style="width: 600px; height: 10px; margin-left: 5px;" type="text" name="Title" size=30>
                    <span style="font-size: 20px;">카테고리</span>
                    <select class="category" name="TagTitle">
                        <option value="region">지역</option>
                        <option value="jongno">종로</option>
                        <option value="suwon">수원</option>
                        <option value="yongin">용인</option>
                        <option value="sejong">세종</option>
                        <option value="cheongju">청주</option>
                        <option value="daejeon">대전</option>

                    </select>
                </div>
                <!-- <div class="m3">
                <span style="font-size: 20px;">파일첨부</span>
                <input style="width: 300px; height: 10px; margin-left: 5px;" type="file" name="photo" size=10 maxlength=15>
                <img class="file" src="../image/image.png" alt="">
                <span style="font-size: 20px;">태그</span>
                <input style="width: 340px; height: 10px; margin-left: 5px;" type="text">
                
                <span style="font-size: 20px;">날짜</span>
                <input style="width: 340px; height: 10px; margin-left: 5px;" type="text" name="post_date">
                
            </div> -->
                <div class="m3">
                    <span style="font-size: 20px;">태그</span>
                    <input style="width: 810px; height: 10px; margin-left: 5px;" type="text" name="tag">
                </div>
                <span style="font-size: 20px; margin-left: 62px;">내용</span>
                <textarea
                    style="resize: none; margin-bottom: 20px; font-size: 20px; border-radius: 10px; width: 830px; height: 350px; float: right; margin-right: 50px;"
                    name="Content"></textarea>
                <div class="m4">
                    <button class="write">작성하기</button>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="post.js"></script>
    </form>
    
</body>

</html>

