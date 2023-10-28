const resultContainer = document.querySelector(".director-container");
const pageText = document.querySelector(".page-text");
const prevPage = document.querySelector(".prev-page");
const nextPage = document.querySelector(".next-page");
const pageNumber = document.querySelector("#page-number");
const confirmBtn = document.querySelector("#confirm-btn-modal");
const cancelBtn = document.querySelector("#cancel-btn-modal");
const modalDelete = document.querySelector(".modal");

let totalPage;
let data;
let currPage = 1;

document.addEventListener("DOMContentLoaded", () => {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", `/director/fetch/1`);

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

        xhr.open("GET", `/director/fetch/${currPage}`);

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

        xhr.open("GET", `/director/fetch/${currPage}`);

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

    for (let director of data.directors.values()) {
        const adminTag = ADMIN ? `<button class="card-delete-btn btn btn-primary" onclick="deleteDirectorCard(${director.director_id})" ">Delete</button>` : "";
        resultHMTL += `
        <div class="director-card">
            <a href="/director/detail/${director.director_id}" class="director-thumbnail">
                <img class="director-img" src="/media/img/director/${director.img_path}" alt="${director.name}" />
            </a>
            <div class="director-header">
                <h4 class="title">${director.name}</p>
            </div>
            ${adminTag}
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

const deleteDirectorCard = (id) => {
    modalDelete.setAttribute("director_id", id);
    modalDelete.showModal();
};

cancelBtn &&
    cancelBtn.addEventListener("click", () => {
        console.log(`you close ${modalDelete.getAttribute("review_id")}`);
        modalDelete.close();
    });

confirmBtn &&
    confirmBtn.addEventListener("click", () => {
        const directorID = modalDelete.getAttribute("director_id");

        if (!directorID) {
            return;
        }

        const xhr = new XMLHttpRequest();

        xhr.open("DELETE", `/director/delete?director_id=${directorID}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);

                if (!data.error && this.status == 200) {
                    location.replace("http://localhost:8080/director/catalog");
                }
            }
        };
    });
