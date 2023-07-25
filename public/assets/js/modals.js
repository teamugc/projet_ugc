document.addEventListener('DOMContentLoaded', (e) => {


    /**
     * 
     */
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
    
    /**
     * 
     */
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
                    
                    addEventOnButton();
                    if (document.getElementById('modal-choose-location-cinema')) {
                        initCinemaAutocompletion();
                    }

                    if (document.getElementById('modal-choose-actor-cinema')) {
                        initActorAutocompletion();
                    }
                   
                });
        });
    }

    /**
     * Initialise l'auto completion
     * 
     * @returns 
     */
    function initCinemaAutocompletion() {

        // si la modal n'est pas la bonne quitter
        if (!document.getElementById('modal-choose-location-cinema'))
            return;

        // ajout de l'evenement keyup sur le champ de saisie
        document.getElementById('modal-choose-location-cinema').addEventListener('keyup', (e) => {

            let search = document.getElementById('modal-choose-location-cinema').value.trim().toLowerCase();
            fetch('/cinemas/' + search)
            .then(function(response) {
                return response.json();
            })
            .then(function(json) {  
                refresh(json);
            });
        });


        /**
         * Recharge la liste des suggestion de l'autocomplétion à partir du json
         * 
         * @param {*} suggestions 
         */
         function refresh (suggestions) {

            // vide la div des suggestions
            document.getElementById('suggestions').innerHTML = '';

            // pour chaque suggestions reçues en json
            suggestions.forEach( suggestion => {

                    // crée le titre
                    let titre = document.createElement('h5');
                    titre.innerHTML = suggestion['name'];
                    titre.classList.add('maClasse');

                    // crée un autre élément
                    let image = document.createElement('div');
                    image.innerHTML = `<img src="${suggestion['image']}"></img>`;

                     // crée un autre élément
                     let box = document.createElement('checkbox');
                     box.innerHTML = `<input type="checkbox" name ="locations[]" id ="locations" value="${suggestion['name']}">`

                    // crée la div générale pour cette suggestion
                    let el = document.createElement('div');
                    el.classList.add('suggestionClass');
                    

                    // ajoute les éléments dans l'ordre
                    el.appendChild(box);
                    el.appendChild(titre);
                    el.appendChild(image);
                    

                    // ajout de la div de la suggestion dans la div des suggestions
                    
                    document.getElementById('suggestions').appendChild(el);
            });

            //console.log(JSON.parse(json));
        }
    }


    /**
     * Initialisation de l'autocompletion sur le choix d'acteur
     */
    function initActorAutocompletion() { 

        // ajout de l'event "keyup" sur l'input des acteurs
        document.getElementById('modal-choose-actor-cinema').addEventListener('keyup', (e) => { 

            // interrogation de notre API maison pour récupérer la liste des acteurs
            fetch('/api/actors/' + e.target.value + '/5').then(function (response) {
                return response.text();
            })
            .then(function (json) {
                const datas = JSON.parse(json);
                console.log(datas);
                
                const destinationEl = document.querySelector('#actors-container .suggestions-container');
                destinationEl.innerHTML = "";
                console.log(destinationEl);
                datas.forEach(suggestion => {

                    let box = document.createElement('checkbox');
                    box.innerHTML = `<input type="checkbox" name ="actors[]" id ="actors" value="${suggestion}">`

        
                    let p = document.createElement('span');
                    p.innerHTML = '' + suggestion;
                    
                    let div = document.createElement('div');
                    div.appendChild(box);
                    div.appendChild(p);
        
                    destinationEl.appendChild(div);
                });
            })
        })
    }

    // const el = document.getElementById('test-auto');
    // if (el != null) {

    //     document.getElementById('test-auto').addEventListener('click', (e) => { // annule le comportement normal du lien
    //         e.preventDefault();
    //         console.log(e);
    //         // lance l'url cible dans la modale
    //         fetch('/modals/choose_actors').then(function (response) {
    //             return response.text();
    //         }).then(function (html) {
    //             document.querySelector('#modal .modal-content').innerHTML = html;
    //             // affiche la modal
    //             let modal = new bootstrap.Modal('#modal', []);
    //             modal.show();
            
    //             // *************** a copier dans modals.js
    //             if (document.getElementById('modal-choose-actor-cinema')) {
    //                 initActorAutocompletion();
    //             }
    //             // ***************
    //         });

    //     });
    // }
    // FIN DOMContentLoaded
});


