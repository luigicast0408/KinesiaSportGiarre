function getQueryParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

document.addEventListener('DOMContentLoaded', function () {
    const eventId = parseInt(getQueryParameter('eventId'), 10);

    console.log('Converted Event ID:', eventId);

    if (!isNaN(eventId)) {
        const apiURL = `/Api/Api.php?request=eventImages&eventIds=${eventId}`;
        console.log(`Fetching: ${apiURL}`);

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    const imagesContainer = document.getElementById('imagesContainer');
                    const carouselImagesContainer = document.getElementById('carouselImagesContainer');
                    let carouselItemsHTML = '';

                    data.data.forEach((image, index) => {
                        const imageCard = `
                            <div class="image-card" data-toggle="modal" data-target="#imageCarousel" data-index="${index}">
                                <img src="${image.link}" alt="Event Image">
                            </div>
                        `;
                        imagesContainer.innerHTML += imageCard;


                        const activeClass = index === 0 ? 'active' : '';
                        carouselItemsHTML += `
                            <div class="carousel-item ${activeClass}">
                                <img src="${image.link}" class="d-block w-100" alt="Event Image">
                            </div>
                        `;
                    });

                    carouselImagesContainer.innerHTML = carouselItemsHTML;
                    const imageCards = document.querySelectorAll('.image-card');
                    imageCards.forEach(card => {
                        card.addEventListener('click', function () {
                            const index = this.getAttribute('data-index');
                            $('#imageCarousel').carousel(parseInt(index));
                        });
                    });

                } else {
                    console.error('Error:', data.message);
                    imagesContainer.innerHTML = `<p>Error: ${data.message}</p>`;
                }
            })
            .catch(error => {
                console.error('Error fetching images:', error);
                document.getElementById('imagesContainer').innerHTML = '<p>Error fetching images.</p>';
            });
    } else {
        console.error('Invalid or missing eventId in the URL');
        document.getElementById('imagesContainer').innerHTML = '<p>Invalid or missing Event ID.</p>';
    }
});
