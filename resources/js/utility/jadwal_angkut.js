import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const rtSelect = document.getElementById('rt-select');
    let calendar = null;

    function initCalendar(initialEvents) {
        if (calendar) {
            calendar.destroy();
        }

        calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            locale: 'id',
            timeZone: 'local',

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            height: 'auto',
            aspectRatio: 2,
            events: initialEvents,
            editable: false,

            eventDidMount: function(info) {
                info.el.title = info.event.title + ' pada ' + info.event.start.toLocaleDateString('id-ID');
            }
        });

        calendar.render();
    }

    function loadEvents(rtId) {
        fetch(`/jadwal-angkut?rt_id=${rtId}`)
            .then(res => res.json())
            .then(events => {
                const mappedEvents = events.map(event => {
                    // Cek status (case-insensitive biar aman)
                    const status = event.status || '';
                    const isDiangkut = status.toLowerCase() === 'diangkut';

                    return {
                        title: status, // Judul event sesuai status
                        start: event.jadwal,
                        // Warna Hijau (#10b981) kalau diangkut, Abu (#9ca3af) kalau belum
                        backgroundColor: isDiangkut ? '#10b981' : '#9ca3af',
                        borderColor: isDiangkut ? '#10b981' : '#9ca3af',
                        textColor: '#ffffff' // Teks putih biar kontras
                    };
                });

                if (!calendar) {
                    initCalendar(mappedEvents);
                } else {
                    // Hapus event lama, tambah event baru (cara lebih bersih di FullCalendar v6)
                    calendar.removeAllEvents();
                    calendar.addEventSource(mappedEvents);
                }
            })
            .catch(err => console.error('Gagal fetch jadwal:', err));
    }

    if (rtSelect) {
        const initialRtId = rtSelect.value;
        if (initialRtId) {
            loadEvents(initialRtId);
        }

        rtSelect.addEventListener('change', function() {
            loadEvents(this.value);
        });
    } else {
        // Fallback: Kalau rtSelect ga ketemu (mungkin user hapus filternya),
        // coba load default (biasanya id=1 atau null dihandle backend)
        loadEvents('');
        // console.warn('Dropdown RT tidak ditemukan, loading default...');
    }
});
