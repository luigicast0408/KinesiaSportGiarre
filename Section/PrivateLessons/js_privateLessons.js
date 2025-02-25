document.addEventListener("DOMContentLoaded", function () {
    const instructorSelect = document.getElementById("instructor");
    const courseSelect = document.getElementById("course");
    const sectionSelect = document.getElementById("section");
    const calendarEl = document.getElementById("calendar");

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "timeGridWeek",
        locale: "it",
        height: "600px",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "timeGridWeek,timeGridDay"
        },
        events: [],
        eventClick: function (info) {
            handleEventClick(info);
        }
    });

    calendar.render();

    // Funzione per ottenere parametri dall'URL
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    const clientIdFromURL = getQueryParam("client_id");

    // Reset di un elemento <select>
    function resetSelect(selectElement) {
        selectElement.innerHTML = '<option value="">-- Seleziona --</option>';
    }

    // Reset UI completa
    function resetUI() {
        resetSelect(instructorSelect);
        resetSelect(courseSelect);
        calendar.removeAllEvents();
    }

    // Carica gli istruttori
    function loadInstructors() {
        fetch("/API/Api.php?request=instructors")
            .then(response => response.json())
            .then(data => {
                if (data.status === 200 && Array.isArray(data.instructors)) {
                    resetSelect(instructorSelect);
                    data.instructors.forEach(instructor => {
                        instructorSelect.innerHTML += `<option value="${instructor.client_id}">${instructor.first_name} ${instructor.last_name}</option>`;
                    });

                    // Se client_id è presente nell'URL, seleziona automaticamente l'istruttore
                    if (clientIdFromURL) {
                        instructorSelect.value = clientIdFromURL;
                        loadInstructorSchedule(clientIdFromURL);
                    }
                } else {
                    console.error("Errore nel caricamento degli istruttori.");
                }
            })
            .catch(error => console.error("Errore nella richiesta API degli istruttori:", error));
    }

    // Carica i corsi in base alla sezione selezionata
    function loadCourses(section) {
        fetch(`/API/Api.php?request=courses&section=${section}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 200 && Array.isArray(data.data)) {
                    resetSelect(courseSelect);
                    data.data.forEach(course => {
                        courseSelect.innerHTML += `<option value="${parseInt(course.course_id)}">${course.discipline}</option>`;
                    });
                } else {
                    console.error("Errore: Dati non validi ricevuti per i corsi.");
                }
            })
            .catch(error => console.error(`Errore nel caricamento dei corsi per la sezione ${section}:`, error));
    }

    // Carica il calendario dell'istruttore
    function loadInstructorSchedule(clientId) {
        if (!clientId) return;

        fetch(`/API/Api.php?request=instructorSchedules&client_id=${clientId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 200 && Array.isArray(data.data)) {
                    const events = data.data.flatMap(lesson => generateWeeklyEvents(
                        lesson.first_name, lesson.last_name, lesson.day_of_week,
                        lesson.start_time, lesson.end_time, clientId
                    ));

                    calendar.removeAllEvents();
                    calendar.addEventSource(events);
                } else {
                    console.error("Errore nel caricamento degli orari.");
                }
            })
            .catch(error => console.error("Errore nella richiesta API degli orari:", error));
    }

    // Genera eventi settimanali per il calendario
    function generateWeeklyEvents(firstName, lastName, dayOfWeek, startTime, endTime, clientId) {
        let events = [];
        let today = new Date();
        let startDate = new Date(today.setDate(today.getDate() - today.getDay() + parseInt(dayOfWeek)));

        for (let i = 0; i < 4; i++) {
            let eventStart = new Date(startDate);
            let eventEnd = new Date(startDate);
            eventStart.setHours(...startTime.split(":"));
            eventEnd.setHours(...endTime.split(":"));

            events.push({
                title: `${firstName} ${lastName}`,
                start: eventStart.toISOString(),
                end: eventEnd.toISOString(),
                backgroundColor: "#007bff",
                borderColor: "#007bff",
                extendedProps: {
                    clientId: clientId,
                    firstName: firstName,
                    lastName: lastName,
                    startTime: startTime,
                    endTime: endTime
                }
            });

            startDate.setDate(startDate.getDate() + 7);
        }
        return events;
    }

    // Funzione per prenotare una lezione
    function handleEventClick(info) {
        const event = info.event;
        const clientId = event.extendedProps.clientId;

        if (confirm(`Vuoi prenotare questa lezione con ${event.title}?\nOrario: ${event.start.toLocaleString()}`)) {
            bookLesson(clientId, event.start, event.end);
        }
    }

    // Effettua la prenotazione
    // Funzione per prenotare una lezione
    function bookLesson(clientId, start, end) {
        if (!clientId || !start || !end) {
            console.error("Dati non validi per la prenotazione:", { clientId, start, end });
            alert("Errore: dati mancanti.");
            return;
        }

        const formattedStart = formatDateForAPI(start);
        const formattedEnd = formatDateForAPI(end);

        // Controllo che il corso sia selezionato
        const courseId = parseInt(courseSelect.value);
        if (isNaN(courseId)) {
            alert("Errore: seleziona un corso prima di prenotare.");
            return;
        }

        console.log("Prenotazione in corso...", { clientId, start: formattedStart, end: formattedEnd, courseId });

        fetch("bookPrivateLessons.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                client_id: parseInt(clientId),
                start_time: formattedStart,
                end_time: formattedEnd,
                course_id: courseId
            }),
        })
            .then(response => {
                console.log("Risposta HTTP ricevuta:", response);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log("Dati JSON ricevuti:", data); // 🔴 Verifica cosa restituisce l'API

                if (data.status === 200) {
                    alert("Prenotazione effettuata con successo!");
                    loadInstructorSchedule(clientId);
                } else {
                    alert("Errore durante la prenotazione: " + data.message);
                    console.error("Errore nella prenotazione:", data);
                }
            })
            .catch(error => {
                console.error("Errore nella richiesta di prenotazione:", error);
                alert("Si è verificato un errore.");
            });
    }

    function formatDateForAPI(date) {
        const d = new Date(date);
        const year = d.getFullYear();
        const month = String(d.getMonth() + 1).padStart(2, "0");
        const day = String(d.getDate()).padStart(2, "0");
        const hours = String(d.getHours()).padStart(2, "0");
        const minutes = String(d.getMinutes()).padStart(2, "0");
        const seconds = String(d.getSeconds()).padStart(2, "0");
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }


    // EVENT LISTENERS
    instructorSelect.addEventListener("change", function () {
        calendar.removeAllEvents();
        const clientId = instructorSelect.value;
        if (clientId) {
            loadInstructorSchedule(clientId);
        }
    });

    sectionSelect.addEventListener("change", function () {
        const section = parseInt(sectionSelect.value);
        if (!isNaN(section) && section >= 0) {
            console.log("Sezione selezionata:", section);
            loadCourses(section);
        } else {
            console.warn("Sezione non valida:", section);
        }
    });

    // Inizializza il sistema
    resetUI();
    loadInstructors();
    loadCourses(0); // Carica la sezione 0 all'avvio
});