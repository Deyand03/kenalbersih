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

// Animasi Stat
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Splash Screen ( Kebanggaan gweh )
if (!localStorage.getItem('splashScreenShown')) {
    document.body.classList.add('splash-active');
} else {
    const splashScreen = document.getElementById('splash-screen');
    if (splashScreen) {
        splashScreen.style.display = 'none';
    }
}

function startExitAnimation() {
    const splashScreen = document.getElementById('splash-screen');
    if (splashScreen) {
        splashScreen.classList.add('splash-hidden');
        localStorage.setItem('splashScreenShown', 'true');
        setTimeout(() => {
            splashScreen.style.display = 'none';
        }, 1000);
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const statWarga = document.getElementById('stat-warga');
    const statRt = $('#stat-rt');
    const statSampah = $('#stat-sampah');
    const totalWarga = parseInt(statWarga.dataset.totalWarga);
    const totalRt = JSON.parse(statRt.dataset.totalRt);
    console.log(totalRt)
    const totalSampahTerkelola = parseInt(statSampah.dataset.sampahTerkelola);
    if (statWarga) {
        animateValue(statWarga,0, totalWarga ? totalWarga : 0, 1500);
    }
    if (statRt) {
        animateValue(statRt, 0, totalRt? totalRt : 0, 1500);
    }
    if (statSampah) {
        animateValue(statSampah, 0, totalSampahTerkelola ? totalSampahTerkelola : 0, 2000);
    }
});

if (!localStorage.getItem('splashScreenShown')) {

    let isLoaded = false;
    let isAnimTimeUp = false;
    window.addEventListener('load', () => {
        document.body.classList.remove('splash-active');
        // Data stat (belom kocaq)
    });
    window.addEventListener('load', () => {
        isLoaded = true;
        startExitAnimation();
        if (isAnimTimeUp) {
        }
    });
    setTimeout(() => {
        isAnimTimeUp = true;
        startExitAnimation();
        if (isLoaded) {
        }
    }, 1500);


} else {
    // WIBU WIBU
}
