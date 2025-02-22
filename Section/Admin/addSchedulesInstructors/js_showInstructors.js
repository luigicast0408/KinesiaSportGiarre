async function loadInstructors() {
    const instructorSelect = document.querySelector('#instructors');
    if (!instructorSelect) return console.error('Elemento #instructors non trovato nel DOM');

    instructorSelect.innerHTML = '<option value="">Caricamento...</option>'; // Mostra un'opzione di attesa

    try {
        const response = await fetch(`/API/Api.php?request=instructors`);
        if (!response.ok) throw new Error(`Errore API: ${response.statusText}`);

        const data = await response.json();
        if (data.status === 200 && Array.isArray(data.instructors)) {
            instructorSelect.innerHTML = '';
            data.instructors.forEach(instructor => {
                instructorSelect.innerHTML += `<option value="${instructor.instructor_id}">${instructor.first_name} ${instructor.last_name}</option>`;
            });
        } else {
            instructorSelect.innerHTML = '<option value="">Nessun istruttore disponibile</option>';
        }
    } catch (error) {
        console.error('Errore nel caricamento degli insegnanti:', error);
        instructorSelect.innerHTML = '<option value="">Errore nel caricamento</option>';
    }
}
document.addEventListener('DOMContentLoaded', loadInstructors);