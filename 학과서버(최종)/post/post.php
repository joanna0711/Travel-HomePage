CTYPE html>

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
                <li><a href="http://software.hongik.ac.kr/a_team/a_team5/project/login/loginmain.php">DayTravel</a></li>
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
        <span style="background-color:#FBE571"><b>게시판</b></span>
        <div class="search">
            <form method="GET" action="post.php">
                <input name="search" type="text" placeholder="영어로 검색어 입력">
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
                include_once "/var/www/html/a_team/a_team5/project/login/encrypted_password.php";
                ini_set('display_errors', '0');


                $db = $db = '(DESCRIPTION = (ADDRESS_LIST= (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)) ) (CONNECT_DATA = (SID = orcl)))';


                $con = oci_connect("DBA2022G5", "test1234", $db);

                if (!$con) {
                    echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
                    exit();
                }

                $s_region = $_GET['search']; //값 불러와

                $num = 1; //값넣어

                if(isset($s_region)){ // 조회하면
                    if (strpos($s_region, "#") !== false) {
			
                        $sql = "SELECT * FROM POSTTABLE
                        WHERE NUM = (SELECT NUM FROM TAGTABLE 
                                   WHERE TAGTITLE='$s_region')";
			//echo "$sql";
                    } else {
			//echo "$s_region";
                        $sql = "SELECT * FROM POSTTABLE WHERE REGIONTITLE = '$s_region' ORDER BY POST_DATE DESC";
                    }                }
                else{
                    $sql = "SELECT * FROM POSTTABLE ORDER BY POST_DATE DESC"; //내림차순정렬
                }
                $all = oci_parse($con, $sql); //명령문실행 준비
                oci_execute($all); //실행
                $num_rows = oci_num_rows($all); //명령문 실행중 영향을 받는 행 수 반환 (데이터유무 판단목적)
                if (!$all)
                    echo "데이터가 없습니다!";
                else {
                    while ($row = oci_fetch_array($all, OCI_ASSOC + OCI_RETURN_NULLS)) { //$row는 배열 , 한줄씩 가져오기위한 함수 : 배열로 받아온다
                        $Num = $row['NUM'];
                        $Title = $row['TITLE'];
                        $UserId = $row['USERID'];      //게시글 목록을 물러오기위해서 : 배열로저장 : 칼럼들이 여러개로 저장되어있기때문에 골라서 가져와야되니깐
                        $Post_date = $row['POST_DATE']; //num, title, userid, postdate인 칼럼들을 인덱스로 하는 row안에 들어간 값을 따로 저장 : 배열에 이름지정 후 값 넣어준것
                ?>
		    <tr>
		        <td style="text-align: center;">
                <a href = "http://software.hongik.ac.kr/a_team/a_team5/project/post/view_post.php?num=<?php echo"$Num";?>">
                        <?= $Num ?>
                </a>		    
                </td>
		        <td>
                <a href = "http://software.hongik.ac.kr/a_team/a_team5/project/post/view_post.php?num=<?php echo"$Num";?>">
                        <?= $Title ?>
                </a>
                </td>
		        <td style="text-align: center;">
                <a href = "http://software.hongik.ac.kr/a_team/a_team5/project/post/view_post.php?num=<?php echo"$Num";?>">
                        <?= $UserId ?>
                </a>		    
                </td>
		        <td style="text-align: center;">
                <a href = "http://software.hongik.ac.kr/a_team/a_team5/project/post/view_post.php?num=<?php echo"$Num";?>">
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


