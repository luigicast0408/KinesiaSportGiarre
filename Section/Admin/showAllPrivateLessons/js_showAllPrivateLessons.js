let allPrivateLessons = [];

async function loadPrivateLessons(instructor_id) {
    const privateLessonsContainer = document.querySelector('#private-lessons-container');
    privateLessonsContainer.innerHTML = '<p>Caricamento delle lezioni in corso...</p>';

    try {
        const response = await fetch(`/API/Api.php?request=privateLessons&instructor_id=${instructor_id}`);
        const text = await response.text();

        console.log("Raw response:", text);

        let data;
        try {
            data = JSON.parse(text.trim());
        } catch (jsonError) {
            console.error('JSON Parse error:', jsonError);
            privateLessonsContainer.innerHTML = '<p>Errore nel parsing del JSON dal server.</p>';
            return;
        }

        if (data.status === 200) {
            allPrivateLessons = data.data;
            renderPrivateLessons(allPrivateLessons);
        } else {
            privateLessonsContainer.innerHTML = `<p>${data.message}</p>`;
        }
    } catch (error) {
        privateLessonsContainer.innerHTML = '<p>Errore nel caricamento delle lezioni.</p>';
        console.error('Error fetching private lessons:', error);
    }
}

function renderPrivateLessons(privateLessons) {
    const privateLessonsContainer = document.querySelector('#private-lessons-container');

    if (!privateLessons || privateLessons.length === 0) {
        privateLessonsContainer.innerHTML = '<p>Nessuna lezione privata disponibile.</p>';
        return;
    }

    let tableHTML = `
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome e Cognome Cliente</th>                 
                    <th>Email</th>                 
                    <th>Telefono</th>                 
                    <th>Orario Inizio</th>
                    <th>Orario Fine</th>
                    <th>Azione</th>
                </tr>
            </thead>
            <tbody>`;

    privateLessons.forEach((lesson, index) => {
        tableHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${lesson.first_name} ${lesson.last_name || 'N/A'}</td> 
                    <td>${lesson.email}</td>
                    <td>${lesson.phone_number}</td>
                    <td>${lesson.start_time}</td>
                    <td>${lesson.end_time}</td>
                    <td>
                    <form action="confimLesson.php" method="post">
                        <button type="submit" class="btn btn-primary" name="success">Conferma</button>
                        <button type="submit" class="btn btn-danger" name="delete">Elimina</button>
                        <input type="hidden" id="private-lesson_id" name="private-lesson_id" value="${lesson.private_lesson_id}">
                    </form>
                    </td>
                </tr>`;
    });

    tableHTML += `
            </tbody>
        </table>`;

    privateLessonsContainer.innerHTML = tableHTML;
}
document.addEventListener('DOMContentLoaded', () => {
    const instructorSelect = document.querySelector('#instructors');
    if (!instructorSelect) {
        console.error('Elemento #instructors non trovato nel DOM');
        return;
    }

    instructorSelect.addEventListener('change', () => {
        const instructorId = instructorSelect.value;
        loadPrivateLessons(instructorId)
            .then(() => {
                console.log('Lezioni private caricate con successo');
            })
            .catch(error => {
                console.error('Errore nel caricamento delle lezioni private:', error);
            });
    });
});
