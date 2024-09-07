document.addEventListener('DOMContentLoaded', function() {
    fetch('http://localhost:8888/Api/Api.php?request=events') // Fetch list of events
        .then(response => response.json())
        .then(data => {
            if (data.status === 200) {
                const eventsContainer = document.getElementById('eventsContainer');
                data.data.forEach(event => {
                    const eventCard = `
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="${event.image}" class="card-img-top" alt="${event.event_name}">
                                <div class="card-body">
                                    <h5 class="card-title">${event.event_name}</h5>
                                    <p class="card-text">${event.event_description}</p>
                                    <a href="/Section/Gallery/indexEventGalley.php?eventId=${event.event_id}" class="btn btn-primary">View All Images</a>
                                </div>
                            </div>
                        </div>
                    `;
                    eventsContainer.innerHTML += eventCard;
                });
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error fetching events:', error)); // Log fetch errors
});
