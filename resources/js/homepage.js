const $ = (selector) => document.querySelector(selector)

const customNav = $('.navbar-custom');
const webName = $('.web-name');
const textNavbar = document.querySelectorAll('.text-navbar');
console.log(textNavbar)
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
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

document.addEventListener('DOMContentLoaded', () => {
    const statWarga = $('#stat-warga');
    const statRt = $('#stat-rt');
    const statSampah = $('#stat-sampah');
    const totalWarga = statWarga.dataset.totalWarga;
    console.log("ASOMASO", totalWarga)
    const totalRt= JSON.parse(statRt.dataset.totalRt);
    const totalSampahTerkelola = statSampah.dataset.sampahTerkelola;
    if (statWarga) {
        animateValue(statWarga, 0, 1500);
    }
    if (statRt) {
        animateValue(statRt, 0, 1500);
    }
    if (statSampah) {
        animateValue(statSampah, 0, 2000);
    }
});
