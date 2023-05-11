<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../FirstApp/Styles/Index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Ajout produit</title>
    </head>
    <body>
        <nav>
            <a href="./Recap.php"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"><span>
                <?php 
                    $count = 0;
                    if (isset($_SESSION['products'])) {
                        $count = count($_SESSION['products']);
                    }
                    echo $count; 
                ?> 
            </span></i></a>
        </nav>
                
               
        <div class="wrapper">
            <div class="card">
                <h1>Ajouter produit</h1>
                <form action="./Traitement.php" method="post">
                    <p>
                        <label>
                            Nom du produit :
                            <input type="text" name="name">
                        </label>
                    </p>
                    <p>
                        <label>
                            Prix du produit :
                            <input type="number" step="any" name="price">
                        </label>
                    </p>
                    <p>
                        <label>
                            Quantité désirée :
                            <input type="number" name="qtt" value="1">
                        </label>
                    </p>
                    <p class="submit">
                        <input  type="submit" name="submit" value="Ajouter le produit">
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>