let allSchedules = [];

async function loadSchedules(client_id) {
    const scheduleContainer = document.querySelector('#schedule-container');
    try {
        const url = `/API/Api.php?request=instructorSchedules&client_id=${client_id}`;
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);

        if (data.status === 200 && Array.isArray(data.data)) {
            allSchedules = data.data;
            renderAllSchedules(allSchedules);
        } else {
            scheduleContainer.innerHTML = `<p>${data.message || 'Error loading schedules.'}</p>`;
        }
    } catch (error) {
        scheduleContainer.innerHTML = `<p>${error.message || 'Error loading schedules.'}</p>`;
        console.error('Error fetching schedule', error);
    }
}

function renderAllSchedules(schedules) {
    const scheduleContainer = document.querySelector('#schedule-container');

    if (!schedules || schedules.length === 0) {
        scheduleContainer.innerHTML = `<p>No schedules available.</p>`;
        return;
    }

    let tableHTML = `
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>`;

    schedules.forEach((schedule, index) => {
        tableHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${schedule.first_name !== undefined ? schedule.first_name : 'N/A'}</td>
                <td>${schedule.last_name !== undefined ? schedule.last_name : 'N/A'}</td>
                <td>${schedule.day_of_week !== undefined ? schedule.day_of_week : 'N/A'}</td>
                <td>${schedule.start_time !== undefined ? schedule.start_time : 'N/A'}</td>
                <td>${schedule.end_time !== undefined ? schedule.end_time : 'N/A'}</td>
                <td>
                         <a href="" class="btn btn-warning btn-sm">Edit</a>
                         <a  href="" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>`;
    });

    tableHTML += `
            </tbody>
        </table>`;

    scheduleContainer.innerHTML = tableHTML;
}

document.addEventListener('DOMContentLoaded', () => {
    let client_id = parseInt(document.querySelector('#client_id').value);
    console.log(client_id);
    loadSchedules(client_id);
});
