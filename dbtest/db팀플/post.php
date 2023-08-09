<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="post.css">
</head>
<body>

    <div class="main">
        <span style="background-color:#FBE571"><b>지역이름</b></span>
        <div class="search">
            <input type="text" placeholder="검색어 입력">
            <img class="rg" src="https://s3.ap-northeast-2.amazonaws.com/cdn.wecode.co.kr/icon/search.png" alt="">
        </div>
        <select class="subtag" name="name">
            <option value="subject">제목</option>
            <option value="tag">태그</option>
        </select>
    </div>

<div class="result" style="height: 500px; overflow-y: auto">
    <table class="result_table">
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>     
            </tr>
        </thead>
        <tbody>
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


$con = oci_connect("DBA2022G5", "test1234", $db);

if (!$con) {
echo "Oracle 데이터베이스 접속에 실패 하였습니다.!!", "<br>";
exit();
}

                $num=1;
                $sql="SELECT * FROM POSTTABLE ORDER BY POST_DATE DESC";
                $all=oci_parse($con, $sql);
                oci_execute($all);
                $num_rows = oci_num_rows($all);
                if(!$all)
                    echo "데이터가 없습니다!";
                else
                {
                    while($row=oci_fetch_array($all, OCI_ASSOC+OCI_RETURN_NULLS))
		    {
               

			    $Num = $row['Num'];
                        $Title=$row['Title'];
                        $UserId=$SESSION['UserID'];
                        $Post_date=$row['Post_date'];  
            ?>
            <tr>
                <td> <?=$Num?> </td>
                <td> <?=$Title?> </td>
                <td> <?=$UserId?> </td>
                <td> <?=$Post_date?> </td>
            </tr>
            <?php          
                        $num++;
                    }
                }
            ?>
        </tbody>
    </table>
</div>
       
    <div class="bottom">
        <button class="open">글쓰기</button>
    </div>
    <form method="post" action="post_result.php">
    <div class="modal">
        <div class="modal_body">
            <div class="m1">
                <span style="font-size: 23px;"><b>새 글 작성</b></span>
            </div>
            <div class="m2">
                <span style="font-size: 20px;">제목</span>
                <input style="width: 600px; height: 10px; margin-left: 5px;" type="text" name="Title" size=30>
                <span style="font-size: 20px;">카테고리</span>
                <select class="category" name="TagTitle">
                     <option value="region">지역</option>
                    <option value="jongno">종로</option>
                    <option value="suwon">수원</option>
                    <option value="yongin">용인</option>
                    <option value="sejong">세종</option>
                    <option value="cheongju">청주</option>
                    <option value="daejeon">대전</option>
        
                </select>
            </div>
            <!-- <div class="m3">
                <span style="font-size: 20px;">파일첨부</span>
                <input style="width: 300px; height: 10px; margin-left: 5px;" type="file" name="photo" size=10 maxlength=15>
                <img class="file" src="../image/image.png" alt="">
                <span style="font-size: 20px;">태그</span>
                <input style="width: 340px; height: 10px; margin-left: 5px;" type="text">
                
                <span style="font-size: 20px;">날짜</span>
                <input style="width: 340px; height: 10px; margin-left: 5px;" type="text" name="post_date">
                
            </div> -->
            <div class="m3">
                <span style="font-size: 20px;">태그</span>
                <input style="width: 810px; height: 10px; margin-left: 5px;" type="text">
            </div>
            <span style="font-size: 20px; margin-left: 62px;">내용</span>
            <textarea style="resize: none; margin-bottom: 20px; font-size: 20px; border-radius: 10px; width: 830px; height: 350px; float: right; margin-right: 50px;" name="Content"></textarea>
            <div class="m4">
                <button class="write">작성하기</button>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="post.js"></script>
</form>
</body>
</html>
