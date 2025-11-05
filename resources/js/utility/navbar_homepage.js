const $ = (selector) => document.querySelector(selector)

const customNav = $('.navbar-custom');
const webName = $('.web-name');

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        customNav.style.boxShadow = '0px 0px 10px 2px rgba(0,0,0,0.75)';
        customNav.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
        customNav.style.backdropFilter = 'blur(8px)';
        if(window.scrollY > 570){
            customNav.classList.add('text-black');
            webName.classList.remove('text-[#E1EEBC]');
            webName.classList.add('text-[#016B61]');
            customNav.classList.remove('text-white');
        }
        else{
            customNav.classList.add('text-white');
            webName.classList.remove('text-[#016B61]');
            webName.classList.add('text-[#E1EEBC]');
            customNav.classList.remove('text-black');
        }
    }
    else {
        customNav.classList.remove('text-black');
        customNav.classList.add('text-white');
        customNav.style.backgroundColor = 'transparent';
        customNav.style.boxShadow = 'none';
        customNav.style.backdropFilter = 'blur(0)';
    }
    customNav.style.transition = 'all .3s ease-out';
    webName.style.transition = 'all .4s ease-out';
});
