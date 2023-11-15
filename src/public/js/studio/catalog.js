const resultContainer = document.querySelector(".studio-container");
const pageText = document.querySelector(".page-text");
const prevPage = document.querySelector(".prev-page");
const nextPage = document.querySelector(".next-page");
const pageNumber = document.querySelector("#page-number");

let totalPage = countPage;
let data;
let currPage = currentPage || 1;

document.addEventListener("DOMContentLoaded", () => {
    if (countPage) {
        pageText.innerHTML = `Page <span id="page-number">${currPage}</span> of ${totalPage}`;
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
    }
});

prevPage &&
    prevPage.addEventListener("click", async () => {
        if (currPage === 1) {
            return;
        }

        currPage--;
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `/studio/fetch/${currPage}`);

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

        xhr.open("GET", `/studio/fetch/${currPage}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                updateComponentResult(data);
            }
        };
    });

const updateComponentResult = (data) => {
    let resultHMTL = `<head>
        <link rel="stylesheet" type="text/css" href="/styles/studio/card.css">
    </head>`;

    for (let studio of data.studio.values()) {
        let button = ``;

        if (studio.accept) {
            button = `<button id="studio-btn" class="btn unsubs-btn" onclick="unsubscribe(${studio.studio_id})" data="${studio.studio_id}">Unsubscribe</button>`;
        } else if (studio.pending) {
            button = `<button id="studio-btn" class="btn reject-btn" onclick="resubscribe(${studio.studio_id})" data="${studio.studio_id}">Reject</button>`;
        } else if (studio.reject) {
            button = `<button id="studio-btn" class="btn pending-btn" data="${studio.studio_id}" disabled>Pending</button>`;
        } else {
            button = `<button id="studio-btn" class="btn subs-btn" onclick="subscribe(${studio.studio_id})" data="${studio.studio_id}">Subscribe</button>`;
        }

        resultHMTL += `
        <div class="studio-card" id="${studio.studio_id}" >
            <div class="studio-detail">
                <div class="studio-name-wrap">
                    <h2 class="studio-name">${studio.name}</h2>
                </div>
                <div class="studio-description-wrap">
                    <p class="studio-description">
                        ${studio.description}
                    </p>
                </div>
            </div>
            <div class="studio-panel">
                ${button}
            </div>
        </div>
        `;
    }

    resultContainer.innerHTML = resultHMTL;
    pageText.innerHTML = `Page <span id="page-number">${currPage}</span> of ${data.countPage}`;
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

    window.history.pushState(null, document.title, `http://localhost:8001/studio/${currPage}`);
};
