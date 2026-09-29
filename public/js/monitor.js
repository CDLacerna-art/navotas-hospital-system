(function () {
    if (typeof Chart === 'undefined') return;   // CDN blocked → cards and tables still work

    var read = function (id, key) {
        return JSON.parse(document.getElementById(id).dataset[key]);
    };

    Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
    Chart.defaults.color = '#64748b';

    // Admissions per hour
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: read('trendChart', 'labels'),
            datasets: [{
                data: read('trendChart', 'values'),
                borderColor: '#0d9488', backgroundColor: 'rgba(13,148,136,.12)',
                fill: true, tension: .35, borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: function (c) { return c.parsed.y + ' admissions'; } } } },
            scales: {
                y: { beginAtZero: true, suggestedMax: 120, grid: { color: '#eef2f6' } },
                x: { grid: { display: false }, ticks: { maxTicksLimit: 7 } }
            }
        }
    });

    // Bed occupancy donut
    new Chart(document.getElementById('bedChart'), {
        type: 'doughnut',
        data: {
            labels: ['Occupied', 'Available', 'Cleaning', 'Critical'],
            datasets: [{
                data: read('bedChart', 'values'),
                backgroundColor: ['#0d9488', '#34d399', '#f59e0b', '#e11d48'], borderWidth: 0
            }]
        },
        options: { maintainAspectRatio: false, cutout: '72%', plugins: { legend: { display: false } } }
    });

    // Triage bars
    new Chart(document.getElementById('triageChart'), {
        type: 'bar',
        data: {
            labels: ['Immediate', 'Urgent', 'Non-urgent'],
            datasets: [{
                data: read('triageChart', 'values'),
                backgroundColor: ['#e11d48', '#f59e0b', '#10b981'], borderRadius: 8, maxBarThickness: 46
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { color: '#eef2f6' } }, x: { grid: { display: false } } }
        }
    });
})();