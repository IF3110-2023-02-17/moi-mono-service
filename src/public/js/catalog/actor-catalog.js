const resultContainer = document.querySelector(".actor-container");
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

    xhr.open("GET", `/actor/fetch/1`);

    xhr.send();

    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            console.log(this.responseText);
            data = JSON.parse(this.responseText);
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

        xhr.open("GET", `/actor/fetch/${currPage}`);

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

        xhr.open("GET", `/actor/fetch/${currPage}`);

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

    for (let actor of data.actors.values()) {
        const adminTag = ADMIN ? `<button class="card-delete-btn btn btn-primary" onclick="deleteActorCard(${actor.actor_id})" ">Delete</button>` : "";
        resultHMTL += `
        <div class="actor-card">
            <a href="/actor/detail/${actor.actor_id}" class="actor-thumbnail">
                <img class="actor-img" src="/media/img/actor/${actor.img_path}" alt="${actor.name}" />
            </a>
            <div class="actor-header">
                <h4 class="title">${actor.name}</p>
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

const deleteActorCard = (id) => {
    modalDelete.setAttribute("actor_id", id);
    modalDelete.showModal();
};

cancelBtn &&
    cancelBtn.addEventListener("click", () => {
        console.log(`you close ${modalDelete.getAttribute("review_id")}`);
        modalDelete.close();
    });

confirmBtn &&
    confirmBtn.addEventListener("click", () => {
        const actorID = modalDelete.getAttribute("actor_id");

        if (!actorID) {
            return;
        }

        const xhr = new XMLHttpRequest();

        xhr.open("DELETE", `/actor/delete?actor_id=${actorID}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);

                if (!data.error && this.status == 200) {
                    location.replace("http://localhost:8080/actor/catalog");
                }
            }
        };
    });
