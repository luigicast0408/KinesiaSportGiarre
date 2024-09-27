let allScheduleInstructors = [];

async function loadScheduleInstructors(instructor_id) {
    const instructorSelect = document.querySelector('#instructors').value;
    const instructorId = document.querySelector('#instructor_id').value = instructorSelect;

    const scheduleInstructorsContainer = document.querySelector('#schedule-instructors-container');
    scheduleInstructorsContainer.innerHTML = '<p>Caricamento degli orari in corso...</p>';

    try {
        const url = `/API/Api.php?request=instructorSchedules&instructorId=${instructor_id}`;
        console.log(`Fetching from URL: ${url}`);

        const response = await fetch(url);
        const text = await response.text();
        console.log('Raw API Response:', text);

        const data = JSON.parse(text);
        console.log('Parsed API Response:', data);

        if (data.status === 200) {
            allScheduleInstructors = data.data;
            renderScheduleInstructors(allScheduleInstructors);
        } else {
            scheduleInstructorsContainer.innerHTML = `<p>${data.message}</p>`;
        }
    } catch (error) {
        scheduleInstructorsContainer.innerHTML = '<p>Errore nel caricamento degli orari.</p>';
        console.error('Error fetching schedule instructors:', error);
    }
}

function renderScheduleInstructors(scheduleInstructors) {
    const scheduleInstructorsContainer = document.querySelector('#schedule-instructors-container');

    if (!scheduleInstructors || scheduleInstructors.length === 0) {
        scheduleInstructorsContainer.innerHTML = '<p>Nessun orario disponibile per questo insegnante.</p>';
        return;
    }

    let tableHTML = `
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Giorno</th>
                    <th>Orario Inizio</th>
                    <th>Orario Fine</th>
                </tr>
            </thead>
            <tbody>`;

    scheduleInstructors.forEach((lesson, index) => {
        const giorno = convertNumberToDayOfWeek(lesson.day_of_week);
        tableHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${giorno}</td>
                    <td>${lesson.start_time}</td>
                    <td>${lesson.end_time}</td>
                </tr>`;
    });

    tableHTML += `
            </tbody>
        </table>`;

    scheduleInstructorsContainer.innerHTML = tableHTML;
}

function convertNumberToDayOfWeek(number) {
    switch (number) {
        case 1:
            return 'Lunedì';
        case 2:
            return 'Martedì';
        case 3:
            return 'Mercoledì';
        case 4:
            return 'Giovedì';
        case 5:
            return 'Venerdì';
        case 6:
            return 'Sabato';
        default:
            return 'Giorno non valido';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const instructorSelect = document.querySelector('#instructors');

    if (!instructorSelect) {
        console.error('Element #instructors not found on DOM');
        return;
    }

    instructorSelect.addEventListener('change', () => {
        const instructorId = instructorSelect.value;
        if (instructorId) {
            loadScheduleInstructors(instructorId)
                .then(() => console.log('successfully loaded schedule instructors'))
                .catch(error => console.error('error on load schedule instructor', error));
        }
    });
});
