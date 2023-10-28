const resultContainer = document.querySelector(".review-container");
const pageText = document.querySelector(".page-text");
const prevPage = document.querySelector(".prev-page");
const nextPage = document.querySelector(".next-page");
const pageNumber = document.querySelector("#page-number");

let totalPage;
let data;
let currPage = 1;

document.addEventListener("DOMContentLoaded", () => {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", `/review/fetch/1`);

    xhr.send();

    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            data = JSON.parse(this.responseText);
            console.log(data);
            processResult(data);
        }
    };
});

prevPage &&
    prevPage.addEventListener("click", async () => {
        // console.log('halo');
        if (currPage === 1) {
            return;
        }

        currPage--;
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `/review/fetch/${currPage}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                updateComponentResult(data);
            }
        };
    });
nextPage &&
    nextPage.addEventListener("click", async () => {
        if (currPage === totalPage) {
            return;
        }

        currPage++;
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `/review/fetch/${currPage}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                updateComponentResult(data);
            }
        };
    });

const processResult = (data) => {
    console.log(data);
    totalPage = data.page;
    currPage = 1;
    pageText.innerHTML = `Page <span id="page-number">1</span> of ${data.page}`;
    updateComponentResult(data);
};

const updateComponentResult = (data) => {
    let resultHMTL = "";

    for (let review of data.review.values()) {
        const adminTag1 = ADMIN ? `<p class="username-text">Username : ${review.username}</p>` : "";
        const userTag1 = ADMIN ? "" : `<button id="edit-btn" class="btn" onclick="editReviewCard(${review.review_id})" data="${review.review_id}">Edit</button>`;
        resultHMTL += `
        <div class="review-card">
            <a class="review-detail" href="${review.img_path}">
                <div class="review-img">
                    <img class="review-img-content" src="/media/img/movie/${review.img_path}" alt="${review.title}" />
                </div>
                <div class="review-info">
                    <div class="review-title">
                        <h2 class="movie-title">${review.title}</h2>
                        <h1>
                            <span id="rate-text">(<span class="movie-rate">${review.rate}</span>/10)</span>
                        </h1>
                    </div>
                    <div class="movie-desc-box">
                        <div class="movie-desc-text">
                            <p>${review.comment}</p>
                        </div>
                    </div>
                    <div class="review-date">
                        <p class="create-text">Created : (${review.created_at})</p>
                        <p class="update-text">Updated : (${review.update_at})</p>
                        ${adminTag1}
                    </div>
                </div>
            </a>
            <div class="review-panel">
                ${userTag1}
                <button id="delete-btn" class="btn" onclick="deleteReviewCard('${review.review_id}')" data="${review.review_id}">Delete</button>
            </div>
        </div>
        `;
    }

    resultContainer.innerHTML = resultHMTL;
    pageText.innerHTML = `Page <span id="page-number">${currPage}</span> of ${data.page}`;
    if (currPage != 1) {
        prevPage.disabled = false;
    } else {
        prevPage.disabled = true;
    }

    if (currPage != totalPage) {
        nextPage.disabled = false;
    } else {
        nextPage.disabled = true;
    }
};

const deleteReviewCard = (id) => {
    console.log("delete");
    modalDelete.setAttribute("review_id", id);
    modalDelete.showModal();
};

const editReviewCard = (id) => {
    console.log("edit");
    location.replace(`http://localhost:8080/review/update?review_id=${id}`);
};
