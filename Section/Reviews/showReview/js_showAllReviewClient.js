document.addEventListener('DOMContentLoaded', function () {
    let allReviews = [];
    const reviewContainer = document.getElementById('reviews-container');

    function loadReviews() {
        fetch('/API/Api.php?request=reviews')
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    allReviews = data.data;
                    renderReviews(allReviews);
                } else {
                    reviewContainer.innerHTML = '<p>Nessuna recensione disponibile</p>';
                }
            })
            .catch(error => {
                console.error('Error loading reviews:', error);
                reviewContainer.innerHTML = '<p>Errore nel caricamento delle recensioni</p>';
            });
    }

    function renderReviews(reviews) {
        if (!reviews || reviews.length === 0) {
            reviewContainer.innerHTML = '<p>Nessuna recensione disponibile</p>';
            return;
        }

        let carouselHTML = `
        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">`;

        reviews.forEach((review, index) => {
            if (index % 3 === 0) {
                carouselHTML += `<div class="carousel-item ${index === 0 ? 'active' : ''}">
                    <div class="row text-center d-flex align-items-stretch">`;
            }

            carouselHTML += `
            <div class="col-md-4 mb-5 mb-md-0 d-flex align-items-stretch">
                <div class="card testimonial-card">
                    <div class="card-up" style="background-color: #${Math.floor(Math.random()*16777215).toString(16)};"></div>
                    <div class="avatar mx-auto bg-white">
                        <img src="../../../Images/logo.png" class="rounded-circle img-fluid" alt="avatar">
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">${review.first_name || 'N/A'} ${review.last_name || 'N/A'}</h4>
                        <hr />
                        <p class="dark-grey-text mt-4">
                            <i class="fas fa-quote-left pe-2"></i>${review.comment || 'N/A'}
                        </p>
                    </div>
                </div>
            </div>`;

            if ((index + 1) % 3 === 0 || index === reviews.length - 1) {
                carouselHTML += `</div></div>`;
            }
        });

        carouselHTML += `
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span>Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span>Next</span>
            </button>
        </div>`;

        reviewContainer.innerHTML = carouselHTML;
    }

    loadReviews();
});
