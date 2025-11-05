import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

document.addEventListener('DOMContentLoaded', function () {
    const selectedRtid = document.querySelector('select[name="no_rt"]').value;
    const calendarEl = document.getElementById('calendar')
    fetch(`/jadwal-angkut?no_rt=${selectedRtid}`)
        .then(res => res.json())
        .then(events => {
            const calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                events: events.map(event => ({
                    title: event.status,
                    start: event.jadwal,
                })),
                editable: false,
            });
            console.log(events);

            calendar.render()
        })
});
