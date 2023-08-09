<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="radio.css" rel="stylesheet">
    <title>선호하는 여행타입 수정하기</title>
    <script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
</head>

<body>
    <?php
    ini_set('display_errors', '0');
    session_start();

    $db = '
        (DESCRIPTION = 
        (ADDRESS_LIST=
            (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
        )
        (CONNECT_DATA = 
        (SID = orcl)
        )
        )';


    $connect = oci_connect("DBA2022G5", "test1234", $db);
    $sql = "SELECT * FROM UserTable WHERE UserName = '$session_username'";
    $result = oci_parse($connect, $sql);
    oci_execute($result);

    //라디오버튼  - 세션입력, css
    
    $con = oci_connect("DBA2022G5", "test1234", $db);

    if (!$con) {
        echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
        exit();

    }
    ?>

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

    <div class="mypage_container">
        <div class="mypage_nav">
            <ul>
                <li>마이페이지</li>
                <li><a href="#mypage_content5">개인정보<i class="fas fa-chevron-down"
                            style="position: relative; left:100px"></i></a></li>
                <li><a href="#mypage_content2" class="mypage_active">여행타입<i class="fas fa-chevron-down"
                            style="position: relative; left:100px"></i></a></li>
                <li><a href="#mypage_content3">참여내역<i class="fas fa-chevron-down"
                            style="position: relative; left:100px"></i></a></li>
                <li><a href="#mypage_content4">플래너<i class="fas fa-chevron-down"
                            style="position: relative; left:107px"></i></a></li>
            </ul>
        </div>

        <div class="mypage_main">
            <div id="mypage_content1">
                <ul>
                    <li>안녕하세요, DayTravel <span style="color:#0074FD">FAMILY</span> <b>
                            <?= $UserID ?>
                        </b>님 !</li>
                    <li>
                        <p>개인정보 수정</p>
                        <i class="fas fa-user-circle"></i>
                    </li>
                    <li>
                        <span>참여내역</span>
                        <ul>
                            <li><i class="fas fa-list-alt"></i>내가 쓴 글</li>
                            <li><i class="fas fa-comment"></i>댓글 단 글</li>

                        </ul>
                    </li>
                </ul>
            </div>
            <div id="mypage_content2" class="mypage_active">
                <div>개인정보</div>
                <p>선호하는 여행 타입</p>
                <form name="radioform" method="post" action="view_radio.php">
                    <table border="1" width='1000' height="320" align="center" class="mypage_table">
                        <tr>
                            <td bgcolor="D9D9D9" align="center">여행테마</td>
                            <td>

                                <input type="radio" name="Thema" value="Watching"><label>관광</label>
                                <input type="radio" name="Thema" value="Relaxing"><label>휴양</label>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="D9D9D9" align="center">여행목적</td>
                            <td>

                                <input type="radio" name="Purpose" value="Anniversary"><label>기념일</label>
                                <input type="radio" name="Purpose" value="FamilyTour"><label>가족여행</label>
                                <input type="radio" name="Purpose" value="CoupleTour"><label>커플여행</label>
                                <input type="radio" name="Purpose" value="FriendshipTour"><label>우정여행</label>
                                <input type="radio" name="Purpose" value="HealingTour"><label>힐링여행</label>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="D9D9D9" align="center">인원수</td>
                            <td>

                                <input type="radio" name="NumberPeople" value="Alone"><label>1인</label>
                                <input type="radio" name="NumberPeople" value="2~4people"><label>2~4인</label>
                                <input type="radio" name="NumberPeople" value="5~7people"><label>5~7인</label>
                                <input type="radio" name="NumberPeople" value="Group"><label>8인이상 단체</label>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="D9D9D9" align="center">자녀동반</td>
                            <td>
                                <input type="radio" name="FamilyType" value="No_kid"><label>없음</label>
                                <input type="radio" name="FamilyType" value="Baby"><label>영유아</label>
                                <input type="radio" name="FamilyType" value="Student"><label>초등학생</label>
                                <input type="radio" name="FamilyType" value="Adult"><label>성인</label>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="D9D9D9" align="center">반려동물</td>
                            <td>
                                <input type="radio" name="Animal" value="yes"><label>유</label>
                                <input type="radio" value="" name="자녀"><label>무</label>
                            </td>
                        </tr>
                        <input type="submit" value="확인"></li>
                    </table>
                </form>
            </div>
            <div id="mypage_content3">
                <div>참여내역</div>
                <ul class="mypage-parti">
                    <li>
                        <p><i class="fas fa-comment-dots"></i>댓글 단 글</p>
                        <ul>
                            <?php
                            if (isset($_SESSION['username'])) {
                                $UserName = $_SESSION['username'];
                            }
                            $sql1 = "SELECT * FROM COMENTTABLE WHERE UserName='$UserName' order by COMENT_DATE desc";
                            $result1 = oci_parse($con, $sql1);
                            oci_execute($result1);
                            while ($row1 = oci_fetch_array($result1, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                $id = $row1['USERID'];
                                $c_content = $row1['COMENT'];
                                $c_date = $row1['COMENT_DATE'];
                            ?>
                            <li><i class="fas fa-comment-dots"></i>
                                <?php echo nl2br("$c_content"); ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>

                    <li>
                        <p><i class="fas fa-list-alt"></i>작성한 글</p>
                        <ul>
                            <?php
                            if (isset($_SESSION['username'])) {
                                $UserName = $_SESSION['username'];
                            }
                            $num = 1;
                            $sql = "SELECT * FROM POSTTABLE  WHERE UserName='$UserName' ORDER BY POST_DATE DESC";
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
                            <li><i class="fas fa-list-alt"></i>
                                <?php echo $Title ?>
                            </li>
                            <?php }
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="mypage_content4">
                <div>나의 여행</div>
                <div>
                    <ul>
                        <li>
                            11월 20일 (일) ~ 11월 24일 (목)
                            <p>성인2명 유아1명</p>
                        </li>
                        <li>
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-pen"></i>
                            <i class="fas fa-trash"></i>
                        </li>
                    </ul>
                </div>
                <div class="mypage-trip">
                    <ul>
                        <li>
                            <ul>
                                <li><span style="color:red">● </span>1일차</li>
                                <li>숙소 : 해비치호텔</li>
                                <li>한라산 어승생악</li>
                                <li>중문관광단지 야경 구경</li>
                                <li>아점 : 춘미향식당</li>
                                <li>오셜록티뮤지엄</li>
                                <li><i class="fas fa-pen"></i></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><span style="color:orange">● </span>2일차</li>
                                <li>숙소 : 해비치호텔</li>
                                <li>한라산 어승생악</li>
                                <li>중문관광단지 야경 구경</li>
                                <li>아점 : 춘미향식당</li>
                                <li>오셜록티뮤지엄</li>
                                <li><i class="fas fa-pen"></i></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><span style="color:forestgreen">● </span>3일차</li>
                                <li>숙소 : 해비치호텔</li>
                                <li>한라산 어승생악</li>
                                <li>중문관광단지 야경 구경</li>
                                <li>아점 : 춘미향식당</li>
                                <li>오셜록티뮤지엄</li>
                                <li><i class="fas fa-pen"></i></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="mypage_content5">

            </div>
        </div>
    </div>



    <script src="radio.js"></script>
</body>

</html>