async function showMostPopularEventsAvg() {
    const popularEventsAvgContainer = document.querySelector('#container-events-avg');
    try {
        const url = '/Api/Api.php?request=eventAvg';
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);

        if (data.status === 200) {
            renderEventAvg(data.data);
        } else {
            popularEventsAvgContainer.innerHTML = `<p>${data.message || 'No events found'}</p>`;
        }

    } catch (error) {
        popularEventsAvgContainer.innerHTML = `<p>Error loading events</p>`;
    }
}

function renderEventAvg(events) {
    const popularEventsAvgContainer = document.querySelector('#container-events-avg');

    if (!events.length) {
        popularEventsAvgContainer.innerHTML = "<p>No popular events found.</p>";
        return;
    }

    let event_avgHTML = `
        <div class="card">
            <div class="card-header">
                <h5>Most Popular Events (Above Avg)</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Location</th>
                        </tr>
                    </thead>
                    <tbody>
    `;

    events.forEach(event => {
        event_avgHTML += `
        <tr>
            <td>${event.event_id}</td>
            <td>${event.event_name}</td>
            <td>${event.location}</td>
        </tr>
        `;
    });

    event_avgHTML += `
                    </tbody>
                </table>
            </div>
        </div>
    `;

    popularEventsAvgContainer.innerHTML = event_avgHTML;
}


document.addEventListener('DOMContentLoaded', () => {
    showMostPopularEventsAvg()
});



