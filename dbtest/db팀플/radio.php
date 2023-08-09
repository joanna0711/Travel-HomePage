<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="radio.css" rel="stylesheet"> 
<title>선호하는 여행타입 수정하기</title>
<script src="https://kit.fontawesome.com/9912971766.js" crossorigin="anonymous"></script>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    </style>
</head> 
<body> 
<form name="form1" method="post" action="view_radio.php"> 
    <ul>  
        <li> 여행테마 : 관광 <input type="radio" name="Thema" value="관광"checked > 		
              휴양 <input type="radio" name="=Thema" value="휴양">  			
        </li>  
        <li> 여행목적 : 힐링여행 <input type="radio" name="Purpose" value="힐링"checked>
              가족여행 <input type="radio" name="Purpose" value="가족" >
              커플여행 <input type="radio" name="Purpose" value="커플" >
               우정여행 <input type="radio" name="Purpose" value="우정"> 
               기념일 <input type="radio" name="Purpose" value="기념일">  	 		
        </li>  
        <li> 인원 수 : 1인 <input type="radio" name="NumberPeople" value="1인"checked>	
              2~4인 <input type="radio" name="NumberPeople" value="2인이상">
              5~7인 <input type="radio" name="NumberPeople" value="5인이상">
              8인이상 단체<input type="radio" name="NumberPeople" value="8인이상">		
        </li>  
        <li>자녀동반 : 없음 <input type="radio" name="FamilyType" value="없음"checked >
            영유아 <input type="radio" name="FamilyType" value="아기"> 		
              초중고 <input type="radio" name="FamilyType" value="초중고">  			
              성인 <input type="radio" name="FamilyType" value="성인" >
              
        </li>  
        <li>반려동물 : 유 <input type="radio" name="Animal" value="유"> 		
              무 <input type="radio" name="Animal" value="무"checked>  			
        </li>  
        <li><input type="submit" value="확인"></li> 
    </ul> 
</form> 

</body> 
</html>
