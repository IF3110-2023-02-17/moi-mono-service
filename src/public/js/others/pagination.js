const resultContainer = document.querySelector(".movie-container");
const pageText = document.querySelector(".page-text");
const prevPage = document.querySelector(".prev-page");
const nextPage = document.querySelector(".next-page");
const pageNumber = document.querySelector("#page-number");

// let totalPage = data.page;
// let currPage = 1;
let totalPage;
let data;
let currPage = 1;
// console.log(totalPage);
// data = JSON.parse(this.responseText);

const fetchAllData = () => {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", `/movie/getAllMovies/1`);

    xhr.send();

    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            console.log(this.responseText);
            data = JSON.parse(this.responseText);
            processResult(data);
        }
    };
};

document.addEventListener("DOMContentLoaded", () => {
    fetchAllData();
});

prevPage &&
    prevPage.addEventListener("click", async () => {
        // console.log('halo');
        if (currPage === 1) {
            return;
        }

        currPage--;
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `/movie/getAllMovies/${currPage}`);

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

        xhr.open("GET", `/movie/getAllMovies/${currPage}`);

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

    for (let movie of data.movies.values()) {
        const adminTag = ADMIN ? `<button class="card-delete-btn btn btn-primary" onclick="deleteMovieCard(${movie.movie_id})" data="${movie.movie_id}">Delete</button>` : "";

        resultHMTL += `
        <div class="movie-card">
            <a href="/movie/detail/${movie.movie_id}" class="movie-thumbnail">
                <img class="movie-img" src="/media/img/movie/${movie.img_path}" alt="${movie.title}" />
            </a>
            <div class="movie-header">
                <h4 class="title">${movie.title}</p>
            </div>
            ${adminTag}
        </div>
        `;
    }
    console.log(currPage);
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

const deleteMovieCard = (id) => {
    modalDelete.setAttribute("movie_id", id);
    modalDelete.showModal();
};
