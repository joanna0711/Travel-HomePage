<meta name="viewport" content="width=device-width" initial-scale=1.0>
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="main.css">

<?php
ini_set('display_errors', '0');
if (strtoupper($_SERVER['REQUEST_METHOD']) == "POST") {

  $UserID = $_POST["UserID"];
  $UserPassword = $_POST['UserPassword'];
  $db = '

(DESCRIPTION = 
    (ADDRESS_LIST=
        (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
    )
    (CONNECT_DATA = 
    (SID = orcl)
    )
)';
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
        location.href='http://203.249.87.56:9302/5015/main/loginmain.php' 
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
  <title>여행사이트</title>
  </h1>
</head>

<body class="body">
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
        <a href="\5015\main\login.php">로그인</a>
        <a href="\5015\main\register.php">회원가입</a>
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