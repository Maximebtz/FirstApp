<?php

    session_start(); // Démarrer une session sur le serveur pour l'utilisateur courant ou récupérer la session existante s'il y en a une.


    if(isset($_POST['submit'])){ // Vérifier si le bouton de soumission du formulaire a été déclenché

        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS); // Nettoyer le champ 'name' en supprimant les caractères spéciaux et les balises HTML potentielles
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Valider le champ 'price' en tant que nombre à virgule et permettre l'utilisation du caractère '.' ou ',' pour la décimale
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); // Valider le champ 'qtt' en tant que nombre entier positif

        if($name && $price && $qtt){ // Vérifier si les valeurs des champs sont valides

            $product = [ // Créer un tableau associatif pour représenter le produit
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price * $qtt,
            ];

            $_SESSION['products'][] = $product; // Ajouter le produit au tableau 'products' dans la session

            $_SESSION['error_message'] = "<span class='success'> +1 </span>"; // Définir un message de succès

        } else { // Si une ou plusieurs valeurs du formulaire sont invalides

            $_SESSION['error_message'] = "<span class='error'> Nop !!</span>"; // Définir un message d'erreur

        }
    }


    
    header("Location: Index.php"); // Rediriger vers la page 'Index.php'
    
    if(isset($_POST['deleteAll'])){ // Vérifier si le bouton 'deleteAll' a été déclenché
        $_SESSION['products'] = array(); // Supprimer la session de l'utilisateur
        header("Location: Recap.php"); // Rediriger vers la page 'Recap.php'
    }
    
    foreach($_SESSION['products'] as $index => $product){ // Parcourir les produits dans le tableau 'products' de la session
        if(isset($_POST[$index])){ // Vérifier si un bouton spécifique à un produit a été déclenché
            unset($_SESSION['products'][$index]); // Supprimer le produit du tableau 'products' dans la session
            header("Location: Recap.php"); // Rediriger vers la page 'Recap.php'
        }
    }


    foreach ($_SESSION['products'] as $index => $product) {
        if (isset($_POST[$index . 'addQtt'])) { // Bouton pour incrémenter la quantité
            $_SESSION['products'][$index]['qtt'] += 1; // Incrémenter la quantité du produit
            $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt']; // Mettre à jour le prix total en fonction de la quantité
            header("Location: Recap.php"); // Rediriger vers la page Recap.php
        } elseif (isset($_POST[$index . 'subQtt'])) { // Bouton pour décrémenter la quantité
            if ($_SESSION['products'][$index]['qtt'] > 1) { // Vérifier si la quantité est supérieure à 1 avant de décrémenter
                $_SESSION['products'][$index]['qtt'] -= 1; // Décrémenter la quantité du produit
                $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt']; // Mettre à jour le prix total en fonction de la quantité
            }
            header("Location: Recap.php"); // Rediriger vers la page Recap.php
        }
    }
?>