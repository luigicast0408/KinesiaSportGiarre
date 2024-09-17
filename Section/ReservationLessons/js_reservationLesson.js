document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: false,
        events: [],
        eventClick: function (info) {
            openBookingModal(info.event);
        },
    });
    calendar.render();

    fetch('http://localhost:8888/API/Api.php?request=lessons')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 200 && Array.isArray(data.data)) {
                const lessons = data.data;
                lessons.forEach(lesson => {
                    calendar.addEvent({
                        id: lesson.lesson_id,
                        title: lesson.discipline,
                        start: lesson.lesson_date,
                        allDay: false,
                        duration: `PT${lesson.duration}M`,
                    });
                });
            } else {
                console.error('Nessuna lezione trovata o errore occorso.');
            }
        })
        .catch(error => {
            console.error('Errore durante il caricamento delle lezioni:', error);
        });

    const modal = document.getElementById("bookingModal");
    const closeModalBtn = document.getElementsByClassName("close")[0];

    function openBookingModal(lesson) {
        const startDate = new Date(lesson.start);
        console.log("Start date object:", startDate);

        if (isNaN(startDate)) {
            alert('Invalid lesson start date. Please select a valid lesson.');
            return;
        }

        const mysqlDate = startDate.toISOString().slice(0, 19).replace('T', ' ');
        document.getElementById('lesson').value = lesson.title;
        document.getElementById('start').value = mysqlDate;
        document.getElementById('lesson_id').value = lesson.id;
        modal.style.display = "block";
    }

    closeModalBtn.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    document.getElementById('bookingForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const submitButton = document.getElementById('submit');
        submitButton.disabled = true;

        const lessonTitle = document.getElementById('lesson').value;
        const lessonStart = document.getElementById('start').value;
        const lessonId = document.getElementById('lesson_id').value;
        const client_id = document.getElementById('client_id').value;

        const formData = new URLSearchParams();
        formData.append('lesson', lessonTitle);
        formData.append('start', lessonStart);
        formData.append('userId', client_id);
        formData.append('lesson_id', lessonId);

        fetch('/Section/ReservationLessons/bookLessons.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData.toString()
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 200) {
                    alert('Prenotazione effettuata con successo.');
                    modal.style.display = "none";
                    calendar.refetchEvents();
                } else {
                    alert('Errore durante la prenotazione della lezione: ' + (data.message || 'Errore sconosciuto.'));
                }
            })
            .catch(error => {
                alert('Si è verificato un errore durante la prenotazione della lezione. Riprova più tardi.');
            })
            .finally(() => {
                submitButton.disabled = false;
            });
    });
});
