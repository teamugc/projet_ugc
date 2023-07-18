document.addEventListener('DOMContentLoaded', (e) => {


    document.getElementById('btn-new-connection').addEventListener('click', (e) => {
        // annule le comportement normal du lien
        e.preventDefault();

        // lance l'url cible dans la modale
        fetch('/modals/new_connection')
        .then(function(response) {
            return response.text();
        })
        .then(function(html) {
            document.querySelector('#modal .modal-content').innerHTML = html;
            addEventOnButton();

        });

        // affiche la modal
        let modal = new bootstrap.Modal('#modal', []);
        modal.show();
    });


    function addEventOnButton(){
        document.querySelector('#modal-form button').addEventListener('click', (e) => {
                // annule le comportement normal du lien
                e.preventDefault();

                // récupère la destination du fetch
                const destination = document.getElementById('step').value;
                const formData = new FormData(document.getElementById("modal-form"))
                fetch(destination, {
                    body: formData,
                    method: "post"
                })
                .then(function(response) {
                    return response.text();
                })
                .then(function(html) {
                    document.querySelector('#modal .modal-content').innerHTML = html;
                    console.log('html rechargé');
                    addEventOnButton();
                });
        });
    }


});


