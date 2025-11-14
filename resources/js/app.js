// import Aos from 'aos';
import 'aos/dist/aos.css';
import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// document.addEventListener('DOMContentLoaded', () => {
//     Aos.init({
//         once: false,
//         duration: 1000
//     });
// })
// if (import.meta.hot) {
//     import.meta.hot.on('vite:afterUpdate', () => {
//         Aos.refresh();
//     });
// }

document.addEventListener('DOMContentLoaded', () => {
    const ATRIBUT_NAMA = 'data-animasi';

    const daftarAnimasi = {
        'fade-right': (element) => {
            element.classList.remove('opacity-0', '-translate-x-8');
            element.style.transition = 'all .5s ease-in-out';
        },
        'fade-left': (element) => {
            element.classList.remove('opacity-0', 'translate-x-8');
            element.style.transition = 'all .5s ease-in-out';
        },
        'fade-down': (element) => {
            element.classList.remove('opacity-0', '-translate-y-8');
            element.style.transition = 'all .5s ease-in-out';
        },
        'fade-up': (element) => {
            element.classList.remove('opacity-0', 'translate-y-8');
            element.style.transition = 'all .5s ease-in-out';
        },
        'zoom-in': (element) => {
            element.classList.remove('opacity-0', 'scale-95');
            element.style.transition = 'all .5s ease-in-out';
        },
        'zoom-out': (element) => {
            element.classList.remove('opacity-0', 'scale-105');
            element.style.transition = 'all .5s ease-in-out';
        },
    };

    const setupElement = (e) => {
        const efekNama = e.dataset.animasi;
        if (efekNama === 'fade-right') {
            e.classList.add('opacity-0', '-translate-x-8');
        } else if (efekNama === 'fade-left') {
            e.classList.add('opacity-0', 'translate-x-8');
        } else if (efekNama === 'fade-down'){
            e.classList.add('opacity-0', '-translate-y-8');
        } else if (efekNama === 'fade-up'){
            e.classList.add('opacity-0', 'translate-y-8');
        }else if (efekNama === 'zoom-in') {
            e.classList.add('opacity-0', 'scale-95');
        } else if (efekNama === 'zoom-out') {
            e.classList.add('opacity-0', 'scale-105');
        }
    }

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const e = entry.target;
                const efekNama = e.dataset.animasi;
                const delay = parseInt(e.dataset.delay, 10) || 0;
                const fungsiAnimasi = daftarAnimasi[efekNama];

                if (fungsiAnimasi) {
                    setTimeout(() => {
                        fungsiAnimasi(e);
                    }, delay);
                } else {
                    console.warn(`Animasi "${efekNama}" tidak ditemukan.`);
                }
                observer.unobserve(e);
            }
        });
    }, {
        threshold: 0.2
    });


    const allElement = document.querySelectorAll(`[${ATRIBUT_NAMA}]`);
    allElement.forEach(e => {
        setupElement(e);
        observer.observe(e);
    });
});
