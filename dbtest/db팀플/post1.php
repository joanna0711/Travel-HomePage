<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="content-type" content="text/html"; charset="utf-8">
    <style>
        table.table2 {
            border-collapse: separate;
            border-spacing: 1px;
            text-align: left;
            line-height: 1.5;
            border-top: 1px solid #ccc;
            margin: 20px 10px;
        }

        table.table2 tr {
            width: 50px;
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }

        table.table2 td {
            width: 100px;
            padding: 10px;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <form enctype="multipart/form-data" method="post" action="post_result.php">
        <!-- method : POST!!! (GET X) -->
        <table style="padding-top:50px"  width=auto  cellpadding=2>
            <tr>
                <td style="height:40; float:center; background-color:#FF7F00">
                    <p style="font-size:25px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>중고거래 글쓰기</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table2">

                        <tr>
                            <td>사진</td>
                            <td><input type="text" name="title" size=10 maxlength=15></td>
                        </tr>
                        <tr>
                            <td>글제목</td>
                            <td><input type="text" name="content" size=30></td>
                        </tr>

                        <tr>
                            <td>가격</td>
                            <td><input type="number" name="post_date" size=20></td>
                        </tr>


                        
                    </table>

                    <div colspan="2">
                        <input style="height:26px; width:80px; font-size:16px;" type="submit" value="작성완료">
                        <input style="height:26px; width:80px; font-size:16px;" onclick="history.back()" type="submit" value="작성취소">
                    </div>

        

                </td>
            </tr>
        </table>
    </form>
</body>

</html>