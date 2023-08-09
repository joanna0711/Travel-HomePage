const modal = document.querySelector('.modal');
const open = document.querySelector('.open');
const modal_body = document.querySelector('.modal_body');
const close = document.querySelector('.write');
const close2 = document.querySelector('.close');

open.addEventListener('click', () => {
    modal.style.display = 'block';
    modal.style.visibility = 'visible';
    modal_body.style.visibility = "visible";
});

close.addEventListener('click', () => {
    modal.style.visibility = 'hidden';
    modal_body.style.visibility = "hidden";
});

close2.addEventListener('click', () => {
    modal.style.visibility = 'hidden';
    modal_body.style.visibility = "hidden";
    document.body.style.overflow = "unset";
});