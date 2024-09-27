document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendar');
    const instructorSelect = document.getElementById('instructors');
    const errorMessageEl = document.getElementById('errorMessage');
    const modal = document.getElementById("bookingModal");
    const closeModalBtn = document.getElementsByClassName("close")[0];
    const modalContent = document.getElementById("modalContent");
    const form = document.getElementById('bookingForm');
    let selectedLessonId = null;

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: false,
        events: [],
        eventClick: async function(info) {
            const eventDate = info.event.start;
            const formattedDate = eventDate.toLocaleDateString();

            const instructorId = parseInt(instructorSelect.value); // ID insegnante
            const dayOfWeek = parseInt(eventDate.getDay());

            const startTime = info.event.extendedProps.startTime;
            const endTime = info.event.extendedProps.endTime;

            console.log('Dettagli evento:', instructorId, dayOfWeek, startTime, endTime);
            document.getElementById('instructor_id').value = instructorId;

            if (!instructorId) {
                alert("Seleziona un insegnante prima di procedere.");
                return;
            }

            if (!startTime || !endTime) {
                alert("L'orario dell'evento non è valido.");
                return;
            }

            await getInstructorScheduleId(instructorId, dayOfWeek, startTime, endTime);

            if (!selectedLessonId) {
                alert('Errore: ID della lezione non disponibile.');
                return;
            }

            openBookingModal(info.event, formattedDate);
        },
    });

    calendar.render();

    function loadInstructorSchedules() {
        const instructorId = instructorSelect.value;

        if (!instructorId) {
            errorMessageEl.textContent = 'Seleziona un insegnante.';
            errorMessageEl.style.display = 'block';
            return;
        }

        fetch(`/API/Api.php?request=instructorSchedules&instructorId=${instructorId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 200 && Array.isArray(data.data)) {
                    calendar.removeAllEvents();
                    const scheduleInstructors = data.data;

                    if (scheduleInstructors.length === 0) {
                        errorMessageEl.textContent = 'Nessun orario disponibile per l\'insegnante selezionato.';
                        errorMessageEl.style.display = 'block';
                    } else {
                        errorMessageEl.style.display = 'none';
                        scheduleInstructors.forEach(lesson => {
                            calendar.addEvent({
                                id: lesson.instructor_schedule_id,
                                title: `Lezione privata`,
                                start: `${lesson.lesson_date}T${lesson.start_time}`,
                                end: `${lesson.lesson_date}T${lesson.end_time}`,
                                allDay: false,
                                daysOfWeek: [lesson.day_of_week],
                                extendedProps: {
                                    startTime: lesson.start_time,
                                    endTime: lesson.end_time
                                }
                            });
                        });
                    }
                } else {
                    errorMessageEl.textContent = 'Formato della risposta errato o nessun insegnante disponibile.';
                    errorMessageEl.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Errore durante il caricamento delle lezioni:', error);
                errorMessageEl.textContent = 'Errore durante il caricamento delle lezioni. Riprova più tardi.';
                errorMessageEl.style.display = 'block';
            });
    }
    function convertToISODate(dateStr) {
        const [day, month, year] = dateStr.split('/');
        return `${year}-${month}-${day}`;
    }

    async function getInstructorScheduleId(instructorId, day, start_time, end_time) {
        const url = `/API/Api.php?request=getId&instructorId=${instructorId}&day=${day}&start_time=${encodeURIComponent(start_time)}&end_time=${encodeURIComponent(end_time)}`;
        try {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            if (result.status === 200) {
                selectedLessonId = parseInt(result.data);
                document.getElementById('instructor_schedule_id').value = selectedLessonId;
                console.log(document.getElementById('instructor_schedule_id').value);

                console.log("ID dell'orario dell'insegnante orario:", selectedLessonId);
            } else {
                selectedLessonId = null;
                console.error(result.message);
            }
        } catch (error) {
            console.error("Errore durante la richiesta AJAX:", error);
            selectedLessonId = null;
        }
    }

    instructorSelect.addEventListener('change', loadInstructorSchedules);

    function openBookingModal(lesson, formattedDate) {
        const startTime = lesson.extendedProps.startTime;
        const endTime = lesson.extendedProps.endTime;
        const instructorName = instructorSelect.options[instructorSelect.selectedIndex].text;

        modalContent.innerHTML = `
            <p><strong>Disciplina:</strong> ${lesson.title}</p>
            <p><strong>Insegnante:</strong> ${instructorName}</p>
            <p><strong>Orario:</strong> ${startTime} - ${endTime}</p>
            <p><strong>Data:</strong> ${formattedDate}</p>
        `;
        document.getElementById('data').value = formattedDate;
        modal.style.display = "block";
    }

    closeModalBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        if (!selectedLessonId) {
            alert('Errore: ID della lezione non disponibile.');
            return;
        }

        // Converti la data nel formato YYYY-MM-DD
        const formattedDate = convertToISODate(document.getElementById('data').value);
        formData.append('instructor_schedule_id', selectedLessonId);
        formData.append('data', formattedDate);  // Aggiungi la data convertita

        fetch('bookPrivateLessons.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(responseText => {
                console.log("Risposta dal server:", responseText);

                let data;
                try {
                    data = JSON.parse(responseText);
                } catch (error) {
                    throw new Error("La risposta non è un JSON valido");
                }

                if (data.status === 200) {
                    alert('Prenotazione effettuata con successo!');
                    modal.style.display = "none";
                    calendar.refetchEvents(); // Ricarica gli eventi nel calendario
                } else {
                    alert('Errore durante la prenotazione: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Errore durante la prenotazione:', error);
                alert('Errore durante la prenotazione. Riprova più tardi.');
            });
    });
});