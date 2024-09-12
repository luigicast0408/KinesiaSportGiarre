document.addEventListener('DOMContentLoaded', function () {
    const lessonSelect = document.getElementById('lesson');
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: true,
        events: [],
    });

    calendar.render();

    function loadLessons() {
        fetch('http://localhost:8888/API/Api.php?request=lessons')
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    lessonSelect.innerHTML = '';
                    data.data.forEach(lesson => {
                        const option = document.createElement('option');
                        option.value = lesson.lesson_id; // Use lesson ID for deletion
                        option.textContent = `${lesson.discipline} - ${lesson.lesson_date}`; // Display discipline and lesson date
                        lessonSelect.appendChild(option);
                    });
                } else {
                    lessonSelect.innerHTML = '<option value="">Nessuna lezione disponibile</option>';
                }
            })
            .catch(error => {
                console.error('Error loading lessons:', error);
                lessonSelect.innerHTML = '<option value="">Errore nel caricamento delle lezioni</option>';
            });
    }

    document.getElementById('deleteLessonForm').addEventListener('submit', async function (event) {
        event.preventDefault();

        const lessonId = lessonSelect.value;

        const response = await fetch('http://localhost:8888/Section/Admin/deleteLessons/deleteLessons.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: lessonId }),
        });

        const result = await response.json();

        if (result.status === 'success') {
            alert('Lesson deleted successfully');
            loadLessons();
            calendar.getEventById(lessonId)?.remove(); // Remove event from calendar
        } else {
            alert('Error in deleting lesson: ' + result.message);
        }
    });

    loadLessons();
});
