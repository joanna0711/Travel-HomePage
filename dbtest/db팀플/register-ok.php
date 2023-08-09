<link rel="stylesheet" href="register-ok.css">

<!doctype html>
<?php
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
    <title>Document</title>
    <script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
</head>

<body>

    <div class="nav_container">
        <div class="search_nav">
            <ul>
                <li><a href="\5015\main\main.php">여행사이트</a></li>
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

            <div class="link">
                <a href="\5015\main\mypage.php">마이페이지</a>
                <a href="#">나의 여행</a>
                <a href="\5015\main\logout.php">로그아웃</a>
            </div>
        </div>
    </div>
    <div class="box">
        <h1>회원가입이 완료되었습니다!!
            <h2>환영합니다. 회원가입이 완료되었습니다.</h2>
            <h3>
                <?php echo $session_username; ?>님의 아이디는
                <?php echo $session_userid; ?>입니다.
                <h4>마이페이지에서 추가 회원정보를 꼭 입력해주세요!</h4>
                <a href="\5015\main\update.php">회원정보 수정</a>
                <a href="\5015\main\loginmain.php">홈페이지 바로가기</a>
    </div>
</body>

</html>