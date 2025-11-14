import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    const chartCanvas = document.getElementById('line-chart');
    const pieCanvas = document.getElementById('pie-chart');
    console.log('chartCanvas:', chartCanvas);
    if (!chartCanvas) {
        console.log('Elemen grafik tidak ditemukan, hentikan eksekusi.');
        return;
    }
    if (!pieCanvas) {
        console.log("Element pie chart tidak ditemukan");
        return;
    }
    // Data Sampah
    const chartLabels = JSON.parse(chartCanvas.dataset.labels);
    console.log('chartLabels:', chartLabels);
    const dataOrganik = JSON.parse(chartCanvas.dataset.organik);
    console.log('dataOrganik:', dataOrganik);
    const dataNonOrganik = JSON.parse(chartCanvas.dataset.anorganik);
    console.log('dataNonOrganik:', dataNonOrganik);
    const dataB3 = JSON.parse(chartCanvas.dataset.b3);
    console.log('dataB3:', dataB3);

    const sumArray = (arr) => arr.reduce((acc, val) => acc + val, 0);
    const totalOrganik = sumArray(dataOrganik);
    const totalNonOrganik = sumArray(dataNonOrganik);
    const totalB3 = sumArray(dataB3);


    // Render Line Chart
    const ctx = chartCanvas.getContext('2d');
    const ptx = pieCanvas.getContext('2d');
    let lineChart = null;
    let pieChart = null;

    setTimeout(() => {
        function createLineChart() {
            if (lineChart) {
                lineChart.destroy();
            }
            lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [
                        {
                            label: 'Sampah Organik (kg)',
                            data: dataOrganik,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        },
                        {
                            label: 'Sampah Non-Organik (kg)',
                            data: dataNonOrganik,
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        },
                        {
                            label: 'Sampah B3 (kg)',
                            data: dataB3,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Volume Sampah Bulanan'
                        },
                    },
                }
            });
        }


        // Data Pie Chart
        function createPieChart() {
            if (pieChart) {
                pieChart.destroy()
            }
            pieChart = new Chart(
                ptx, {
                type: 'doughnut',
                data: {
                    labels: ['Organik', 'Non-Organik', 'B3'],
                    datasets: [
                        {
                            label: 'Total Sampah (kg)',
                            data: [totalOrganik, totalNonOrganik, totalB3],
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Total Komposisi Sampah'
                        },
                    }
                }
            }
            )
        }

        // Observer Section
        const chartCard = document.getElementById('chart-card');
        const pieCard = document.getElementById('pie-card');

        if (chartCard) {
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    console.log('Line Chart terlihat, animasi dimulai!');
                    createLineChart();
                    observer.unobserve(chartCard);
                }
            }, {
                threshold: 0.1
            });

            observer.observe(chartCard);
        }
        if (pieCard) {
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    console.log('Pie Chart terlihat, animasi dimulai!');
                    createPieChart();
                    observer.unobserve(chartCard);
                }
            }, {
                threshold: 0.1
            });

            observer.observe(chartCard);
        }

    }, 100);
});
