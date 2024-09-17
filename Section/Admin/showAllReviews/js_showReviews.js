let allReviews = [];

async function loadReviews() {
    const reviewsContainer = document.querySelector('#review-container');

    try {
        const url = `/API/Api.php?request=reviewsAdmin`;

        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);

        if (data.status === 200 && Array.isArray(data.data)) {
            allReviews = [];  // Clear the reviews array to prevent duplication
            allReviews = allReviews.concat(data.data);  // Add reviews to array
            renderReviews(allReviews);
        } else {
            reviewsContainer.innerHTML = `<p>${data.message || 'Error loading reviews.'}</p>`;
        }
    } catch (error) {
        reviewsContainer.innerHTML = '<p>Error loading reviews.</p>';
        console.error('Error fetching reviews:', error);
    }
}

function renderReviews(reviews) {
    const reviewsContainer = document.querySelector('#review-container');

    if (!reviews || reviews.length === 0) {
        reviewsContainer.innerHTML = '<p>No reviews available.</p>';
        return;
    }

    let tableHTML = `
        <table class="table table-striped table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Course ID</th>
                    <th>Client ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Discipline</th>
                    <th>Phone Number</th>
                    <th>Response</th>
                </tr>
            </thead>
            <tbody>`;

    reviews.forEach((review, index) => {
        tableHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${review.course_id !== undefined ? review.course_id : 'N/A'}</td>
                <td>${review.client_id !== undefined ? review.client_id : 'N/A'}</td>
                <td>${review.first_name !== undefined ? review.first_name : 'N/A'}</td>
                <td>${review.last_name !== undefined ? review.last_name : 'N/A'}</td>
                <td>${review.email !== undefined ? review.email : 'N/A'}</td>
                <td>${review.discipline !== undefined ? review.discipline : 'N/A'}</td>
                <td>${review.phone_number !== undefined ? review.phone_number : 'N/A'}</td>
                <td>
                    <form class="response-form" method="post">
                        <input type="hidden" name="client_id" value="${review.client_id}">
                        <input type="hidden" name="review_id" value="${index+1}">

                        <label for="response_${index+1}" class="form-label">Response:</label>
                        <textarea class="form-control mb-2" name="response" id="response_${index}" rows="2" placeholder="Write your response..."></textarea>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-paper-plane"></i> Submit
                        </button>
                    </form>
                </td>
            </tr>`;
    });

    tableHTML += `
            </tbody>
        </table>`;

    reviewsContainer.innerHTML = tableHTML;

    const forms = document.querySelectorAll('.response-form');
    forms.forEach(form => {
        form.addEventListener('submit', handleResponseSubmit);
    });
}

async function handleResponseSubmit(event) {
    event.preventDefault();

    const form = event.target;
    const clientId = form.querySelector('input[name="client_id"]').value;
    const reviewId = form.querySelector('input[name="review_id"]').value;  // Correct reference to review_id
    const responseText = form.querySelector('textarea[name="response"]').value.trim();  // Trim the response text

    if (!responseText) {
        alert('Please write a response before submitting.');
        return;
    }

    try {
        const url = 'submitResponse.php';
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                client_id: clientId,
                response: responseText,
                review_id: reviewId,
            }),
        });

        const result = await response.text();
        console.log(result); // Log the result from the server
        alert('Response submitted successfully!');
    } catch (error) {
        console.error('Error submitting response:', error);
        alert('Error submitting response.');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    loadReviews();
});
