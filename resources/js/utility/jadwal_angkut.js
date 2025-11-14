import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const rtSelect = document.querySelector('select[name="rt_id"]');
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
        });

        calendar.render();
    }

    function loadEvents(rtId) {
        fetch(`/jadwal-angkut?rt_id=${rtId}`)
            .then(res => res.json())
            .then(events => {
                const mappedEvents = events.map(event => ({
                    title: event.status,
                    start: event.jadwal,
                }));
                if (!calendar) {
                    initCalendar(mappedEvents);
                } else {
                    calendar.setOption('events', mappedEvents);
                }
            })
            .catch(err => console.error('Gagal fetch jadwal:', err));
    }

    if (rtSelect) {
        const initialRtId = rtSelect.value;
        loadEvents(initialRtId);

        rtSelect.addEventListener('change', function() {
            loadEvents(this.value);
        });
    } else {
        console.error('Dropdown RT (select[name="rt_id"]) tidak ditemukan!');
    }
});
