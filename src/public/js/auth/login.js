const loginForm = document.querySelector(".login");
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");

const usernameWarn = document.querySelector("#username-warn");
const passwordWarn = document.querySelector("#password-warn");
const loginWarn = document.querySelector("#login-warn");

// NOTE : VALIDASI BELUM

const regex = /^\w+$/;

let usernameValid = false;
let passwordValid = false;

usernameInput &&
    usernameInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = usernameInput.value;
            if (!regex.test(input)) {
                console.log(`Tidak Lolos ${input}`);
                usernameWarn.innerHTML = "Format Username Salah!";
                usernameWarn.className = "show";
                usernameValid = false;
            } else {
                console.log(`Lolos ${input}`);
                usernameWarn.innerHTML = "";
                usernameWarn.className = "hide";
                usernameValid = true;
            }
        })
    );

passwordInput &&
    passwordInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = passwordInput.value;

            if (!regex.test(input)) {
                // console.log(`Tidak Lolos ${input}`);
                passwordWarn.innerHTML = "Format Password Salah!";
                passwordWarn.className = "show";
                passwordValid = false;
            } else {
                // console.log(`Lolos ${input}`);
                passwordWarn.innerHTML = "";
                passwordWarn.className = "hide";
                passwordValid = true;
            }
        })
    );

loginForm &&
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const username = usernameInput.value;
        const password = passwordInput.value;

        if (!isValid(username, password)) {
            return;
        }

        const xhr = new XMLHttpRequest();

        xhr.open("POST", `/user/login`);

        const formLogin = new FormData();
        formLogin.append("username", username);
        formLogin.append("password", password);

        xhr.send(formLogin);

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 201) {
                    loginWarn.className = "hide";
                    data = JSON.parse(this.responseText);
                    location.replace(data.redirect);
                } else {
                    loginWarn.className = "show";
                }
            }
        };
    });

const isValid = (username, password) => {
    if (!username) {
        usernameWarn.innerHTML = "Please fill out your username first!";
        usernameWarn.className = "show";
        usernameValid = false;
    } else if (!regex.test(username)) {
        usernameWarn.innerHTML = "Invalid username format!";
        usernameWarn.className = "show";
        usernameValid = false;
    } else {
        usernameWarn.innerHTML = "";
        usernameWarn.className = "hide";
        usernameValid = true;
    }

    if (!password) {
        passwordWarn.innerHTML = "Please fill out your password first!";
        passwordWarn.className = "show";
        passwordValid = false;
    } else if (!regex.test(password)) {
        passwordWarn.innerHTML = "Invalid password format!";
        passwordWarn.className = "show";
        passwordValid = false;
    } else {
        passwordWarn.innerHTML = "";
        passwordWarn.className = "hide";
        passwordValid = true;
    }

    if (!usernameValid || !passwordValid) {
        return false;
    }

    return true;
};
