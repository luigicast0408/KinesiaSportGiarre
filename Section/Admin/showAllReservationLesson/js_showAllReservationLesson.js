document.addEventListener('DOMContentLoaded', function () {
    let allReservations = [];
    const lessonSelect = document.getElementById('lesson');

    function loadLessons() {
        fetch('http://localhost:8888/API/Api.php?request=lessons')
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    lessonSelect.innerHTML = '';
                    data.data.forEach(lesson => {
                        const option = document.createElement('option');
                        option.value = lesson.lesson_id;
                        option.textContent = `${lesson.discipline} - ${lesson.lesson_date}`;
                        lessonSelect.appendChild(option);
                    });

                    if (data.data.length > 0) {
                        loadReservations(data.data[0].lesson_id);
                    }
                } else {
                    lessonSelect.innerHTML = '<h3>Nessuna lezione disponibile</h3>';
                }
            })
            .catch(error => {
                console.error('Error loading lessons:', error);
            });
    }

    function renderReservations(reservations) {
        const reservationContainer = document.getElementById('reservation-container');
        if (!reservationContainer) {
            console.error('Reservation container not found!');
            return;
        }

        reservationContainer.innerHTML = '';
        if (!reservations || reservations.length === 0) {
            reservationContainer.innerHTML = '<p>Nessuna prenotazione trovata</p>';
            return;
        }

        let tableHTML = `
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Data e ora</th>
                    <th>Durata</th>
                    <th>Disciplina</th>
                </tr>
            </thead>
            <tbody>`;

        reservations.forEach((reservation, index) => {
            tableHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${reservation.first_name}</td>
                <td>${reservation.last_name}</td>
                <td>${reservation.email}</td>
                <td>${reservation.phone_number}</td>
                <td>${reservation.reservation_date}</td>
                <td>${reservation.duration}</td>
                <td>${reservation.discipline}</td>
            </tr>`;
        });

        tableHTML += `
            </tbody>
        </table>`;
        reservationContainer.innerHTML = tableHTML;
    }

    function loadReservations(lessonId) {
        if (!lessonId) return;
        fetch(`http://localhost:8888/API/Api.php?request=reservations&lessonId=${lessonId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    allReservations = data.data;
                    renderReservations(allReservations);
                } else {
                    renderReservations([]);
                }
            })
            .catch(error => {
                console.error('Error loading reservations:', error);
                renderReservations([]);
            });
    }

    loadLessons();
    document.querySelector('#showAllReservations').addEventListener('click', () => {
        renderReservations(allReservations);
    });
});
