const $ = (selector) => document.querySelector(selector)

const customNav = $('.navbar-custom');
const webName = $('.web-name');
const textNavbar = document.querySelectorAll('.text-navbar');

// Navbar
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        customNav.style.boxShadow = '0px 0px 10px 2px rgba(0,0,0,0.75)';
        customNav.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
        customNav.style.backdropFilter = 'blur(8px)';
        textNavbar.forEach(e => {
            e.classList.remove('translate-y-1')
        });
        // if(window.scrollY > 570){
        //     customNav.classList.add('text-black');
        //     webName.classList.remove('text-[#E1EEBC]');
        //     webName.classList.add('text-[#016B61]');
        //     customNav.classList.remove('text-white');
        // }
        // else{
        //     customNav.classList.add('text-white');
        //     webName.classList.remove('text-[#016B61]');
        //     webName.classList.add('text-[#E1EEBC]');
        //     customNav.classList.remove('text-black');
        // }
    }
    else {
        textNavbar.forEach(e => {
            e.classList.add('translate-y-1')
        });
        // customNav.classList.remove('text-black');
        // customNav.classList.add('text-white');
        customNav.style.backgroundColor = 'transparent';
        customNav.style.boxShadow = 'none';
        customNav.style.backdropFilter = 'blur(0)';
    }
    customNav.style.transition = 'all .3s ease-out';
    webName.style.transition = 'all .3s ease-out';
    textNavbar.forEach(e => {
        e.style.transition = 'all .2s ease-in-out';
    })
});
