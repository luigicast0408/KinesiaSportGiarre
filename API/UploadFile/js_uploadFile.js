// Get the client ID from the URL parameters
const urlParams = new URLSearchParams(window.location.search);
const clientId = urlParams.get('client_id');

// Log client ID to ensure it's being fetched correctly
console.log("Client ID:", clientId);

// Set the client_id field in the form
document.getElementById('client_id').value = clientId;

document.getElementById('upload-btn').addEventListener('click', async () => {
    const form = document.getElementById('upload-form');
    const formData = new FormData(form);

    try {
        const response = await fetch('http://localhost:8888/API/UploadFile/uploadFile.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        console.log('File Upload Response:', result);

        if (response.ok && result.status === 200) {
            alert(`File for client ${clientId} uploaded successfully!`);
            window.location.href = '../../Section/Admin/indexAdmin.php';
        } else {
            alert(`Error uploading file for client ${clientId}: ${result.message}`);
        }
    } catch (error) {
        console.error('Error uploading file:', error);
        alert(`Error uploading file for client ${clientId}`);
    }
});
