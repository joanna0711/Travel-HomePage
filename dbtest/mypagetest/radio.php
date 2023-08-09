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

<div class="bottom">
      <button class="open">수정하기</button>
</div> 
<div class ="modal">
            <div class="m1">
<div class ="m1">
<span style="font-size: 23px;"><b>여행타입 수정</b></span>
                <button class="close">
                </button>
</div>
<div class="m2">
                      
<form name="radioform" method="post" action="view_radio.php"> 
    <ul>  
        <li>
              여행테마 : 관광<input type="radio" name= "Thema" value="Watching">
              휴양<input type="radio" name= "Thema" value="Relaxing" > 			
        </li>  
        <li> 여행목적 : 힐링여행 <input type="radio" name="Purpose" value="HealingTour">
              가족여행 <input type="radio" name="Purpose" value="FamilyTour" >
              커플여행 <input type="radio" name="Purpose" value="CoupleTour" >
               우정여행 <input type="radio" name="Purpose" value="FriendshipTour"> 
               기념일 <input type="radio" name="Purpose" value="Anniversary">  	 		
        </li>  
        <li> 인원 수 : 1인 <input type="radio" name="NumberPeople" value="Alone">	
              2~4인 <input type="radio" name="NumberPeople" value="2~4people">
              5~7인 <input type="radio" name="NumberPeople" value="5~7people">
              8인이상 단체<input type="radio" name="NumberPeople" value="Group">		
        </li>  
        <li>자녀동반 : 없음 <input type="radio" name="FamilyType" value="No_kid">
            영유아 <input type="radio" name="FamilyType" value="Baby"> 		
              초중고 <input type="radio" name="FamilyType" value="Student">  			
              성인 <input type="radio" name="FamilyType" value="Adult" >
              
        </li>  
        <li>반려동물 : 유 <input type="radio" name="Animal" value="yes"> 		
              무 <input type="radio" name="Animal" value="no">  			
        </li>  
        <li><input type="submit" value="확인"></li> 
</div>  
    </ul> 
</form> 
</div>

</body> 
</html>
