async function loadCourses(section) { //todo check if when the button ALL is chick the function show only  1 section
    const coursesContainer = document.querySelector('#courses-container');
    console.log(`Fetching courses for section: ${section}`); // Debugging line

    try {
        const url = `/API/Api.php?request=courses&section=${section}`;
        console.log(`Fetching from URL: ${url}`);

        const response = await fetch(url);

        // Verifica se la risposta è corretta
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);
        if (data.status === 200) {
            let coursesHTML = '';
            console.log(data);
            data.data.forEach(course => {
                coursesHTML += `
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
            });
            coursesContainer.innerHTML = `<div class="row">${coursesHTML}</div>`;
        } else {
            coursesContainer.innerHTML = `<p>${data.message}</p>`;
        }
    } catch (error) {
        coursesContainer.innerHTML = '<p>Errore nel caricamento dei corsi.</p>';
        console.error('Error fetching courses:', error);
    }
}

function showAll() {
    const coursesContainer = document.querySelector('#courses-container');
    coursesContainer.innerHTML = ''; // Pulisce il contenitore
    Promise.all([loadCourses(0), loadCourses(1)])
        .then(() => {
            console.log('All courses loaded');
        })
        .catch(error => {
            console.error('Error loading all courses:', error);
        });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#load-section-0').addEventListener('click', () => loadCourses(0));
    document.querySelector('#load-section-1').addEventListener('click', () => loadCourses(1));
    document.querySelector('#all').addEventListener('click', () => showAll());
});