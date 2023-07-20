let input = document.getElementById('modal-choose-location-cinema');          // L'objet DOM représentant la balise <input>
let suggest = document.getElementById('suggest');        // L'objet DOM représentant la balise <ul>



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
                
                refresh(result);
            });
       
    }


// ---- CODE PRINCIPAL



// Recherche du champ de saisie et de la balise <ul> qui va contenir les résultats.

// Installation d'un gestionnaire d'évènement sur la saisie au clavier dans le champ.
input.addEventListener('keyup', searchCinema);