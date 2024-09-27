let allScheduleInstructors = [];
let allScheduleInstructorsFiltered = [];

async function loadScheduleInstructors(instructorId) {
    try {
        const response = await fetch(`/API/Api.php?request=instructorSchedules&instructorId=${instructorId}`);
        const data = await response.json();
        console.log('Dati ricevuti:', data);

        if (data.status === 200) {
            allScheduleInstructors = Array.isArray(data.data) ? data.data : [];
            allScheduleInstructorsFiltered = allScheduleInstructors;
            renderScheduleInstructors();
        } else {
            console.error('Errore API:', data.message);
            const messageContainer = document.querySelector('#message-container');
            messageContainer.innerHTML = `<p class="text-danger">${data.message}</p>`;
        }
    } catch (error) {
        console.error('Errore nel caricamento degli orari degli istruttori:', error);
        const messageContainer = document.querySelector('#message-container');
        messageContainer.innerHTML = '<p class="text-danger">Errore nel caricamento dei dati.</p>';
    }
}

function renderScheduleInstructors() {
    const scheduleInstructorsContainer = document.querySelector('#schedule-instructors-container');

    if (!Array.isArray(allScheduleInstructorsFiltered)) {
        console.error('allScheduleInstructorsFiltered non è un array:', allScheduleInstructorsFiltered);
        scheduleInstructorsContainer.innerHTML = '<p class="text-warning">Nessun istruttore trovato.</p>';
        return;
    }

    if (allScheduleInstructorsFiltered.length === 0) {
        scheduleInstructorsContainer.innerHTML = '<p class="text-warning">Nessun istruttore trovato.</p>';
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
                    <th>Azione</th>
                </tr>
            </thead>
            <tbody>
    `;

    allScheduleInstructorsFiltered.forEach((scheduleInstructor, index) => {
        tableHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${covertNumberToDay(scheduleInstructor.day_of_week)}</td>
                <td>${scheduleInstructor.start_time}</td>
                <td>${scheduleInstructor.end_time}</td>
                <td>
                 <form method="post" action="#">
                    <button type="button" class="btn btn-danger delete-schedule-instructor" id="delete" name="delete">Elimina</button
                </form>
                <a href="/Section/Admin/uploadSchedulesInstructors/indexUploadSchedulesInstructors.php?schedule_id=${index + 1}" class="btn btn-warning">Edit</a>
                </td>
            </tr>`;
    });

    tableHTML += `
            </tbody>
        </table>`;

    scheduleInstructorsContainer.innerHTML = tableHTML;

    document.querySelectorAll('.delete-schedule-instructor').forEach(button => {
        button.addEventListener('click', handleDeleteScheduleInstructor);
    });
}

function handleDeleteScheduleInstructor(event) {
    const scheduleInstructorId = event.target.getAttribute('data-schedule-instructor-id');
    console.log('Elimina istruttore con ID:', scheduleInstructorId);
}

function covertNumberToDay(number) {
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
        case 7:
            return 'Domenica';
        default:
            return '';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const instructorSelect = document.querySelector('#instructors');

    if (instructorSelect) {
        instructorSelect.addEventListener('change', () => {
            const instructorId = parseInt(instructorSelect.value);
            console.log('ID istruttore:', instructorId);

            if (!isNaN(instructorId)) {
                loadScheduleInstructors(instructorId);
            }
        });
    }
});


