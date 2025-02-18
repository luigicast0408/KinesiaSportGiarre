async function showReport(){
    const courseContainer = document.querySelector('#container-courses');
    console.log('Fetching course data...');
    try {
        const url = '/API/Api.php?request=courseNumber';
        console.log(`Fetching from URL: ${url}`);

        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);

        if (data.status === 200) {
            renderCourseTable(data.data);
        } else {
            courseContainer.innerHTML = `<p>${data.message}</p>`;
        }
    } catch (error) {
        courseContainer.innerHTML = '<p>Error loading course data. Please try again later.</p>';
        console.error('Error fetching clients:', error);
    }
}

function renderCourseTable(courses){
    const courseContainer = document.querySelector('#container-courses');
    let coursesHTML = `
        <div class="card">
            <div class="card-header">
                <h5>Course Report</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Discipline</th>
                            <th scope="col">TOT</th>
                        </tr>
                    </thead>
                    <tbody>
    `;

    courses.forEach(course => {
        coursesHTML += `
            <tr>
                <td>${course.course_id}</td>
                <td>${course.discipline}</td>
                <td>${course.num_iscritti}</td>
            </tr>
        `;
    });

    coursesHTML += `
                    </tbody>
                </table>
            </div>
        </div>
    `;

    courseContainer.innerHTML = coursesHTML;
}

document.addEventListener('DOMContentLoaded', () => {
    showReport();
});