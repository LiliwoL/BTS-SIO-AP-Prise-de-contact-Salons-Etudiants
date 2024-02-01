/*  let titre = document.getElementById("titre");

    let element = document.getElementById("submit");
    console.log("activer ?" + element.disabled);

    //function vérification de connection
    function verifConnection() {
        // En ligne
            if (navigator.onLine ) {
                element.disabled = false ;
                titre.innerHTML += " connecté";


        // alert("Vous êtes en ligne !");
        // Puis autoriser l'enregistrement sur le serveur
        // scrypt ?
        }
        // Hors ligne
        else {
        // alert("Vous êtes hors ligne !");
            element.disabled = true ;
            titre.innerHTML += " non connecté";

        // Puis autoriser l'enregistrement en local
        // scrypt ?
        }
    }
    setInterval(verifConnection, 5000); */




// Fonction vérification de connection
function verifConnection() {
    hasNetwork(navigator.onLine);
}

setInterval(verifConnection, 1000);

function hasNetwork(online) {

    // Update the DOM to reflect the current status
    if (online) {
        document.body.classList.remove("offline");
        document.body.classList.add("online");

        document.title = "🚀🚀 Salon Passerelle -- Online 🚀🚀";
    } else {
        document.body.classList.remove("online");
        document.body.classList.add("offline");

        document.title = "😱😱 Salon Passerelle -- Offline 😱😱";
    }
}