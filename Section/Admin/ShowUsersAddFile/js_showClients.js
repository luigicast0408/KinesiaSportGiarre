async function showClients() {
    const clientsContainer = document.querySelector('.clients-container');
    console.log('Fetching clients data...'); // Debugging line

    try {
        const url = `http://localhost:8888/API/Api.php?request=clients`;
        console.log(`Fetching from URL: ${url}`);

        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);

        // Check for successful response status
        if (data.status === 200) {
            renderClientsTable(data.clients);
        } else {
            clientsContainer.innerHTML = `<p>${data.message}</p>`;
        }
    } catch (error) {
        clientsContainer.innerHTML = '<p>Error loading user data. Please try again later.</p>';
        console.error('Error fetching clients:', error);
    }
}

// Function to render the clients table
function renderClientsTable(clients) {
    const clientsContainer = document.querySelector('.clients-container');

    let clientsHTML = `
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">New Page</th>
                </tr>
            </thead>
            <tbody>
    `;

    clients.forEach(client => {
        clientsHTML += `
            <tr>
                <td>${client.client_id}</td>
                <td>${client.first_name}</td>
                <td>${client.last_name}</td>
                <td>${client.email}</td>
                <td>${client.phone_number}</td>
                <td>
                    <a href="../../../API/UploadFile/indexUploadFile.php?client_id=${client.client_id}" class="btn btn-primary">Upload File</a>
                </td>
            </tr>
        `;
    });

    clientsHTML += `
            </tbody>
        </table>
    `;

    clientsContainer.innerHTML = clientsHTML;
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#show').addEventListener('click', showClients);
});
