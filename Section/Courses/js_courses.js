async function loadCourses(section) {
    const coursesContainer = document.querySelector('#courses-container');
    console.log(`Fetching courses for section: ${section}`); // Debugging line

    // Pulisce il contenitore dei corsi prima di caricare nuovi dati
    coursesContainer.innerHTML = '';

    try {
        const url = `/API/Api.php?request=courses&section=${section}`;
        console.log(`Fetching from URL: ${url}`);

        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);
        if (data.status === 200) {
            return data.data; // Ritorna i corsi caricati
        } else {
            coursesContainer.innerHTML = `<p>${data.message}</p>`;
            return [];
        }
    } catch (error) {
        coursesContainer.innerHTML = '<p>Errore nel caricamento dei corsi.</p>';
        console.error('Error fetching courses:', error);
        return [];
    }
}

function renderCourse(course) {
    return `
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="${course.image_link}" class="image" alt="">
                <h4 class="card-title">${course.discipline}</h4>
                <div class="card-body">
                    <p class="card-text">${course.course_description}</p>
                </div>
            </div>
        </div>
    `;
}

function renderCourses(courses) {
    let rowsHTML = '';
    for (let i = 0; i < courses.length; i += 3) {
        const rowCourses = courses.slice(i, i + 3); // Prendi 3 corsi alla volta
        rowsHTML += `
            <div class="row">
                ${rowCourses.map(renderCourse).join('')}
            </div>
        `;
    }
    return rowsHTML;
}

async function showAll() {
    const coursesContainer = document.querySelector('#courses-container');
    coursesContainer.innerHTML = ''; // Pulisce il contenitore

    // Carica i corsi di entrambe le sezioni
    const section0Courses = await loadCourses(0);
    const section1Courses = await loadCourses(1);

    // Combina i corsi di entrambe le sezioni
    const allCourses = section0Courses.concat(section1Courses);

    // Renderizza tutti i corsi caricati
    coursesContainer.innerHTML = renderCourses(allCourses);
}

document.addEventListener('DOMContentLoaded', () => {
    showAll();

    document.querySelector('#load-section-0').addEventListener('click', async () => {
        const section0Courses = await loadCourses(0);
        const coursesContainer = document.querySelector('#courses-container');
        coursesContainer.innerHTML = renderCourses(section0Courses);
    });

    document.querySelector('#load-section-1').addEventListener('click', async () => {
        const section1Courses = await loadCourses(1);
        const coursesContainer = document.querySelector('#courses-container');
        coursesContainer.innerHTML = renderCourses(section1Courses);
    });
});
