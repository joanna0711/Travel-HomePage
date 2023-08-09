<html> 
<head> 
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="radio.css" rel="stylesheet"> 
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

        //라디오버튼  - 세션입력, css

        $con = oci_connect("DBA2022G5", "test1234", $db);

        if (!$con) {
        echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
        exit();
        }
        echo "디비 연결 성공";

            $Thema = $_POST["Thema"]; 			
            $Purpose = $_POST["Purpose"]; 
            $NumberPeople = $_POST["NumberPeople"]; 
            $FamilyType = $_POST["FamilyType"]; 
            $Animal = $_POST["Animal"]; 
	        $UserID = $_SESSION['UserID']; //'id'맞나?
        
	    //$id = 'test1';
        // $id = "asdf"; //임의로 설정
            echo "ID: $UserID";
            $sql = "UPDATE USERTABLE SET USERTHEMA='$Thema', USERPURPOSE='$Purpose', USERNUMBERPEOPLE='$NumberPeople', USERFAMILYTYPE='$FamilyType', USERANIMAL='$Animal' WHERE USERID = '$UserID'"; //유저테이블안에있는 칼럼명 ="값", 
            echo $sql;
            $ret = oci_execute(oci_parse($con, $sql));
            //$r = oci_parse($con,$sql);
            //oci_execute($r);
            
 
            if($ret){
                echo "데이터 입력 성공";
            }
            else{
                echo "데이터 입력 실패";
            }

            oci_close($con);

            

            
        ?> 

    <ul>  
    <li> <?=$UserID?>님이 선호하는 여행타입 </li>    
        <li>여행테마 : <?= $Thema?></li>    		
        <li>여행목적 : <?= $Purpose?></li> 
        <li>인원 수 : <?= $NumberPeople?></li>    		
        <li>자녀동반 : <?= $FamilyType?></li> 
        <li>반려동물 : <?= $Animal?></li>    		
    </ul> 

</body> 
</html>
