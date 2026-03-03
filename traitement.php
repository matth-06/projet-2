<?php

if(empty($_POST['titre']) || empty($_POST['description']) || empty($_POST['artiste']) || empty($_POST['image']) 
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL) || strlen($_POST['description']) < 3
) {
    header('Location: index.php');
} else {
    $titre =htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);
    // insertion
    require 'bdd.php';
    $bdd = connexion();

    $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artiste, image) VALUES (?, ?, ?, ?)');
    $requete->execute([
        $titre,
        $description,
        $artiste,
        $image
    ]);

    header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
}
