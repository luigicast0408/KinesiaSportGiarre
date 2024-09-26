document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: true,
        events: [],
    });

    calendar.render();

    const sectionSelect = document.getElementById('section');
    const courseSelect = document.getElementById('course');

    sectionSelect.addEventListener('change', function () {
        const section = sectionSelect.value;
        loadCourses(section);
    });

    function loadCourses(section) {
        fetch(`/API/Api.php?request=courses&section=${section}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    courseSelect.innerHTML = '';
                    data.data.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.course_id;
                        option.textContent = course.discipline; // Assuming 'discipline' is the course name
                        courseSelect.appendChild(option);
                    });
                } else {
                    courseSelect.innerHTML = '<option value="">Nessun corso disponibile</option>';
                }
            })
            .catch(error => {
                console.error('Error loading courses:', error);
                courseSelect.innerHTML = '<option value="">Errore nel caricamento dei corsi</option>';
            });
    }

    document.getElementById('addLessonForm').addEventListener('submit', async function (event) {
        event.preventDefault();

        const courseId = parseInt(courseSelect.value);
        const lessonDate = document.getElementById('lesson_date').value;
        const duration = parseInt(document.getElementById('duration').value);
        const discipline = courseSelect.options[courseSelect.selectedIndex].text;
        const location = document.getElementById('location').value;
        const instructor = document.getElementById('instructors').value;
        const price = parseFloat(document.getElementById('price').value);
        const maxParticipants = parseInt(document.getElementById('max_participants').value);

        const response = await fetch('http://localhost:8888/Section/Admin/addLessons/addLessons.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                course_id: courseId,
                lesson_date: lessonDate,
                duration: duration,
                location: location,
                instructor: instructor,
                price: price,
                max_participants: maxParticipants,
            }),
        });

        const result = await response.json();

        if (result.status === 'success') {
            calendar.addEvent({
                title: `Course: ${discipline}`,
                start: lessonDate,
                duration: `PT${duration}M`,

                allDay: false,
            });
            alert('Lesson added successfully!');
            document.getElementById('addLessonForm').reset(); // Clear the form
        } else {
            alert('Error adding lesson: ' + result.message);
        }
    });

    loadCourses(sectionSelect.value);
});
