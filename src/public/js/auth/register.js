const registerForm = document.querySelector(".register");
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");
const emailInput = document.querySelector("#email");

const usernameWarn = document.querySelector("#username-warn");
const passwordWarn = document.querySelector("#password-warn");
const emailWarn = document.querySelector("#email-warn");
const registerWarn = document.querySelector("#register-warn");

// NOTE : VALIDASI BELUM

const regex = /^\w+$/;
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

let usernameValid = false;
let passwordValid = false;
let emailValid = false;

emailInput &&
    emailInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = emailInput.value;
            if (!emailRegex.test(input)) {
                // console.log(`Tidak Lolos ${input}`);
                emailWarn.innerHTML = "Masukkan email yang benar!";
                emailWarn.className = "show";
                emailValid = false;
            } else {
                // console.log(`Lolos ${input}`);
                emailWarn.innerHTML = "";
                emailWarn.className = "hide";
                emailValid = true;
            }
        })
    );

usernameInput &&
    usernameInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = usernameInput.value;
            if (!regex.test(input)) {
                // console.log(`Tidak Lolos ${input}`);
                usernameWarn.innerHTML = "Format Username Salah!";
                usernameWarn.className = "show";
                usernameValid = false;
            } else {
                // console.log(`Lolos ${input}`);
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

registerForm &&
    registerForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const email = emailInput.value;
        const username = usernameInput.value;
        const password = passwordInput.value;

        if (!isRegisterValid(email, username, password)) {
            return;
        }

        const xhr = new XMLHttpRequest();

        xhr.open("POST", `/user/register`);

        const formLogin = new FormData();
        formLogin.append("email", emailInput.value);
        formLogin.append("username", usernameInput.value);
        formLogin.append("password", passwordInput.value);

        xhr.send(formLogin);

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 201) {
                    registerWarn.className = "hide";
                    data = JSON.parse(this.responseText);
                    location.replace(data.redirect);
                } else {
                    registerWarn.className = "show";
                }
            }
        };
    });

const isRegisterValid = (email, username, password) => {
    if (!email) {
        emailWarn.innerHTML = "Please fill out your username first!";
        emailWarn.className = "show";
        emailValid = false;
    } else if (!regex.test(username)) {
        emailWarn.innerHTML = "Invalid username format!";
        emailWarn.className = "show";
        emailValid = false;
    } else {
        emailWarn.innerHTML = "";
        emailWarn.className = "hide";
        emailValid = true;
    }

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

    if (!emailValid || !usernameValid || !passwordValid) {
        return false;
    }

    return true;
};
