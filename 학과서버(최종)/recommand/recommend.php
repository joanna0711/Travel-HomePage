<link rel="stylesheet" href="recommend.css">
<!DOCTYPE html>
<?php
include_once "/var/www/html/a_team/a_team5/project/login/encrypted_password.php";
session_start();
$session_userid = $_SESSION['UserID'];
$session_username = $_SESSION['UserName'];
$Thema = $_SESSION["Thema"];
$Purpose = $_SESSION["Purpose"];
$NumberPeople = $_SESSION["NumberPeople"];
$FamilyType = $_SESSION["FamilyType"];
$Animal = $_SESSION["Animal"];

if (is_null($session_userid)) {
    header('Location: register.php');
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommand</title>
    <script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
    <link rel="stylesheet" href="recommend.css">
</head>

<body>
    <?php
include_once "/var/www/html/a_team/a_team5/project/login/encrypted_password.php";
ini_set('display_errors', '0');
session_start();
$session_userid = $_SESSION['UserID'];
$session_username = $_SESSION['UserName'];
$Thema = $_SESSION["Thema"];
$Purpose = $_SESSION["Purpose"];
$NumberPeople = $_SESSION["NumberPeople"];
$FamilyType = $_SESSION["FamilyType"];
$Animal = $_SESSION["Animal"];
$name = $_POST['UserName'];
if (is_null($session_userid)) {
    header('Location: register.php');
}
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

    <div class="recommend-container">
        <div class="recommend-header">
            <div>

                <span style="color:#0074FD">
                    <?php echo $name; ?>
                </span>
                <span>님, 안녕하세요</span>
                <span style="display: block;">회원님에게 맞는 여행지를 추천해드릴게요</span>
            </div>
            <div>
                <span>회원님이 기입하신 여행스타일은</span>
                <span><i class="fas fa-plane"></i>
                    <?php echo $Thema; ?>
                </span>
                <span><i class="fas fa-heart"></i>
                    <?php echo $Purpose; ?>
                </span>
                <span><i class="fas fa-dog"></i>
                    <?php echo $Animal; ?>
                </span>
                <span><i class="fas fa-user-friends"></i>
                    <?php echo $NumberPeople; ?>
                </span>
            </div>
        </div>

        <div class="recommend-main">
            <div>
                <img src="perpare.png" alt="">
            </div>

            <div>
                <ul>
                    <li>경기도 일산에서 열리는 케이<span style="color:#FFC20E;">펫</span>페어 <span style="color:#FFC20E;">일산</span>
                    </li>
                    <li>2022.11.18(금) ~ 11.20(일)</li>
                </ul>

                <ul>
                    <li><i class="fas fa-list"></i></li>
                    <li>반려동물 입장 가능</li>
                    <li>근처 킨텍스 중앙공원/수변공원</li>
                    <li>피크닉가능</li>
                </ul>
            </div>

        </div>
    </div>

</body>

</html>