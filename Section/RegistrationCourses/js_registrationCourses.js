document.addEventListener('DOMContentLoaded', function () {
    const courseSelect = document.querySelector('#course');
    const sectionSelect = document.querySelector('#section');

    function loadCourses(section) {
        fetch(`/API/Api.php?request=courses&section=${section}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    courseSelect.innerHTML = '';
                    data.data.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.course_id;
                        option.textContent = `${course.discipline}`;
                        courseSelect.appendChild(option);
                    });
                } else {
                    courseSelect.innerHTML = '<option value="">Nessun corso disponibile</option>';
                }
            })
            .catch(error => {
                console.error('Error on load courses', error);
                courseSelect.innerHTML = '<option value="">Errore nel caricamento dei corsi</option>';
            });
    }

    sectionSelect.addEventListener('change', function () {
        const section = sectionSelect.value;
        loadCourses(section);
    });
    loadCourses(sectionSelect.value);
});