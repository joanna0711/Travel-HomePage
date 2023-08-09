<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="info.css" rel="stylesheet">
    <title>개인정보 수정하기</title>
    <script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
</head>

<body class = "body">
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
    <?php
    ini_set('display_errors', '0');
    include_once "/var/www/html/a_team/a_team5/project/login/encrypted_password.php";


    $db = '
(DESCRIPTION = 
(ADDRESS_LIST=
    (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
)
(CONNECT_DATA = 
(SID = orcl)
)
)';

    //인포화면 - 세션입력 ,css
    
    $con = oci_connect("DBA2022G5", "test1234", $db);
    session_start();
    if (!$con) {
        echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
        exit();
    }
    if (!isset($_SESSION['UserID'])) {
        echo "<script>location.replace('./../login/login.php');</script>";
    } else {
        $UserID = $_SESSION['UserID'];
    }

    $sql = "SELECT * FROM USERTABLE WHERE USERID='$UserID'";
    $result = oci_parse($con, $sql);
    oci_execute($result);
    if (!$result) {
        echo "데이터 없음";
    } else {
        while ($row = oci_fetch_array($result, OCI_ASSOC)) {
            $name = $row['USERNAME'];
            $number = $row['USERPHONENUMBER'];
            $birth = $row['USERDATE'];
            $gender = $row['USERSEX'];
        }

    }
    //값조회 -> 변수 저장해 -> post로 제대로 넘기고 인포에서 뷰인포로 넘기고 디비에 들어갔는지 확인
//->value값에 저장할때는 html 잠깐 끊고 php 다시 실행??
    
    //(과정)
//빈칸에 입력한값이 뷰인포에 포스트로 제대로 값 들어갔는지 1번
//넘어간 값으로 업데이트해서 디비 정보가 수정이 제대로되는지
//Info 에서 디비정보조회되는지
//input 태그안에서 빈칸안에 채워지게 ((value = 변수 ))출력시키는거
    ?>
    <div class="table">
        <h1 align="center">회원 정보 수정 <h1>
                <form name="info" method="post" action="view_info.php">
                    <INPUT TYPE="hidden" NAME="UserID" VALUE="<?php echo $UserID ?>">
                    <INPUT TYPE="hidden" NAME="UserName" VALUE="<?php echo $name ?>">
                    <INPUT TYPE="hidden" NAME="UserDate" VALUE="<?php echo $birth ?>">
                    <INPUT TYPE="hidden" NAME="PhoneNumber" VALUE="<?php echo $number ?>">
                    <INPUT TYPE="hidden" NAME="UserSex" VALUE="<?php echo $gender ?>">
                    <table width="50%" border="1" cellspacing="0" align="center">   
                        <tr align="center">
                            <td>아이디</td>
                            <td>
                                <?php echo $UserID ?>
                            </td>
                        </tr>
                        <tr align="center">
                            <td>비밀번호</td>
                            <td><INPUT TYPE="password" NAME="prevpassword"></td>
                        </tr>
                        <tr align="center">
                            <td>비밀번호 확인</td>
                            <td><INPUT TYPE="password" NAME="newpassword"></td>
                        </tr>
                        <tr align="center">
                            <td>이름</td>
                            <td>
                                <INPUT TYPE="name" NAME="UserName" VALUE="<?= $name ?>">
                            </td>
                        </tr>
                        <tr align="center">
                            <td>생년월일</td>
                            <td>
                                <INPUT TYPE="date" NAME="UserDate" VALUE="<?= $birth ?>">  //????? 밸류로 인풋값 미리 불러오기 
                            </td>
                        </tr>
                        <tr align="center">
                            <td>전화번호</td>
                            <td>
                                <INPUT TYPE="text" NAME="PhoneNumber" VALUE="<?= $number ?>">
                            </td>
                        </tr>
                        <tr align="center">
                            <td>성별</td>
                            <td>
                                남성<INPUT TYPE="radio" NAME="UserSex" VALUE="m">
                                여성<INPUT TYPE="radio" NAME="UserSex" VALUE="f">
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan=2>
                                <input type="submit" class="btn" value="정보 수정">
                                <button type="button" onclick="location.href='info_delete.php'">탈퇴</button>
                            </td>
                        </tr>
                    </table>

                    <!-- 글 내용 :<br> 
    <textarea rows="5" cols="60" name="content"></textarea>     
    <br><br> 
    <input type="submit" value="확인">  -->

                </form>
    </div>
</body>

</html>