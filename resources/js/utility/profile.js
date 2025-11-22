const $ = (selector) => document.querySelector(selector)

const customNav = $('.navbar-custom');
const webName = $('.web-name');
const textNavbar = document.querySelectorAll('.text-navbar');

textNavbar.forEach(e => {
    e.classList.add('text-white');
});
webName.classList.add('text-[#E1EEBC]');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        customNav.style.boxShadow = '0px 0px 10px 2px rgba(0,0,0,0.75)';
        customNav.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
        customNav.style.backdropFilter = 'blur(8px)';
        customNav.classList.add('text-black');
        textNavbar.forEach(e => {
            e.classList.remove('translate-y-1')
        });
        if (window.scrollY > 300) {
            textNavbar.forEach(e => {
                e.classList.remove('text-white');
            });
            webName.classList.remove('text-[#E1EEBC]');
        } else {
            textNavbar.forEach(e => {
                e.classList.add('text-white');
            });
            webName.classList.add('text-[#E1EEBC]');
        }
    }
    else {
        textNavbar.forEach(e => {
            e.classList.add('translate-y-1')
        });
        customNav.classList.remove('text-black');
        customNav.style.backgroundColor = 'transparent';
        customNav.style.boxShadow = 'none';
        customNav.style.backdropFilter = 'blur(0)';
    }
    textNavbar.forEach(e => {
        e.style.transition = 'all .3s ease-in-out';
    })

    customNav.style.transition = 'all .3s ease-out';
    webName.style.transition = 'all .3s ease-out';
});
