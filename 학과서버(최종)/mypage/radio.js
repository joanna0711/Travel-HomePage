var targetLink = document.querySelectorAll('.mypage_nav a');
var tabContent = document.querySelectorAll('.mypage_main > div');

for(var i=0; i<targetLink.length; i++){
  targetLink[i].addEventListener('click',function(ev){
    ev.preventDefault();
    var orgTarget = ev.target.getAttribute('href');
    var tabTarget = orgTarget.replace('#','');
    var daddy = ev.target.parentNode;

    for(var j=0; j<tabContent.length; j++){
      tabContent[j].style.display ='none';
    }
    document.getElementById(tabTarget).style.display = 'block';

    for(var k=0; k<targetLink.length; k++){
      targetLink[k].classList.remove('mypage_acitive');
      ev.target.classList.add('mypage_acitive');
    }
  });
}

document.getElementById('mypage_content2').style.display = 'block';