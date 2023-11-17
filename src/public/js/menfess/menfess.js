const messageInput = document.querySelector("#message-input");
const senderInput = document.querySelector("#name-input");
const submitBtn = document.querySelector(".submit-btn");

submitBtn &&
    submitBtn.addEventListener("click", () => {
        if (!studioID) {
            return;
        }

        const message = messageInput.value;
        const sender = senderInput.value;

        const xhr = new XMLHttpRequest();

        xhr.open("POST", `/menfess/send/${studioID}`);

        const formUpdate = new FormData();
        formUpdate.append("sender", sender);
        formUpdate.append("body", message);

        xhr.send(formUpdate);

        xhr.onreadystatechange = async function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);

                if (!data.error && this.status == 200) {
                    location.replace(`http://localhost:8001/studio/${studioID}`);
                }
            }
        };
    });
