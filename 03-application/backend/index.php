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
    //$db = new PDO('mysql:dbname=AP;host=127.0.0.1', 'slam1', 'SlaM1');
    $db = new PDO('sqlite:database.sqlite');


    # Création de la requete SQL
    #$reqSQL = "INSERT INTO Eleve (Nom , Prenom , Formation, Mail , Tel , Remarques , Date) VALUES (". implode(", ", $valeur). ")";


    # Utilisation d'une requête préparée pour éviter les injections SQL
    # ----------------------------------------------------------------
    $reqSQL ='INSERT INTO Contact (nom, prenom, idFormation, idVoie, mail, telephone, remarque, date) VALUES (:nom, :prenom, :formation, :voie, :mail, :tel, :remarque, :date)';
    # Il est préférable d'éviter les double quotes en SQL

    # Préparation de la requête
    $sqlStatement = $db->prepare($reqSQL);

    $date = date("Y-m-d");

    # Affectation des paramètres
    $sqlStatement->bindParam(':nom',            $_POST['nom']);
    $sqlStatement->bindParam(':prenom',         $_POST['prenom']);
    $sqlStatement->bindParam(':formation',      $_POST['formation']);
    $sqlStatement->bindParam(':voie',           $_POST['choix']);
    $sqlStatement->bindParam(':mail',           $_POST['email']);
    $sqlStatement->bindParam(':tel',            $_POST['number']);
    $sqlStatement->bindParam(':remarque',       $_POST['remarque']);
    $sqlStatement->bindParam(':date',           $date);

    # Execution de la requête préparée
    $result = $sqlStatement->execute();

    # Debug de la requête (à commenter)
    //$sqlStatement->debugDumpParams();

    # Affichage du Résultat
    if ($result == true)
    {
        echo "Contact ajouté dans la base";
    }else{
        echo "Erreur";
    }

    #envoie la requète en base de donnée
    $db->query($reqSQL);
    $db->exec($reqSQL);
}

?>