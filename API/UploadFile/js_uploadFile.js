const urlParams = new URLSearchParams(window.location.search);
const clientId = urlParams.get('client_id');
console.log("Client ID:", clientId);
document.getElementById('client_id').value =parseInt(clientId);

document.getElementById('upload-btn').addEventListener('click', async () => {
    const form = document.getElementById('upload-form');
    const formData = new FormData(form);

    try {
        const response = await fetch('/API/UploadFile/uploadFile.php', {
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
