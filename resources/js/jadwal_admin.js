import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import Swal from 'sweetalert2'

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('jadwal_modal');
    const form = document.getElementById('jadwal-form');
    const modalTitle = document.getElementById('modal-title');

    const eventIdInput = document.getElementById('input-jadwal-id');
    const dateInput = document.getElementById('input-jadwal-date');
    const statusInput = document.getElementById('input-jadwal-status');
    const btnDelete = document.getElementById('btn-delete');

    if (!dateInput || !statusInput) {
        console.error('Elemen input tidak ditemukan!');
        return;
    }

    // --- Helper: Colored Toast ---
    const showToast = (title, icon, color) => {
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: color,
            color: '#fff',
            iconColor: '#fff',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        }).fire({
            icon: icon,
            title: title
        });
    };

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        console.error('CSRF Token missing!');
        return;
    }

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listMonth'
            },
            themeSystem: 'standard',
            height: 'auto',
            locale: 'id',
            editable: true,
            selectable: true,
            events: '/rt/jadwal/events',

            // 1. Klik Tanggal Kosong -> Tambah Event
            dateClick: function (info) {
                resetForm();
                dateInput.value = info.dateStr;
                modalTitle.innerText = 'Tambah Jadwal';
                if (modal) modal.showModal();
            },

            // 2. Klik Event -> Edit/Hapus
            eventClick: function (info) {
                const event = info.event;
                eventIdInput.value = event.id;
                dateInput.value = event.startStr ? event.startStr.split('T')[0] : '';

                if (event.extendedProps && event.extendedProps.status) {
                    statusInput.value = event.extendedProps.status;
                }

                modalTitle.innerText = 'Edit Jadwal';
                btnDelete.classList.remove('hidden');
                if (modal) modal.showModal();
            },

            // 3. Drag & Drop
            eventDrop: function (info) {
                updateEventDate(info.event);
            }
        });

        calendar.render();

        // --- Form Submit Handler ---
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const freshCsrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const id = eventIdInput.value;
                const isUpdate = !!id;
                const url = isUpdate ? `/rt/jadwal/update/${id}` : '/rt/jadwal/store';

                const payload = {
                    jadwal: dateInput.value,
                    status: statusInput.value
                };

                const btnSave = document.getElementById('btn-save');
                const originalText = btnSave.innerText;
                btnSave.innerText = 'Menyimpan...';
                btnSave.disabled = true;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': freshCsrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                    .then(async response => {
                        const isJson = response.headers.get('content-type')?.includes('application/json');
                        const data = isJson ? await response.json() : null;

                        if (!response.ok) {
                            const errorMessage = (data && data.message) || response.statusText;
                            throw new Error(errorMessage);
                        }
                        return data;
                    })
                    .then(data => {
                        if (data && data.success) {
                            if (modal) modal.close();
                            calendar.refetchEvents();
                            resetForm();

                            if (isUpdate) {
                                // Update: Biru
                                showToast('Jadwal berhasil diperbarui!', 'success', '#3b82f6');
                            } else {
                                // Create: Hijau (Emerald)
                                showToast('Jadwal baru ditambahkan!', 'success', '#10b981');
                            }
                        } else {
                            throw new Error('Terjadi kesalahan server.');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        showToast(error.message, 'error', '#ef4444');
                    })
                    .finally(() => {
                        btnSave.innerText = originalText;
                        btnSave.disabled = false;
                    });
            });
        }

        // --- Delete Handler ---
        if (btnDelete) {
            btnDelete.addEventListener('click', function () {
                if (!confirm('Yakin ingin menghapus jadwal ini? Data tidak bisa dikembalikan.')) {
                    return;
                }

                const freshCsrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const id = eventIdInput.value;
                if (!id) return;

                fetch(`/rt/jadwal/delete/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': freshCsrfToken,
                        'Accept': 'application/json'
                    }
                })
                    .then(async response => {
                        if (!response.ok) throw new Error(response.statusText);
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            if (modal) modal.close();
                            calendar.refetchEvents();

                            // Delete: Merah
                            showToast('Jadwal telah dihapus.', 'success', '#ef4444');
                        }
                    })
                    .catch(error => {
                        console.error('Delete Error:', error);
                        showToast('Gagal menghapus data.', 'error', '#ef4444');
                    });
            });
        }
    }

    function resetForm() {
        if (form) form.reset();
        if (eventIdInput) eventIdInput.value = '';
        if (btnDelete) btnDelete.classList.add('hidden');
    }

    function updateEventDate(event) {
        const freshCsrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const id = event.id;
        const newDate = event.startStr.split('T')[0];

        fetch(`/rt/jadwal/update/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': freshCsrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                jadwal: newDate
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Tanggal jadwal diperbarui', 'success', '#3b82f6');
                } else {
                    showToast('Gagal update tanggal', 'error', '#ef4444');
                    event.revert();
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Gagal koneksi server', 'error', '#ef4444');
                event.revert();
            });
    }
});
