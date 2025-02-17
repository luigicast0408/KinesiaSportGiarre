document.addEventListener('DOMContentLoaded', function () {
    const chartContainer = document.getElementById('bookedLessonsChart');
    let bookedLessonsCount = 0;

    if (!chartContainer) {
        console.error('Container del grafico non trovato!');
        return;
    }

    function loadBookedLessonsCount() {
        fetch('/API/Api.php?request=bookedLessons')
            .then(response => response.json())
            .then(data => {
                console.log('Risposta API:', data);
                if (data.status === 200) {
                    let count = parseInt(data.booked_lessons);  // Assicurati che "booked_lessons" sia corretto nel JSON
                    bookedLessonsCount = count;
                    renderChart();
                } else {
                    chartContainer.innerHTML = '<p>Nessun dato disponibile per le lezioni prenotate.</p>';
                }
            })
            .catch(error => {
                console.error('Errore durante il caricamento delle lezioni prenotate:', error);
            });
    }

    function renderChart() {
        console.log('Booked Lessons Count:', bookedLessonsCount);
        if (isNaN(bookedLessonsCount) || bookedLessonsCount <= 0) {
            chartContainer.innerHTML = '<p>Nessun dato disponibile per il grafico.</p>';
            return;
        }

        // Usa l'ID corretto 'bookedLessonsChart'
        const ctx = document.getElementById('bookedLessonsChart').getContext('2d');

        if (!ctx) {
            console.error('Context of canvas not found!');
            return;
        }

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Lezioni Prenotate'],
                datasets: [{
                    label: 'Numero di Lezioni Prenotate',
                    data: [bookedLessonsCount],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    loadBookedLessonsCount();
});