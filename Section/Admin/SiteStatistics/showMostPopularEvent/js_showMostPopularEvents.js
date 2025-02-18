document.addEventListener('DOMContentLoaded', function () {
    const chartCanvas = document.getElementById('event-chart');
    let number_event = 0;
    let chartInstance = null; // Variabile per il grafico

    if (!chartCanvas) {
        console.error('Canvas del grafico non trovato!');
        return;
    }

    function loadEventCount() {
        fetch('/Api/Api.php?request=popularEvents')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Risposta API:', data); // Debug
                if (data.status === 200 && data.data && data.data.number_event !== undefined) {
                    number_event = parseInt(data.data.number_event);
                    renderChart();
                } else {
                    console.warn('Dati non validi:', data);
                }
            })
            .catch(error => {
                console.error('Errore nel recupero dei dati:', error);
            });
    }

    function renderChart() {
        console.log('Event Count:', number_event);

        if (isNaN(number_event) || number_event <= 0) {
            console.warn('Nessun dato valido per il grafico.');
            return;
        }

        const ctx = chartCanvas.getContext('2d');

        // Rimuoviamo il grafico precedente, se esiste
        if (chartInstance) {
            chartInstance.destroy();
        }

        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Partecipanti Eventi'],
                datasets: [{
                    label: 'Numero di partecipanti agli eventi',
                    data: [number_event],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1.5,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }

    loadEventCount();
});