document.addEventListener('DOMContentLoaded', function () {
    console.log('fetch_tahun.js loaded');
    const buttonFilter = document.getElementById('button-filter');
    const rtSelect = document.getElementById('rt-select');
    const tahunSelect = document.getElementById('tahun-select');
    rtSelect.addEventListener('change', async function () {
        const selectedRtId = this.value;
        console.log('RT dipilih:', selectedRtId);
        console.log(buttonFilter)
        tahunSelect.innerHTML = '<option>Memuat...</option>';
        buttonFilter.textContent = 'Memuat...'
        tahunSelect.disabled = true;
        buttonFilter.disabled = true;
        try {
            const response = await fetch(`/getTahunByRt?rt_id=${selectedRtId}`);
            console.log('Response dari server diterima', response);
            if (!response.ok) {
                throw new Error('Gagal mengambil data');
            }
            const tahuns = await response.json();
            tahunSelect.innerHTML = '';
            if (tahuns.length > 0) {
                tahuns.forEach(tahun => {
                    const option = document.createElement('option');
                    option.value = tahun;
                    option.textContent = tahun;
                    tahunSelect.appendChild(option);
                });
            } else {
                tahunSelect.innerHTML = '<option value="">Data tahun tidak ada</option>';
            }
        } catch (error) {
            console.error('Error:', error);
            tahunSelect.innerHTML = '<option>Gagal memuat</option>';
        } finally {
            buttonFilter.textContent = 'Tampilkan'
            tahunSelect.disabled = false;
            buttonFilter.disabled = false;
        }
    });
});
