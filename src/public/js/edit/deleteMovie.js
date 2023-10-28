const confirmBtn = document.querySelector("#confirm-btn-modal");
const cancelBtn = document.querySelector("#cancel-btn-modal");
const modalDelete = document.querySelector(".modal");

cancelBtn &&
    cancelBtn.addEventListener("click", () => {
        console.log(`you close ${modalDelete.getAttribute("review_id")}`);
        modalDelete.close();
    });

confirmBtn &&
    confirmBtn.addEventListener("click", () => {
        const movieID = modalDelete.getAttribute("movie_id");

        if (!movieID) {
            return;
        }

        const xhr = new XMLHttpRequest();

        xhr.open("DELETE", `/movie/delete?movie_id=${movieID}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);

                if (!data.error && this.status == 200) {
                    location.replace("http://localhost:8080/movie/catalog/1");
                }
            }
        };
    });
