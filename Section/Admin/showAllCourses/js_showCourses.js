let allCourses = [];

async function loadCourses(section) {
    const coursesContainer = document.querySelector('#courses-container');
    console.log(`Fetching courses for section: ${section}`);

    try {
        const url = `/API/Api.php?request=courses&section=${section}`;
        console.log(`Fetching from URL: ${url}`);

        const response = await fetch(url)


        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);

        if (data.status === 200) {
            allCourses = allCourses.concat(data.data);  // add course to array
            renderCourses(allCourses);
        } else {
            coursesContainer.innerHTML = `<p>${data.message}</p>`;
        }
    } catch (error) {
        coursesContainer.innerHTML = '<p>Errore nel caricamento dei corsi.</p>';
        console.error('Error fetching courses:', error);
    }
}

function renderCourses(courses) {
    const courseContainer = document.querySelector('#courses-container');

    if (!courses || courses.length === 0) {
        courseContainer.innerHTML = '<p>Nessun corso disponibile.</p>';
        return;
    }

    let tableHTML = `
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>`;

    courses.forEach(course => {
        tableHTML += `
                <tr>
                    <td>${course.course_id !== undefined ? course.course_id : 'N/A'}</td>
                    <td>${course.discipline !== undefined ? course.discipline : 'N/A'}</td>
                    <td>${course.course_description !== undefined ? course.course_description : 'N/A'}</td>
                    <td>
                         <a href="/Section/Admin/uploadCourse/indexUploadCourses.php?courseId=${course.course_id}" class="btn btn-warning btn-sm">Edit</a>
                         <a  href="/Section/Admin/deleteCourse/indexDeleteCorse.php?courseId=${course.course_id}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>`;
    });

    tableHTML += `
            </tbody>
        </table>`;

    courseContainer.innerHTML = tableHTML;
}

document.addEventListener('DOMContentLoaded', () => {
    loadCourses(0);
    loadCourses(1);
});