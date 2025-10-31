const $ = (selector) => document.querySelector(selector)

const customNav = $('.navbar-custom');

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        customNav.style.boxShadow = '0px 0px 10px 2px rgba(0,0,0,0.75)';
        customNav.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
        customNav.style.backdropFilter = 'blur(3px)';
        console.log('scrolled');
        if(window.scrollY > 570){
            console.log('more scrolled');
            customNav.classList.add('text-black');
            customNav.classList.remove('text-white');
        }
        else{
            customNav.classList.add('text-white');
            customNav.classList.remove('text-black');
        }
    }
    else {
        customNav.classList.remove('text-black');
        customNav.classList.add('text-white');
        customNav.style.backgroundColor = 'transparent';
        customNav.style.boxShadow = 'none';
        customNav.style.backdropFilter = 'blur(0)';
        console.log('top');
    }
    customNav.style.transition = 'all .3s ease-out';
});
