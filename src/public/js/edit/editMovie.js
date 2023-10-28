document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('myModal');
    const closeButton = document.querySelector('.close');

    document.getElementById('updateContentButton').addEventListener('click', function() {
        modal.style.display = 'block';

        const id = this.getAttribute('data-id');

        const xhr = new XMLHttpRequest();

        const url = 'http://localhost:8080/about/editMovie?id=' + id;

        const data = { id: id };

        xhr.open('POST', url, true);

        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const data = JSON.parse(xhr.responseText);
                document.getElementById('idInput').value = data.movie_id;
                document.getElementById('titleInput').value = data.title;
                document.getElementById('yearInput').value = data.year;
                document.getElementById('durationInput').value = data.duration;
                document.getElementById('descriptionInput').value = data.description;
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        };
        console.log(xhr.responseText);
  
        xhr.onerror = function () {
            console.error('Network error occurred');
        };

        xhr.send(JSON.stringify(data));
    });

    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

});
