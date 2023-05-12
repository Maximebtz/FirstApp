<?php
    session_start(); // Démarrer une session sur le serveur pour l'utilisateur courant, ou récupérer la session de ce même utilisateur s'il en avait déjà une.
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./Styles/Recap.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Récapitulatif des produits</title>
    </head>
    <body>
        <nav>
            <a href="./Index.php"><i class="fa-solid fa-house" style="color: rgb(130, 148, 196);""></i></a>
        </nav>
        <div class="wrapper"> 
            <div class="card">   
                <?php
                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){ // Soit la clé "products" du tableau de session $_SESSION n'existe pas : !isset(),Soit cette clé existe mais ne contient aucune donnée : empty().
                    echo "<h3>Aucun produit...</h3>
                    <img src='./Img/Empty-amico.svg'>";
                }else{
                    echo " <h3>Produits ajoutés :</h3>
                    
                    <table>",
                            "<thead>", // <thead>, afin de bien décomposer les données de chaque produit.
                                "<tr>",
                                    "<th>#</th>",
                                    "<th>Nom</th>",
                                    "<th>Prix</th>",
                                    "<th>Quantité</th>",
                                    "<th>Total</th>",
                                "</tr>",
                            "</thead>",
                            "<tbody>";
                    $totalGeneral = 0; // Dans un premier temps, avant la boucle, on initialise une nouvelle variable $totalGeneral à zéro
                    foreach($_SESSION['products'] as $index => $product){ //$index : aura pour valeur l'index du tableau $_SESSION['products'] parcouru. $product : cette variable contiendra le produit, sous forme de tableau, tel que l'a créé et stocké en session le fichier traitement.php. 
                    echo "<table>",
                    "<thead>", // <thead>, afin de bien décomposer les données de chaque produit.
                        "<tr>",
                            "<td><form action='./Traitement.php' method='post'><input class='sub-element' type='submit' name='$index' value='X'></form>" . $index . "</td>",
                            "<td>" . $product['name'] . "</td>",
                            "<td>" . number_format($product['price'], 2, ",", "&nbsp;")  . "&nbsp;€</td>", //number_format(variable à modifier, nombre de décimales souhaité, caractère séparateur décimal, caractère séparateur de milliers5);              
                            "<td>
                        <form action='./Traitement.php' method='post'>
                            <input class='add-qtt' type='submit' name='" . $index . "addQtt' value='+'>
                            " . $product['qtt'] . "
                            <input class='sub-qtt' type='submit' name='" . $index . "subQtt' value='-'>
                        </form>
                    </td>",
                            "<td>" . number_format($product['total'], 2, ",", "&nbsp;")  . "&nbsp;€</td>", // Le caractère HTML &nbsp; est un espace insécable.
                        "</tr>";
                        $totalGeneral += $product['total']; // À l'intérieur de la boucle, grâce à l'opérateur combiné +=, on ajoute le total du produit parcouru à la valeur de $totalGeneral, qui augmente d'autant pour chaque produit.
                    }

                    echo"<tr>",
                            "<td colspan=4>Total général : </td>", // Nous affichons une dernière ligne avant de refermer notre tableau. Cette ligne contient deux cellules : une cellule fusionnée de 4 cellules (colspan=4) pour l'intitulé,
                            "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>", //et une cellule affichant le contenu formaté de $totalGeneral avec number_format().
                        "</tr>",
                    "</tbody>",
                    "</table>";
                }

                if(isset($_SESSION['products']) == 0){
                    echo "";
                }else{
                    echo "<form class='delete-all' action='./Traitement.php' method='post'>
                            <input type='submit' name='deleteAll' value='Supprimer tout les articles'>
                        </form>";
                }

                
                ?>
            </div>
        </div>
        <script src="./JS/Script.js"></script>
    </body>
</html>