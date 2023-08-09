const modal = document.querySelector('.modal');
const modify = document.querySelector('.modify');
const modal_body = document.querySelector('.modal_body');
const close = document.querySelector('.write');

modify.addEventListener('click', () => {
    modal.style.display = 'block';
    modal.style.visibility = 'visible';
    modal_body.style.visibility = "visible";
    document.body.style.overflow = "hidden";
});

close.addEventListener('click', () => {
    modal.style.visibility = 'hidden';
    modal_body.style.visibility = "hidden";
    document.body.style.overflow = "unset";
});