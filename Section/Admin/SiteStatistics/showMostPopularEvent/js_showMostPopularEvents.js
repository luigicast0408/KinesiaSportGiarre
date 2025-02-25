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
            .then(response => response.text())
            .then(text => {
                console.log('Risposta grezza API:', text);

                try {
                    const data = JSON.parse(text);
                    console.log('Risposta JSON validata:', data);

                    if (data.status === 200 && data.data) {
                        number_event = Array.isArray(data.data) ? data.data.length : parseInt(data.data.number_event);
                        renderChart();
                    } else {
                        console.warn('Formato dati non valido:', data);
                    }
                } catch (error) {
                    console.error('Errore di parsing JSON:', error);
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