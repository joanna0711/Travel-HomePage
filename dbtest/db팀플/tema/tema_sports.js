var slidewrapper = document.querySelector('.container'),
    slideContainer = document.querySelector('.slider-container'),
    slide = document.getElementsByClassName('slide'),
    navPrev = document.getElementById('prev'),
    navNext = document.getElementById('next'),
    slideHeight = 0,
    slidecount = slide.length,
    timer = undefined,
    pagerHTML = '',
    pager = document.querySelector('.pager'),
    clickcount = 0;

for(var i=0; i<slidecount; i++){
  if(slideHeight < slide[i].offsetHeight){
    slideHeight = slide[i].offsetHeight;
  }
}


slidewrapper.style.height = slideHeight+'px';
slideContainer.style.height = slideHeight+'px';

for(var j=0; j<slidecount; j++){
  slide[j].style.left = j * 100 +'%';
  pagerHTML += '<span data-idx="'+j+'">'+(j+1)+'</span>';
  pager.innerHTML = pagerHTML;
}

pagerBtn = document.querySelectorAll('.pager span');

function goToSlide(num){
  slideContainer.classList.add('animated');
  slideContainer.style.left = -100 * num +'%';
  clickcount = num;

  for(var h=0; h<pagerBtn.length; h++){
    pagerBtn[h].classList.remove('active');
  }
  pagerBtn[num].classList.add('active');
}
goToSlide(0);

navNext.addEventListener('click',function(){
  if(clickcount == slidecount - 1){
    goToSlide(0);
  }
  else{
    goToSlide(clickcount + 1);
  }
});

navPrev.addEventListener('click',function(){
  if(clickcount == 0){
    goToSlide(slidecount-1);
  }
  else{
    goToSlide(clickcount-1);
  }

});

function autoslide(){
  timer = setInterval(function(){
    var nextIdx  = (clickcount + 1 ) % slidecount;
    goToSlide(nextIdx);
  },2000);

}

autoslide();

function stopautoslide(){
  clearInterval(timer);
}

slidewrapper.addEventListener('mouseenter',function(){
  stopautoslide();
});

slidewrapper.addEventListener('mouseleave',function(){
  autoslide();
});

for(var k=0; k<pagerBtn.length; k++){
  pagerBtn[k].addEventListener('click',function(ev){
    var pagerNum =  ev.target.getAttribute('data-idx');
    goToSlide(pagerNum);
  });
}
