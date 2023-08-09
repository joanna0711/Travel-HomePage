<?php
require_once('../db/dbtest.php');
switch ($_GET['mode']) {
    case 'register':
        $id = $_POST['id'];
        $userid = $_POST['userid'];
        $pw1 = $_POST['pw1'];
        $pw2 = $_POST['pw2'];
        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $birth = $_POST['birth'];

        echo $id . ',' . $userid . ',' . $pw1 . ',' . $pw2 . ',' . $name . ',' . $sex . ','.$birth.',' . $tel . ',' . $email;
        $sql = "SELECT userid FROM register WHERE userid = '$userid'";
        $stid = oci_parse($connect, $sql);
        oci_execute($stid);
        echo "\sucess";
        $sqls = "INSERT INTO register (id, userid, pw, name, sex, birth, tel, email) VALUES('$id', '$userid', '$pw1', '$name', '$sex', TO_DATE('$birth', 'YYYY-MM-DD'),'$tel', '$email')";

    
        echo "\sucess";

        $result = oci_parse($connect,$sqls);

        oci_execute($result);
        echo "\sucess";
        oci_close($connect);

        header('../main.php');
        break;
}
?>