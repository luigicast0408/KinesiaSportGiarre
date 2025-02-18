async function showUsersMakeReview() {
    const userContainer = document.querySelector('#container-users');

    try {
        const url = '/API/api.php?request=clientReviews';
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json();
        console.log('API Response:', result);

        // Verifica che la proprietà data esista e sia un array
        if (result.data && Array.isArray(result.data)) {
            renderReviewUsers(result.data);
        } else {
            throw new Error("Unexpected API response format");
        }

    } catch (error) {
        userContainer.innerHTML = '<p>Error loading userReview data</p>';
        console.error('Error:', error);
    }
}

function renderReviewUsers(reviews) {
    const userContainer = document.querySelector('#container-users');

    if (reviews.length === 0) {
        userContainer.innerHTML = '<p>No reviews available.</p>';
        return;
    }

    let usersHTML = `
        <div class="card">
            <div class="card-header">
                <h5>Users Review Report</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
    `;

    reviews.forEach(review => {
        usersHTML += `
        <tr>
            <td>${review.client_id}</td>
            <td>${review.first_name}</td>
            <td>${review.last_name}</td>
        </tr>
        `;
    });

    usersHTML += `
                    </tbody>
                </table>
            </div>
        </div>
    `;

    userContainer.innerHTML = usersHTML;
}

document.addEventListener('DOMContentLoaded', () => {
    showUsersMakeReview();
});
