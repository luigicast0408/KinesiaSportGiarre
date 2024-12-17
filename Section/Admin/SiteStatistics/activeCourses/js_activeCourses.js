document.addEventListener('DOMContentLoaded', function () {
    const chartContainer = document.getElementById('chart-container');
    let activeCoursesCount = 0;

    function loadActiveCoursesCount() {
        fetch('/API/Api.php?request=activeCourses')
            .then(response => response.json())
            .then(data => {
                console.log('Risposta API:', data);
                if (data.status === 200) {
                    let count = parseInt(data.active_courses);
                    activeCoursesCount = count;
                    console.log('Conteggio corsi attivi:', activeCoursesCount);
                    renderChart();
                } else {
                    chartContainer.innerHTML = '<p>Nessun dato disponibile per i corsi attivi.</p>';
                }
            })
            .catch(error => {
                console.error('Errore durante il caricamento dei corsi attivi:', error);
            });
    }

    function renderChart() {
        console.log('Active Courses Count:', activeCoursesCount);
        if (isNaN(activeCoursesCount) || activeCoursesCount <= 0) {
            chartContainer.innerHTML = '<p>Nessun dato disponibile per il grafico.</p>';
            return;
        }

        const ctx = document.getElementById('activeCoursesChart').getContext('2d');
        console.log('Contesto del grafico:', ctx);

        if (!ctx) {
            console.error('Contesto del canvas non trovato!');
            return;
        }

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Corsi Attivi'],
                datasets: [{
                    label: 'Numero di Corsi Attivi',
                    data: [activeCoursesCount],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    loadActiveCoursesCount();
});