async function showTrainingPlans(clientId) {
    const trainingPlansContainer = document.querySelector('.trainingPlans');

    // Check if clientId is valid
    if (!clientId) {
        trainingPlansContainer.innerHTML = '<p>Error: Client ID is missing.</p>';
        return;
    }

    try {
        const url = `/API/Api.php?request=profile&profile=${clientId}`;
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('API Response:', data);

        if (data.status === 200) {
            const plans = data.data;
            trainingPlansContainer.innerHTML = ''; // Clear previous content

            if (plans.length === 0) {
                trainingPlansContainer.innerHTML = '<p>No training plans available for this client.</p>';
                return;
            }

            plans.forEach(plan => {
                const planElement = document.createElement('div');
                planElement.innerHTML = `
                    <p>${plan.file_name}</p>
                    <a href="${plan.file_path}" target="_blank">Download</a>
                `;
                trainingPlansContainer.appendChild(planElement);
            });
        } else {
            trainingPlansContainer.innerHTML = '<p>Error loading training plans data. Please try again later.</p>';
        }
    } catch (error) {
        trainingPlansContainer.innerHTML = `<p>Error: ${error.message}</p>`;
        console.error('Error fetching training plans data:', error);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    console.log('Page loaded. Client ID:', clientId);

    if (clientId) {
        showTrainingPlans(clientId);
    } else {
        document.querySelector('.trainingPlans').innerHTML = '<p>Error: Client ID is missing.</p>';
        console.error('Error: Client ID is missing.');
    }
});

