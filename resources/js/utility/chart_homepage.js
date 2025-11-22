import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    const chartCanvas = document.getElementById('line-chart');
    const pieCanvas = document.getElementById('pie-chart');

    // Cek elemen dulu
    if (!chartCanvas || !pieCanvas) {
        return;
    }

    // --- 1. Ambil Data dari Dataset ---
    const chartLabels = JSON.parse(chartCanvas.dataset.labels);
    const dataOrganik = JSON.parse(chartCanvas.dataset.organik);
    const dataNonOrganik = JSON.parse(chartCanvas.dataset.anorganik);
    const dataB3 = JSON.parse(chartCanvas.dataset.b3);

    // Hitung Total untuk Pie Chart
    const sumArray = (arr) => arr.reduce((acc, val) => acc + val, 0);
    const totalOrganik = sumArray(dataOrganik);
    const totalNonOrganik = sumArray(dataNonOrganik);
    const totalB3 = sumArray(dataB3);

    // --- 2. Konfigurasi Style Global (Konsisten dengan Dashboard) ---
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#64748b'; // Slate-500

    // Palet Warna (Sesuai Dashboard kamu: Organik=Merah, Non=Biru, B3=Hijau)
    const colors = {
        organik: {
            border: '#ef4444', // Red-500
            bg: 'rgba(239, 68, 68, 0.1)'
        },
        nonOrganik: {
            border: '#3b82f6', // Blue-500
            bg: 'rgba(59, 130, 246, 0.1)'
        },
        b3: {
            border: '#10b981', // Emerald-500
            bg: 'rgba(16, 185, 129, 0.1)'
        }
    };

    const ctx = chartCanvas.getContext('2d');
    const ptx = pieCanvas.getContext('2d');
    let lineChart = null;
    let pieChart = null;

    // --- 3. Fungsi Render Line Chart ---
    function createLineChart() {
        if (lineChart) lineChart.destroy();

        lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    {
                        label: 'Sampah Organik',
                        data: dataOrganik,
                        borderColor: colors.organik.border,
                        backgroundColor: colors.organik.bg,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointBorderWidth: 3,
                        fill: true, // Area di bawah garis diwarnai tipis
                        tension: 0.4 // Garis melengkung (modern look)
                    },
                    {
                        label: 'Non-Organik',
                        data: dataNonOrganik,
                        borderColor: colors.nonOrganik.border,
                        backgroundColor: colors.nonOrganik.bg,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointBorderWidth: 3,
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'B3',
                        data: dataB3,
                        borderColor: colors.b3.border,
                        backgroundColor: colors.b3.bg,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointBorderWidth: 3,
                        fill: true,
                        tension: 0.4
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
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
            }
        });
    }

    // --- 4. Fungsi Render Pie Chart ---
    function createPieChart() {
        if (pieChart) pieChart.destroy();

        pieChart = new Chart(ptx, {
            type: 'doughnut', // Doughnut lebih modern daripada Pie biasa
            data: {
                labels: ['Organik', 'Non-Organik', 'B3'],
                datasets: [{
                    data: [totalOrganik, totalNonOrganik, totalB3],
                    backgroundColor: [
                        colors.organik.border,
                        colors.nonOrganik.border,
                        colors.b3.border
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Lubang tengah lebih besar
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20, font: { weight: '600' } }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                let val = context.parsed;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = total > 0 ? ((val / total) * 100).toFixed(1) + '%' : '0%';
                                return ` ${context.label}: ${val} kg (${percentage})`;
                            }
                        }
                    }
                }
            }
        });
    }

    // --- 5. Observer (Scroll Animation) ---
    // Biar chart-nya baru muncul animasinya pas di-scroll ke bawah
    const chartCard = document.getElementById('chart-card');
    const pieCard = document.getElementById('pie-card');

    const observerOptions = { threshold: 0.2 };

    if (chartCard) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                createLineChart();
                observer.unobserve(chartCard);
            }
        }, observerOptions);
        observer.observe(chartCard);
    }

    if (pieCard) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                createPieChart();
                observer.unobserve(pieCard);
            }
        }, observerOptions);
        observer.observe(pieCard);
    }
});
