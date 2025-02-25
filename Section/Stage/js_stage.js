document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");
    const modal = document.getElementById("bookingModal");
    const modalTitle = document.getElementById("modalTitle");
    const modalBody = document.getElementById("modalBody");
    const closeModal = document.getElementById("closeModal");
    const bookStageBtn = document.getElementById("bookStage");
    const stageIdInput = document.getElementById("stage_id");
    const clientIdInput = document.getElementById("client_id");

    if (!calendarEl) {
        console.error("Elemento #calendar non trovato!");
        return;
    }

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
            openBookingModal(info.event);
        }
    });
    calendar.render();
    loadStages();

    function loadStages() {
        fetch("/API/Api.php?request=stage")
            .then(response => response.json())
            .then(data => {
                if (!data || !data.data || !Array.isArray(data.data)) {
                    console.error("Dati ricevuti non validi", data);
                    return;
                }
                updateCalendar(data.data);
            })
            .catch(error => console.error("Errore nella richiesta API degli stage:", error));
    }

    function updateCalendar(stages) {
        const events = stages.map(stage => {
            const startDate = new Date(`${stage.date}T${stage.time_start}`);
            const endDate = new Date(`${stage.date}T${stage.time_end}`);

            if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
                console.error("Data non valida per lo stage:", stage);
                return null;
            }

            return {
                title: stage.event_name,
                start: startDate.toISOString(),
                end: endDate.toISOString(),
                id: stage.event_id,
            };
        }).filter(event => event !== null);

        calendar.removeAllEvents();
        calendar.addEventSource(events);
        calendar.refetchEvents();
    }

    function openBookingModal(event) {
        modal.style.display = "block";
        modalTitle.innerText = `Prenota Stage: ${event.title}`;
        stageIdInput.value = event.id;

        modalBody.innerHTML = `
            <p>Data e Ora Inizio: ${new Date(event.start).toLocaleString("it-IT")}</p>
            <p>Data e Ora Fine: ${new Date(event.end).toLocaleString("it-IT")}</p>
        `;
    }

    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    bookStageBtn.addEventListener("click", function () {
        const clientId = parseInt(clientIdInput.value);
        const stageId = parseInt(stageIdInput.value);

        if (!clientId || isNaN(stageId)) {
            alert("Errore: dati mancanti o non validi.");
            return;
        }

        bookStage(clientId, stageId);
    });

    function bookStage(clientId, stageId) {
        fetch("bookStage.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ client_id: clientId, stage_id: stageId })
        })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.status === 200) {
                    alert("Stage prenotato con successo!");
                    modal.style.display = "none";
                    loadStages();
                } else {
                    alert("Errore durante la prenotazione dello stage: " + data.message);
                    console.error("Errore nella prenotazione dello stage:", data);
                }
            })
            .catch(error => {
                console.error("Errore nella richiesta di prenotazione dello stage:", error);
                alert("Si è verificato un errore.");
            });
    }
});
