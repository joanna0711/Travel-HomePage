<meta name="viewport" content="width=device-width" initial-scale=1.0>
<link rel="stylesheet" href="login.css">

<?php
include_once "/var/www/html/a_team/a_team5/project/login/encrypted_password.php";
ini_set('display_errors', '0');
if (strtoupper($_SERVER['REQUEST_METHOD']) == "POST") {

  $UserID = $_POST["UserID"];
  $UserPassword = $_POST['UserPassword'];
  $db = '(DESCRIPTION = (ADDRESS_LIST= (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521)) ) (CONNECT_DATA = (SID = orcl)))';
  if (!is_null($UserID)) {
    $connect = oci_connect("DBA2022G5", "test1234", $db);
    $sql = "SELECT UserPassword FROM UserTable WHERE UserID = '$UserID'";
    $result = oci_parse($connect, $sql);
    oci_execute($result);
    while ($row = oci_fetch_array($result, OCI_ASSOC)) {
      foreach ($row as $item) {
        $True_password = $item;
      }
    }
    if (is_null($True_password)) {
      $wu = 1;
    } else {

      if (password_verify($UserPassword, $True_password)) {
        session_start();
        $_SESSION['UserID'] = $UserID;
        echo "<script>alert('로그인이 완료 되었습니다.');</script>";
        echo "<script type='text/javascript'>
        location.href='http://software.hongik.ac.kr/a_team/a_team5/project/login/loginmain.php' 
        </script>";
      } else {
        $wp = 1;
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="nav.css">
  <title>login</title>
  <script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
  </style>
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
  <title>로그인</title>
  </h1>
</head>

<body class="body">
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
        <ul class="menu">
          <li style="margin-left: -140px; margin-right: 100px;">지역별보기
            <ul class="depth" style="margin-left: 0px; margin-top: 5px;">
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">서울</a></li>
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">경기</a></li>
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">충청</a></li>
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">대전</a></li>
            </ul>
          </li>
        </ul>
        <li><a href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">추천여행지</a></li>
        <ul class="menu">
          <li style="margin-left: -140px; margin-right: 100px;">테마여행
            <ul class="depth" style="margin-left: 0px; margin-top: 5px;">
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">데이트</a></li>
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">가족여행</a></li>
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">온천</a></li>
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">산</a></li>
              <li style="width: 160px"><a
                  href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">스포츠</a></li>
            </ul>
          </li>
        </ul>
        <li><a href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">오늘의태그</a></li>
      </ul>

      <div class="link">
        <a href="http://software.hongik.ac.kr/a_team/a_team5/project/register/register.php">회원가입</a>
        <a href="http://software.hongik.ac.kr/a_team/a_team5/project/login/login.php">로그인</a>
      </div>
    </div>
  </div>
  <div class="box">
    <div>
      로그인</div>
    <form action="login.php" method="POST">
      <p><input type="text" name="UserID" class="text-field" placeholder="아이디" required></p>
      <p><input type="password" name="UserPassword" class="text-field" placeholder="비밀번호" required></p>
      <p><input type="submit" value="로그인" class="submit-btn"></p>
      <?php
      if (strtoupper($_SERVER['REQUEST_METHOD']) == "POST") {
        if ($wu == 1) {
          echo "<p>아이디가 존재하지 않습니다.</p>";
        }
        if ($wp == 1) {
          echo "<p>비밀번호가 틀렸습니다.</p>";
        }
      }
      ?>
    </form>
  </div>
</body>

</html>