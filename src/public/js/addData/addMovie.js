// const addForm = document.querySelector(".addMovie");

const titleInput = document.querySelector("#title");
const descriptionInput = document.querySelector("#description");
const yearInput = document.querySelector("#year");
const durationInput = document.querySelector("#duration");
const posterInput = document.querySelector("#poster");
const trailerInput = document.querySelector("#trailer");

const titleWarn = document.querySelector("#title-warn");
const descriptionWarn = document.querySelector("#description-warn");
const yearWarn = document.querySelector("#year-warn");
const durationWarn = document.querySelector("#duration-warn");
const actorWarn = document.querySelector("#actors-warn");
const directorWarn = document.querySelector("#directors-warn");
const posterWarn = document.querySelector("#poster-warn");
const trailerWarn = document.querySelector("#trailer-warn");
const categoryWarn = document.querySelector("#category-warn");

const categorysInput = document.querySelector("#categorys");
const actorsInput = document.querySelector("#actors");
const directorsInput = document.querySelector("#directors");

const discardBtn = document.querySelector("#discard-btn");
const submitBtn = document.querySelector("#submit-btn");

const confirmBtn = document.querySelector("#confirm-btn-modal");
const cancelBtn = document.querySelector("#cancel-btn-modal");
const modal = document.querySelector(".modal");

const textRegex = /^[a-zA-Z\s]*$/;
const numberRegex = /^[0-9]+$/;

let titleValid = EDIT ? true : false;
let descriptionValid = EDIT ? true : false;
let yearValid = EDIT ? true : false;
let durationValid = EDIT ? true : false;
let actorValid = EDIT ? true : false;
let directorValid = EDIT ? true : false;
let categoryValid = EDIT ? true : false;

let posterValid = EDIT ? true : false;
let trailerValid = EDIT ? true : false;

let selectedCategory = [];
if (EDIT && currCategory) {
    selectedActor = currCategory;
}

let selectedActor = [];
if (EDIT && currActors) {
    selectedActor = currActors;
}

let selectedDirector = [];
if (EDIT && currDirectors) {
    selectedDirector = currDirectors;
}

titleInput &&
    titleInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = titleInput.value;
            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                titleWarn.innerHTML = "Nama tidak bisa kosong!";
                titleWarn.className = "show";
                titleValid = false;
            } else {
                console.log(`Lolos ${input}`);
                titleWarn.innerHTML = "";
                titleWarn.className = "hide";
                titleValid = true;
            }
        }, 300)
    );

descriptionInput &&
    descriptionInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = descriptionInput.value;
            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                descriptionWarn.innerHTML = "Description tidak bisa kosong!";
                descriptionWarn.className = "show";
                descriptionValid = false;
            } else {
                console.log(`Lolos ${input}`);
                descriptionWarn.innerHTML = "";
                descriptionWarn.className = "hide";
                descriptionValid = true;
            }
        }, 300)
    );

yearInput &&
    yearInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = yearInput.value;
            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                yearWarn.innerHTML = "Description tidak bisa kosong!";
                yearWarn.className = "show";
                yearValid = false;
            } else if (!numberRegex.test(input)) {
                console.log(`Tidak Lolos ${input}`);
                yearWarn.innerHTML = "Masukkan hanya angka!";
                yearWarn.className = "show";
                yearValid = false;
            } else if (input > new Date().getFullYear()) {
                console.log(`Tidak Lolos ${input}`);
                yearWarn.innerHTML = "Harus tahun yang valid!";
                yearWarn.className = "show";
                yearValid = false;
            } else {
                console.log(`Lolos ${input}`);
                yearWarn.innerHTML = "";
                yearWarn.className = "hide";
                yearValid = true;
            }
        }, 300)
    );

durationInput &&
    durationInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = durationInput.value;
            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                durationWarn.innerHTML = "Durasi tidak bisa kosong!";
                durationWarn.className = "show";
                durationValid = false;
            } else if (!numberRegex.test(input)) {
                console.log(`Tidak Lolos ${input}`);
                durationWarn.innerHTML = "Masukkan hanya angka!";
                durationWarn.className = "show";
                durationValid = false;
            } else {
                console.log(`Lolos ${input}`);
                durationWarn.innerHTML = "";
                durationWarn.className = "hide";
                durationValid = true;
            }
        }, 300)
    );

cancelBtn &&
    cancelBtn.addEventListener("click", () => {
        modal.close();
    });

submitBtn &&
    submitBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        console.log("submit");

        const title = titleInput.value;
        const desc = descriptionInput.value;
        const year = yearInput.value;
        const duration = durationInput.value;

        if (!isDataValid(title, desc, year, duration)) {
            // e.preventDefault();
            console.log("checked");
            return;
        }

        modal.showModal();
    });

const isDataValid = (title, desc, year, duration) => {
    // Name checking
    if (!title) {
        titleWarn.innerHTML = "Please fill out name!";
        titleWarn.className = "show";
        titleValid = false;
    } else if (title.length > 255) {
        titleWarn.innerHTML = "Too long!";
        titleWarn.className = "show";
        titleValid = false;
    } else {
        titleWarn.className = "hide";
        titleValid = true;
    }

    // Description checking
    if (!desc) {
        descriptionWarn.innerHTML = "Please fill out description!";
        descriptionWarn.className = "show";
        descriptionValid = false;
    } else if (desc.length > 255) {
        descriptionWarn.innerHTML = "Too long!";
        descriptionWarn.className = "show";
        descriptionValid = false;
    } else {
        descriptionWarn.className = "hide";
        descriptionValid = true;
    }

    // year checking
    if (!year) {
        yearWarn.innerHTML = "Please fill out year!";
        yearWarn.className = "show";
        yearValid = false;
    } else {
        yearWarn.className = "hide";
        yearValid = true;
    }

    // Description checking
    if (!duration) {
        durationWarn.innerHTML = "Please fill out duration!";
        durationWarn.className = "show";
        durationValid = false;
    } else {
        durationWarn.className = "hide";
        durationValid = true;
    }

    if (!selectedActor.length) {
        actorWarn.innerHTML = "Please fill out actor!";
        actorWarn.className = "show";
        actorValid = false;
    } else {
        actorWarn.className = "hide";
        actorValid = true;
    }

    if (!selectedDirector.length) {
        directorWarn.innerHTML = "Please fill out director!";
        directorWarn.className = "show";
        directorValid = false;
    } else {
        directorWarn.className = "hide";
        directorValid = true;
    }

    if (!selectedCategory.length) {
        categoryWarn.innerHTML = "Please fill out category!";
        categoryWarn.className = "show";
        categoryValid = false;
    } else {
        categoryWarn.className = "hide";
        categoryValid = true;
    }

    // photo checking
    if (!EDIT) {
        if (posterInput.files.length == 0) {
            posterWarn.innerHTML = "Please choose photo!";
            posterWarn.className = "show";
            posterValid = false;
        } else if (!posterInput.files[0].type.match("image.*")) {
            posterWarn.innerHTML = "Insert valid image!";
            posterWarn.className = "show";
            posterValid = false;
        } else if (posterInput.files[0].size > 8000000) {
            posterWarn.innerHTML = "File too big!";
            posterWarn.className = "show";
            posterValid = false;
        } else {
            posterWarn.className = "hide";
            posterValid = true;
        }
    }

    // photo checking
    if (!EDIT) {
        if (trailerInput.files.length == 0) {
            trailerWarn.innerHTML = "Please choose video!";
            trailerWarn.className = "show";
            trailerValid = false;
        } else if (!trailerInput.files[0].type.match("video.*")) {
            trailerWarn.innerHTML = "Insert valid video!";
            trailerWarn.className = "show";
            trailerValid = false;
        } else if (trailerInput.files[0].size > 8000000) {
            trailerWarn.innerHTML = "File too big!";
            trailerWarn.className = "show";
            trailerValid = false;
        } else {
            trailerWarn.className = "hide";
            trailerValid = true;
        }
    }

    if (!titleValid || !descriptionValid || !yearValid || !durationValid || !actorValid || !directorValid || !posterValid || !trailerValid || !categoryValid) {
        return false;
    }

    return true;
};

actorsInput &&
    actorsInput.addEventListener("input", (e) => {
        const input = JSON.parse(e.target.value);
        drawTag(input, "actor");
    });

directorsInput &&
    directorsInput.addEventListener("input", (e) => {
        const input = JSON.parse(e.target.value);
        drawTag(input, "director");
    });

categorysInput &&
    categorysInput.addEventListener("input", (e) => {
        const input = JSON.parse(e.target.value);
        drawTag(input, "category");
    });

const drawTag = (input, type) => {
    let tagContainer = document.querySelector(`.selected-${type}-container`).innerHTML;

    let selectedElement = `
    <div class="option-${type}-tag option-tag" data="${input.id}">
        <div class="option-name">
            <p>${input.name}</p>
        </div>
        <a id="delete-${type}-tag" data="${input.id}" onclick="deleteTagHandler(this, '${type}')">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
            </svg>
        </a>
    </div>
    `;
    if (tagContainer.includes(`<p>${input.name}</p>`)) {
        return;
    }

    if (type === "actor" && selectedActor.includes(input.id)) {
        return;
    }
    if (type === "director" && selectedDirector.includes(input.id)) {
        return;
    }
    if (type === "category" && selectedCategory.includes(input.id)) {
        return;
    }

    if (type === "director") {
        selectedDirector.push(input.id);
    } else if (type === "actor") {
        selectedActor.push(input.id);
    } else if (type === "category") {
        selectedCategory.push(input.id);
    } else {
        return;
    }

    tagContainer += selectedElement;
    console.log(`Actor : ${selectedActor}`);
    console.log(`Director : ${selectedDirector}`);
    console.log(`Category : ${selectedCategory}`);
    document.querySelector(`.selected-${type}-container`).innerHTML = tagContainer;
};

const deleteTagHandler = (element, type) => {
    let Id = element.getAttribute("data");
    const tag = document.querySelector(`.option-${type}-tag[data="${Id}"]`);

    if (type === "director") {
        selectedDirector = selectedDirector.filter(function (id) {
            return id != Id;
        });
    } else if (type === "actor") {
        selectedActor = selectedActor.filter(function (id) {
            return id != Id;
        });
    } else if (type === "category") {
        selectedCategory = selectedCategory.filter(function (id) {
            return id != Id;
        });
    } else {
        return;
    }

    console.log(`Actor : ${selectedActor}`);
    console.log(`Director : ${selectedDirector}`);
    console.log(`Category : ${selectedCategory}`);

    tag.remove();
};

discardBtn &&
    discardBtn.addEventListener("click", (e) => {
        e.preventDefault();

        location.replace(`http://localhost:8080/movie/catalog/1`);
    });

confirmBtn &&
    confirmBtn.addEventListener("click", async (e) => {
        e.preventDefault();

        const title = titleInput.value;
        const desc = descriptionInput.value;
        const year = yearInput.value;
        const duration = durationInput.value;
        const actors = selectedActor;
        const directors = selectedDirector;
        const categorys = selectedCategory;
        const poster = posterInput.files[0];
        const trailer = trailerInput.files[0];

        const xhr = new XMLHttpRequest();

        if (EDIT) {
            xhr.open("POST", `/movie/update`);
        } else {
            xhr.open("POST", `/movie/insert`);
        }

        const formInsert = new FormData();
        formInsert.append("poster", poster);
        formInsert.append("trailer", trailer);
        formInsert.append("title", title);
        formInsert.append("description", desc);
        formInsert.append("release-year", year);
        formInsert.append("duration", duration);
        formInsert.append("description", desc);

        categorys.forEach(function (value) {
            formInsert.append("categorys[]", value);
        });

        actors.forEach(function (value) {
            formInsert.append("actors[]", value);
        });

        directors.forEach(function (value) {
            formInsert.append("directors[]", value);
        });

        if (EDIT) {
            formInsert.append("movie_id", movieID);
        }

        xhr.send(formInsert);

        xhr.onreadystatechange = async function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                console.log(this.responseText);
                data = JSON.parse(this.responseText);

                if (!data.error && this.status == 200) {
                    location.replace("http://localhost:8080/movie/catalog/1");
                }
            }
        };
    });
