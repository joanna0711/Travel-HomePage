<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema_family</title>
    <script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="tema_oncheon.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
</head>

<body>
    <div class="nav_container">
        <div class="search_nav">
            <ul>
                <li><a href="http://software.hongik.ac.kr/a_team/a_team5/project/main/main.html">DayTravel</a></li>
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
                <li> <a href="http://software.hongik.ac.kr/a_team/a_team5/project/legion/cj.php">지역별보기</a>
                </li>
                <li> <a href="http://software.hongik.ac.kr/a_team/a_team5/project/legion/cj1.php">추천여행지</a>
                </li>
                <li> <a href="http://software.hongik.ac.kr/a_team/a_team5/project/tema/tema_family.html">테마여행</a>
                </li>
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
    <div class="container">
        <ul class="slider-container simple-list" id="slider">
            <li class="slide">
                <div class="titles">
                    1. <p class="text_bold">춘천</p>소양강 스카이워크
                </div>
                <img src="가족1.PNG" alt="">
            </li>

            <li class="slide">
                <div class="titles">
                    2. <p class="text_bold">이천</p>별빛정원우주
                </div>
                <img src="가족2.PNG" alt="">
            </li>
            <li class="slide">
                <div class="titles">
                    3. <p class="text_bold">가평</p> 아침고요수목원
                </div>
                <img src="가족3.PNG" alt="">

            </li>
        </ul>
        <p class="pager">

        </p>

        <a href="#" id="prev"></a>
        <a href="#" id="next"></a>
    </div> <!-- end container -->

    <script src="tema_onchen.js">
    </script>
</body>

</html>