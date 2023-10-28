const discardBtn = document.querySelector(".cancel-btn");
const submitBtn = document.querySelector(".submit-btn");

const rateInput = document.querySelector("#rate-input");
const commentInput = document.querySelector("#comment-input");
const blurInput = document.querySelector("#blur-input");

const rateWarn = document.querySelector("#rate-warn");

const confirmBtn = document.querySelector("#confirm-btn-modal");
const cancelBtn = document.querySelector("#cancel-btn-modal");
const modalUpload = document.querySelector(".modal");

let rateValid = true;

rateInput &&
    rateInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = rateInput.value;
            rateValid = isRateValid(input);
        })
    );

discardBtn &&
    discardBtn.addEventListener("click", () => {
        location.replace(`http://localhost:8080/review/index/1`);
    });

cancelBtn &&
    cancelBtn.addEventListener("click", () => {
        modalUpload.close();
    });

submitBtn &&
    submitBtn.addEventListener("click", () => {
        modalUpload.showModal();
    });

confirmBtn &&
    confirmBtn.addEventListener("click", () => {
        const rate = rateInput.value;

        if (!reviewID) {
            return;
        }

        if (!isRateValid(rate)) {
            return;
        }

        console.log("MAsUK");
        const comment = commentInput.value;
        const blur = blurInput.checked ? 1 : 0;

        const xhr = new XMLHttpRequest();

        xhr.open("POST", `/review/update`);

        const formUpdate = new FormData();
        formUpdate.append("rate", rate);
        formUpdate.append("comment", comment);
        formUpdate.append("blur", blur);
        formUpdate.append("review_id", reviewID);

        xhr.send(formUpdate);

        xhr.onreadystatechange = async function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);

                if (!data.error && this.status == 200) {
                    location.replace("http://localhost:8080/review/index/1");
                }
            }
        };
    });

const isRateValid = (rate) => {
    if (rate < 1 || rate > 10) {
        rateWarn.className = "show";
        return false;
    } else {
        rateWarn.className = "hide";
        return true;
    }
};
