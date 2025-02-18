let allEvents = [];

async function loadEvents() {
    const eventsContainer = document.querySelector('#container-events');
    eventsContainer.innerHTML = '<p>Caricamento degli eventi...</p>';

    try {
        const response = await fetch('/Api/Api.php?request=events');
        const text = await response.text();

        let data;
        try {
            data = JSON.parse(text.trim());
        } catch (jsonError) {
            console.error('JSON Parse error:', jsonError);
            eventsContainer.innerHTML = '<p>Errore nel parsing del JSON dal server.</p>';
            return;
        }

        if (data.status === 200) {
            allEvents = data.data;
            renderEvents(allEvents);
        } else {
            eventsContainer.innerHTML = `<p>${data.message}</p>`;
        }

    } catch (error) {
        eventsContainer.innerHTML = '<p>Errore nel caricamento degli eventi.</p>';
        console.error('Error fetching events:', error);
    }
}

function renderEvents(events) {
    const eventsContainer = document.querySelector('#container-events');

    if (!events || events.length === 0) {
        eventsContainer.innerHTML = '<p class="no-events">Nessun evento trovato</p>';
        return;
    }

    let tableHTML = `
        <table class="events-table">
            <thead>
                <tr>
                    <th>Nome Evento</th>
                    <th>Data</th>
                    <th>Ora</th>
                    <th>Luogo</th>
                    <th>Descrizione</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
    `;

    events.forEach(event => {
        tableHTML += `
            <tr>
                <td>${event.event_name}</td>
                <td>${new Date(event.date).toLocaleDateString()}</td>
                <td>${event.time}</td>
                <td>${event.location}</td>
                <td>${event.event_description}</td>
                <td class="actions">
                    <form action="registrationEvents.php" method="post">
                        <input type="hidden" name="event_id" value="${event.event_id}">
                        <button type="submit" class="btn-register">
                            Iscriviti <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </td>
            </tr>
        `;
    });

    tableHTML += `
            </tbody>
        </table>
    `;

    eventsContainer.innerHTML = tableHTML;
}

document.addEventListener('DOMContentLoaded', () => {
    loadEvents().catch(error => {
        document.querySelector('#container-events').innerHTML = '<p>Errore nel caricamento.</p>';
    });
});
