const movieResultContainer = document.querySelector(".studio-movie-container");
const moviePageText = document.querySelector(".page-text-movie");
const moviePrevPage = document.querySelector(".prev-page-movie");
const movieNextPage = document.querySelector(".next-page-movie");
const moviePageNumber = document.querySelector("#page-number-movie");

movieTotalPage = _movieTotalPage;
movieCurrPage = _movieCurrPage || 1;

document.addEventListener("DOMContentLoaded", () => {
    if (_movieTotalPage) {
        moviePageText.innerHTML = `<span id="page-number">${movieCurrPage}</span> / ${movieTotalPage}`;
        if (movieCurrPage != 1) {
            moviePrevPage.disabled = false;
        } else {
            moviePrevPage.disabled = true;
        }

        if (movieCurrPage != movieTotalPage) {
            movieNextPage.disabled = false;
        } else {
            movieNextPage.disabled = true;
        }
        window.history.pushState(null, document.title, `http://localhost:8001/studio/dashboard/${studio_id}?movie_page=${movieCurrPage}&post_page=${postCurrPage}`);
    }
});

moviePrevPage &&
    moviePrevPage.addEventListener("click", async () => {
        if (movieCurrPage === 1) {
            return;
        }

        movieCurrPage--;
        const xhr = new XMLHttpRequest();

        if (postCurrPage) {
            xhr.open("GET", `/studio/fetch_movie/${studio_id}?movie_page=${movieCurrPage}&post_page=${_postCurrPage}`);
        } else {
            xhr.open("GET", `/studio/fetch_movie/${studio_id}?movie_page=${movieCurrPage}&post_page=${postCurrPage}`);
        }

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                updateComponentResultMovie(data);
            }
        };
    });
movieNextPage &&
    movieNextPage.addEventListener("click", async () => {
        if (movieCurrPage === movieTotalPage) {
            return;
        }

        movieCurrPage++;
        const xhr = new XMLHttpRequest();

        if (postCurrPage) {
            xhr.open("GET", `/studio/fetch_movie/${studio_id}?movie_page=${movieCurrPage}&post_page=${_postCurrPage}`);
        } else {
            xhr.open("GET", `/studio/fetch_movie/${studio_id}?movie_page=${movieCurrPage}&post_page=${postCurrPage}`);
        }

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                updateComponentResultMovie(data);
            }
        };
    });

const updateComponentResultMovie = (data) => {
    let resultHMTL = "";

    for (let movie of data.movies.values()) {
        let button = ``;

        resultHMTL += `
        <div class="movie-card">
            <a href="/movie/detail/${movie.movie_id}" class="movie-thumbnail">
                <img class="movie-img" src="/media/img/movie/${movie.img_path}" alt="${movie.title}" />
            </a>
            <div class="movie-header">
                <h4 class="title">${movie.title}</p>
            </div>
        </div>
        `;
    }

    movieResultContainer.innerHTML = resultHMTL;
    moviePageText.innerHTML = `<span id="page-number">${movieCurrPage}</span> / ${data.movie_count}`;
    if (movieCurrPage != 1) {
        moviePrevPage.disabled = false;
    } else {
        moviePrevPage.disabled = true;
    }

    if (movieCurrPage != movieTotalPage) {
        movieNextPage.disabled = false;
    } else {
        movieNextPage.disabled = true;
    }

    if (postCurrPage === undefined) {
        window.history.pushState(null, document.title, `http://localhost:8001/studio/dashboard/${studio_id}?movie_page=${movieCurrPage}&post_page=${_postCurrPage}`);
    } else {
        window.history.pushState(null, document.title, `http://localhost:8001/studio/dashboard/${studio_id}?movie_page=${movieCurrPage}&post_page=${postCurrPage}`);
    }
};
