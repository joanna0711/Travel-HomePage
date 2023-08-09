<link rel="stylesheet" href="register-ok.css">

<!doctype html>
<?php
include_once "/var/www/html/a_team/a_team5/project/login/encrypted_password.php";
session_start();
$session_userid = $_SESSION['UserID'];
$session_username = $_SESSION['UserName'];
if (is_null($session_userid)) {
    header('Location: register.php');
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nav.css">
    <title>회원가입완료</title>
    <script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />

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
    <div class="box">
        <h1>회원가입이 완료되었습니다!!
            <h2>환영합니다. 회원가입이 완료되었습니다.</h2>
            <h3>
                <?php echo $session_username; ?>님의 아이디는
                <?php echo $session_userid; ?>입니다.
                <h4>마이페이지에서 추가 회원정보를 꼭 입력해주세요!</h4>
                <a href="http://software.hongik.ac.kr/a_team/a_team5/project/login/info.php">회원정보수정</a>
                <a href="http://software.hongik.ac.kr/a_team/a_team5/project/login/loginmain.php">홈페이지 바로가기</a>
    </div>
</body>

</html>