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
                    if (document.getElementById('modal-choose-location-cinema')) {
                        console.log('test');
                        autocompletionCinema();
                    }
                });
        });
    }


    function autocompletionCinema() {
        let input = document.getElementById('modal-choose-location-cinema');    // L'objet DOM représentant la balise <input>
        let suggest = document.getElementById('suggest');    // L'objet DOM représentant la balise <ul>

        // ---- FONCTIONS

            refresh = (result) => {
                suggest.innerHTML = result; 
            }

            function searchCinema() {
                console.log(input);
                let search = input.value.trim().toLowerCase();
                window.fetch('http://localhost:8000/cinemas/' + search)
                    .then(function(response)
                    {
                        return response.json();
                    })
                    .then(function(result)
                    {
                        console.log(result);
                        refresh(result);
                    });
            
            }

        // ---- CODE PRINCIPAL

        // Recherche du champ de saisie et de la balise <ul> qui va contenir les résultats.

        // Installation d'un gestionnaire d'évènement sur la saisie au clavier dans le champ.
        input.addEventListener('keyup', searchCinema);
    }

});


