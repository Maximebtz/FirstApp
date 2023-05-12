<?php

session_start(); //Démarrer une session sur le serveur pour l'utilisateur courant, ou récupérer la session de ce même utilisateur s'il en avait déjà une.

    if(isset($_POST['submit'])){ // Vérification de l'existence 'submit'    

        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS); // FILTER_SANITIZE_STRING supp une chaine de caractère de toute présence de caractères spéciaux et de toute balise HTML potentielle ou les encode. Pas d'injection de code HTML possible !
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // FILTER_VALIDATE_FLOAT (champ 'price') : validera le prix que s'il est un nombre à virgule (pas de texte ou autre…), le drapeau FILTER_FLAG_ALLOW_FRACTION est ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); // FILTER_VALIDATE_INT (champ "qtt") : ne validera la quantité que si celle-ci est un nombre entier, au moins égal à 1.
        
        if($name && $price && $qtt){ // À la suite de cela, nous disposons de trois variables $name, $price et $qtt censées contenir respectivement les valeurs nettoyées et/ou validées du formulaire.

            $product = [ // Construire pour chaque produit un tableau associatif $product
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt,
            ];

            $_SESSION['products'][] = $product; /* On sollicite le tableau de session $_SESSION fourni par PHP. 
                                                Les deux crochets "[]"2 sont un raccourci pour indiquer à cet emplacement que nous 
                                                ajoutons une nouvelle entrée au futur tableau "products" associé à cette clé. 
                                                $_SESSION["products"] doit être lui aussi un tableau afin d'y stocker de nouveaux 
                                                produits par la suite.*/ 

            $_SESSION['error_message'] = "<span class='success'> +1 </span>";

        } else { // Une ou plusieurs valeurs du formulaire sont invalides, donc on affiche un message d'erreur
            
            $_SESSION['error_message'] = "<span class='error'> Nop !!</span>";
        
        }
    }
    
    if(isset($_POST['deleteAll'])){
        session_destroy(); //Suppression de la session
    }

    
    
    
    header("Location:Index.php"); // Redirection grâce à la fonction header()
    
    foreach($_SESSION['products'] as $index => $products){
        if(isset($_POST['subElement'])){
                unset($_SESSION['products'][$index]);
        }
    }

?>