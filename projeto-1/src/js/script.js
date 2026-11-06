const btn = document.querySelector('.btn-mobile');
const links = document.getElementById('nav-links');
const icon = document.querySelector('.btn-mobile i');

btn.addEventListener('click', () => {
    links.classList.toggle('show');
    icon.classList.toggle('fa-bars');
    icon.classList.toggle('fa-times');
});

window.addEventListener('scroll', () => {
    const header = document.querySelector('header');

    if (window.scrollY > 0) {
        header.style.boxShadow = '0 4px 10px rgb(0, 0, 0, .1)';
    }else{
        header.style.boxShadow = 'none';
    }
});

function changedSize(){
    if (window.innerWidth <= 972) {
        links.classList.remove('show');
    }
    else{
        links.classList.add('show');
    }
}