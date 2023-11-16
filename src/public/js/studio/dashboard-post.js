const postResultContainer = document.querySelector(".studio-post-container");
const postPageText = document.querySelector(".page-text-post");
const postPrevPage = document.querySelector(".prev-page-post");
const postNextPage = document.querySelector(".next-page-post");
const postPageNumber = document.querySelector("#page-number-post");

postTotalPage = _postTotalPage;
postCurrPage = _postCurrPage || 1;

console.log(postTotalPage);
console.log(postCurrPage);

document.addEventListener("DOMContentLoaded", () => {
    if (_postTotalPage) {
        postPageText.innerHTML = `<span id="page-number">${postCurrPage}</span> / ${postTotalPage}`;
        if (postCurrPage != 1) {
            postPrevPage.disabled = false;
        } else {
            postPrevPage.disabled = true;
        }

        if (postCurrPage != postTotalPage) {
            postNextPage.disabled = false;
        } else {
            postNextPage.disabled = true;
        }
        window.history.pushState(null, document.title, `http://localhost:8001/studio/dashboard/${studio_id}?movie_page=${movieCurrPage}&post_page=${postCurrPage}`);
    }
});

postPrevPage &&
    postPrevPage.addEventListener("click", async () => {
        if (postCurrPage === 1) {
            return;
        }

        postCurrPage--;
        const xhr = new XMLHttpRequest();

        if (movieCurrPage) {
            xhr.open("GET", `/studio/fetch_post/${studio_id}?movie_page=${movieCurrPage}&post_page=${_postCurrPage}`);
        } else {
            xhr.open("GET", `/studio/fetch_post/${studio_id}?movie_page=${movieCurrPage}&post_page=${postCurrPage}`);
        }

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                updateComponentResultPost(data);
            }
        };
    });
postNextPage &&
    postNextPage.addEventListener("click", async () => {
        if (postCurrPage === postTotalPage) {
            return;
        }

        postCurrPage++;
        const xhr = new XMLHttpRequest();

        if (movieCurrPage) {
            xhr.open("GET", `/studio/fetch_post/${studio_id}?movie_page=${movieCurrPage}&post_page=${_postCurrPage}`);
        } else {
            xhr.open("GET", `/studio/fetch_post/${studio_id}?movie_page=${movieCurrPage}&post_page=${postCurrPage}`);
        }

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                console.log(data);
                updateComponentResultPost(data);
            }
        };
    });

const updateComponentResultPost = (data) => {
    let resultHMTL = "";

    for (let post of data.posts.values()) {
        let body = "";

        if (post.body.length < 300) {
            body = `<p class="body">${post.body}</p>`;
        } else {
            body = `<p class="body">${post.body.slice(0, 277)}...</p>`;
        }

        resultHMTL += `
        <div class="post-card">
            <a class="post-card-wrap" href="/post/${post.post_id}">
                <div class="post-img-wrap">
                    <img class="post-img" src="/media/img/post/${post.img_path}" alt="${post.title}" />
                </div>
                <div class="post-detail-wrap">
                    <div class="post-detail-title">
                        <h4 class="title">${post.title}</p>
                    </div>
                    <div class="post-detail-body">
                        ${body}
                    </div>
                    <div class="post-detail-date">
                        <p class="date">${post.updated_at}</p>
                    </div>
                </div>    
            </a>
        </div>
        `;
    }

    postResultContainer.innerHTML = resultHMTL;
    postPageText.innerHTML = `<span id="page-number">${postCurrPage}</span> / ${data.post_count}`;
    if (postCurrPage != 1) {
        postPrevPage.disabled = false;
    } else {
        postPrevPage.disabled = true;
    }

    if (postCurrPage != postTotalPage) {
        postNextPage.disabled = false;
    } else {
        postNextPage.disabled = true;
    }

    if (movieCurrPage === undefined) {
        window.history.pushState(null, document.title, `http://localhost:8001/studio/dashboard/${studio_id}?movie_page=${movieCurrPage}&post_page=${_postCurrPage}`);
    } else {
        window.history.pushState(null, document.title, `http://localhost:8001/studio/dashboard/${studio_id}?movie_page=${movieCurrPage}&post_page=${postCurrPage}`);
    }
};
