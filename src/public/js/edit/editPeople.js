document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('myModal');
    const closeButton = document.querySelector('.close');

    document.getElementById('updateContentButton').addEventListener('click', function() {
        modal.style.display = 'block';

        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title');

        const xhr = new XMLHttpRequest();

        let url = '';

        if (title === 'Actor') {
            url = 'http://localhost:8080/about/editActor?id=' + id;
        } else if (title === 'Director') {
            url = 'http://localhost:8080/about/editDirector?id=' + id;
        }

        const data = { id: id, title: title };

        xhr.open('POST', url, true);

        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const data = JSON.parse(xhr.responseText);
                if (title === 'Actor') {
                    document.getElementById('idInput').value = data.actor_id; 
                } else if (title === 'Director') { 
                    document.getElementById('idInput').value = data.director_id; 
                }

                document.getElementById('nameInput').value = data.name;
                document.getElementById('birthDateInput').value = data.birth_date;
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
