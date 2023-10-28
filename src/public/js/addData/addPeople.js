const addForm = document.querySelector(".addPeople");

const nameInput = document.querySelector("#name");
const descriptionInput = document.querySelector("#description");
const birthdateInput = document.querySelector("#birthdate");
const photoInput = document.querySelector("#photo");

const nameWarn = document.querySelector("#name-warn");
const descriptionWarn = document.querySelector("#description-warn");
const birthdateWarn = document.querySelector("#birthdate-warn");
const photoWarn = document.querySelector("#photo-warn");

const nameRegex = /^[a-zA-Z\s]*$/;
const dateRegex = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;

let nameValid = EDIT ? true : false;
let descriptionValid = EDIT ? true : false;
let birthdateValid = EDIT ? true : false;
let photoValid = EDIT ? true : false;

nameInput &&
    nameInput.addEventListener(
        "input",
        debounce(() => {
            const input = nameInput.value;

            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                nameWarn.innerHTML = "Nama tidak bisa kosong!";
                nameWarn.className = "show";
                nameValid = false;
            } else if (input.length > 255) {
                nameWarn.innerHTML = "Too long!";
                nameWarn.className = "show";
                nameValid = false;
            } else if (!nameRegex.test(input)) {
                console.log(`Tidak Lolos ${input}`);
                nameWarn.innerHTML = "Nama hanya bisa berupa huruf!";
                nameWarn.className = "show";
                nameValid = false;
            } else {
                console.log(`Lolos ${input}`);
                nameWarn.innerHTML = "";
                nameWarn.className = "hide";
                nameValid = true;
            }
        }, 300)
    );

descriptionInput &&
    descriptionInput.addEventListener(
        "input",
        debounce(() => {
            const input = descriptionInput.value;

            // const name = nameInput.value;
            // const desc = descriptionInput.value;
            // const birth_date = birthdateInput.value;
            // console.log(name, desc, birth_date, photoInput.files.length);

            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                descriptionWarn.innerHTML = "Description tidak bisa kosong!";
                descriptionWarn.className = "show";
                descriptionValid = false;
            } else if (input.length > 255) {
                descriptionWarn.innerHTML = "Too long!";
                descriptionWarn.className = "show";
                descriptionValid = false;
            } else {
                console.log(`Lolos ${input}`);
                descriptionWarn.innerHTML = "";
                descriptionWarn.className = "hide";
                descriptionValid = true;
            }
            // console.log(input);
        }, 300)
    );

birthdateInput &&
    birthdateInput.addEventListener(
        "input",
        debounce(() => {
            const input = birthdateInput.value;

            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                birthdateWarn.innerHTML = "Description tidak bisa kosong!";
                birthdateWarn.className = "show";
                birthdateValid = false;
            } else {
                console.log(`Lolos ${input}`);
                birthdateWarn.innerHTML = "";
                birthdateWarn.className = "hide";
                birthdateValid = true;
            }
        }, 300)
    );

addForm &&
    addForm.addEventListener("submit", async (e) => {
        // e.preventDefault();
        const name = nameInput.value;
        const desc = descriptionInput.value;
        const birth_date = birthdateInput.value;

        // console.log(name, desc, birth_date, photoInput.files.length);
        // console.log(photoInput.files.length);
        // e.preventDefault();

        const checkData = isDataValid(name, desc, birth_date);

        if (photoInput.files.length == 0 || !checkData) {
            e.preventDefault();
            return;
        }
    });

const isDataValid = (name, desc, birth_date) => {
    // Name checking
    // console.log(name, desc);
    if (!name) {
        nameWarn.innerHTML = "Please fill out name!";
        nameWarn.className = "show";
        nameValid = false;
    } else if (!nameRegex.test(name)) {
        nameWarn.innerHTML = "Name cannot contain any symbol or number!";
        nameWarn.className = "show";
        nameValid = false;
    } else if (name.length > 255) {
        nameWarn.innerHTML = "Too long!";
        nameWarn.className = "show";
        nameValid = false;
    } else {
        nameWarn.className = "hide";
        nameValid = true;
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

    // Birthday checking
    if (!birth_date) {
        birthdateWarn.innerHTML = "Please fill out description!";
        birthdateWarn.className = "show";
        birthdateValid = false;
    } else if (!dateRegex.test(birth_date)) {
        birthdateWarn.innerHTML = "Please include a valid date!";
        birthdateWarn.className = "show";
        birthdateValid = false;
    } else {
        birthdateWarn.className = "hide";
        birthdateValid = true;
    }

    // photo checking
    if (!EDIT) {
        if (photoInput.files.length == 0) {
            photoWarn.innerHTML = "Please choose photo!";
            photoWarn.className = "show";
            photoValid = false;
        } else if (!photoInput.files[0].type.match("image.*")) {
            photoWarn.innerHTML = "Insert valid image!";
            photoWarn.className = "show";
            photoValid = false;
        } else {
            photoWarn.className = "hide";
            photoValid = true;
        }
    }

    // console.log(nameValid, descriptionValid);
    if (!nameValid || !descriptionValid || !birthdateValid || !photoValid) {
        return false;
    }

    return true;
};
