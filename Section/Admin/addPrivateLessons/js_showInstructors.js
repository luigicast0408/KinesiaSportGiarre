async function loadInstructors() {
    try {
        const instructorSelect = document.querySelector('#instructors');

        if (!instructorSelect) {
            console.error('Elemento #instructors non trovato nel DOM');
            return;
        }

        const response = await fetch(`/API/Api.php?request=instructors`);
        if (!response.ok) {
            console.error('Error in the API response:', response.statusText);
            instructorSelect.innerHTML = '<option value="">Errore nel caricamento degli insegnanti</option>';
            return;
        }

        let data;
        try {
            data = await response.json();
        } catch (jsonError) {
            console.error('Error  in the parsing in the JSON response:', jsonError);
            instructorSelect.innerHTML = '<option value="">Errore nel caricamento degli insegnanti</option>';
            return;
        }

        if (data.status === 200 && Array.isArray(data.instructors)) {
            instructorSelect.innerHTML = '';

            data.instructors.forEach(instructor => {
                const option = document.createElement('option');
                option.value = instructor.instructor_id;
                option.textContent = `${instructor.first_name} ${instructor.last_name}`;
                instructorSelect.appendChild(option);
            });
        } else {
            instructorSelect.innerHTML = '<option value="">Nessun istruttore disponibile</option>';
        }
    } catch (error) {
        const instructorSelect = document.querySelector('#instructors');
        if (instructorSelect) {
            instructorSelect.innerHTML = '<option value="">Errore nel caricamento degli insegnanti</option>';
        }
    }
}
document.addEventListener('DOMContentLoaded', () => {
    loadInstructors();
});
