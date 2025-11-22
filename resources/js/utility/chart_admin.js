import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {

    // --- 1. LINE CHART (Statistik Tahunan) ---
    const lineCtx = document.getElementById('line-chart');
    if (lineCtx) {
        const labels = JSON.parse(lineCtx.dataset.labels);
        const dataOrganik = JSON.parse(lineCtx.dataset.organik);
        const dataNonOrganik = JSON.parse(lineCtx.dataset.nonOrganik); // camelCase dari data-non-organik
        const dataB3 = JSON.parse(lineCtx.dataset.b3);

        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Organik',
                        data: dataOrganik,
                        borderColor: '#f43f5e', // Rose-500
                        backgroundColor: 'rgba(244, 63, 94, 0.1)',
                        tension: 0.4, // Garis melengkung
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Non-Organik',
                        data: dataNonOrganik,
                        borderColor: '#3b82f6', // Blue-500
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'B3',
                        data: dataB3,
                        borderColor: '#10b981', // Emerald-500
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#1f2937',
                        bodyColor: '#4b5563',
                        borderColor: '#e5e7eb',
                        borderWidth: 1,
                        padding: 10,
                        boxPadding: 4
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9', borderDash: [5, 5] },
                        ticks: { padding: 10 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { padding: 10 }
                    }
                }
            }
        });
    }

    // --- 2. PIE CHART  ---
    const pieCtx = document.getElementById('pie-chart');
    if (pieCtx) {
        const valOrganik = parseInt(pieCtx.dataset.organik) || 0;
        const valNonOrganik = parseInt(pieCtx.dataset.nonOrganik) || 0;
        const valB3 = parseInt(pieCtx.dataset.b3) || 0;

        const isDataEmpty = (valOrganik + valNonOrganik + valB3) === 0;
        const pieData = isDataEmpty ? [1] : [valOrganik, valNonOrganik, valB3];
        const pieColors = isDataEmpty
            ? ['#e5e7eb']
            : ['#fb7185', '#60a5fa', '#34d399'];

        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: isDataEmpty ? ['Tidak ada data'] : ['Organik', 'Non-Organik', 'B3'],
                datasets: [{
                    data: pieData,
                    backgroundColor: pieColors,
                    hoverOffset: 4,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '50%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 11 },
                            color: '#4b5563'
                        }
                    },
                    tooltip: {
                        enabled: !isDataEmpty // Matikan tooltip kalau data kosong
                    }
                }
            }
        });
    }
});
