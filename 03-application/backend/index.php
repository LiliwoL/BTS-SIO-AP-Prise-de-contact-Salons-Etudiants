<?php

// On vérifie si l'enveloppe $_POST existe et là on exécutera tout le code
if ( isset($_POST['submit']) )
{    
    // 1 . Définition des variables

    // 2. Connexion base de données
        // PDO = PHP Database Object
        // Le consructeur prend 3 paramètres
        // 1. Le type de base, son nom et son hôte = DSN
        // 2. L'utilisateur
        // 3 . Le mot de passe
    $db = new PDO('mysql:dbname=AP;host=127.0.0.1', 'slam1', 'SlaM1');


    # Création de la requete SQL
    #$reqSQL = "INSERT INTO Eleve (Nom , Prenom , Formation, Mail , Tel , Remarques , Date) VALUES (". implode(", ", $valeur). ")";


    # Utilisation d'une requête préparée pour éviter les injections SQL
    # ----------------------------------------------------------------
    $reqSQL ='INSERT INTO Eleve (Nom, Prenom, Formation, Mail, Tel, Remarque, _Date) VALUES (:nom, :prenom, :formation, :mail, :tel, :remarque, :date)'; # Il est préférable d'éviter les double quotes en SQL

    # Préparation de la requête
    $sqlStatement = $db->prepare($reqSQL);

    # Affectation des paramètres
    $sqlStatement->bindParam(':nom',            $_POST['nom']);
    $sqlStatement->bindParam(':prenom',         $_POST['prenom']);
    $sqlStatement->bindParam(':formation',      $_POST['formation']);
    $sqlStatement->bindParam(':mail',           $_POST['email']);
    $sqlStatement->bindParam(':tel',            $_POST['number']);
    $sqlStatement->bindParam(':remarque',       $_POST['remarque']);
    $sqlStatement->bindParam(':date', date("Y-m-d"));

    # Execution de la requête préparée
    $result = $sqlStatement->execute();

    # Debug de la requête (à commenter)
    //$sqlStatement->debugDumpParams();

    # Affichage du Résultat
    if ($result == true)
    {
        echo "Eleve ajouté dans la base";
    }else{
        echo "Erreur";
    }

    #envoie la requète en base de donnée
    #$db->query($reqSQL);
    #$db->exec($reqSQL);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Salon Passerelle</title>

    <style type="text/css">
        .online{
            background-color: green;
        }

        .offline{
            background-color: red;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Le formulaire va exécuter l'action action.php (script sur le serveur) en utilisant la méthode POST -->
        <form method="POST">
            <h1 id="titre">Salon Passerelle</h1>
            <p>Informations du / de la candidat.e</p>
            <label for="nom"class="form-label">1.Nom du candidat</label>
            <input id="nom" class="form-control" type="text" name="nom" placeholder="Entrez votre réponse">

            <label for="prenom"class="form-label">2.Prénom du candidat</label>
            <input id="prenom" class="form-control" type="text" name="prenom"placeholder="Entrez votre réponse">
            

            <label for="choix"class="form-check-label">3.Voix souhaitée</label>
            <input id="choix" class="form-check-input" type="radio" name="choix" value="0">Apprentissage
            <input id="choix" class="form-check-input" type="radio" name="choix" value="1">Initiale
            <input id="choix" class="form-check-input" type="radio" name="choix" value="2">Ne sais pas encore
            <br>

            <label for="formation"class="form-label">4.Formation + niveau souhaité</label>
            <input id="formation" class="form-control" type="text" name="formation" placeholder="Entrez votre réponse">

            <label for="email"class="form-label">5.Mail du cancidat</label>
            <input id="email" class="form-control" type="email" name="email" placeholder="Entrez votre réponse">

            <label for="number"class="form-label">6.Téléphone du candidat</label>
            <input id="number" class="form-control" type="phone" name="number" placeholder="Entrez votre réponse">
            
            <label for="remarque"class="form-label">7.Remarques / Observations</label>
            <textarea id="remarque" class="form-control" name="remarque" rows="7" cols="21"placeholder="Entrez votre réponse"></textarea> 

            <input id="submit" type="submit" class="btn btn-primary" name="submit">
        </div>
    </form>

    <script type="text/javascript">
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


        

        //function vérification de connection
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

    </script>

</body>
</html>
