<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
     $NomUtilisateur = "";
    $PrenomUtilisateur = "";
    $message_error = "";
    $message_success = "";
    $message_folder = "";
    $message_folder2 = "";
    $message_foldererror = "";

    //Recupération des données du formulaire
   
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $NomUtilisateur = trim($_POST['nom'] ?? '');
        $PrenomUtilisateur = trim($_POST['prenom'] ?? '');
    }
    
    //Vérification si les champs sont vides

    if (empty($NomUtilisateur) && empty($PrenomUtilisateur)) {  
        $message_error = "Veuillez remplir le formulaire";
    }else if (empty($NomUtilisateur)) {
        $message_error = "Le champ nom est vide";
    }else if (empty($PrenomUtilisateur)) {
        $message_error = "Le champ prénom est vide";
    }else {
        $message_success = "Formulaire soumis avec succès";
    }
    //Enregistrement des données dans un fichier texte si les champs sont remplis
    if (!empty($NomUtilisateur) && !empty($PrenomUtilisateur)) {
        $fichier = fopen("utilisateurs.txt", "a+");
        fwrite($fichier, "1-Nom: $NomUtilisateur;\t Prénom: $PrenomUtilisateur");
        fclose($fichier);
        $message_folder="Merci $PrenomUtilisateur $NomUtilisateur pour votre soumission";
        $message_folder2= file_get_contents("utilisateurs.txt");
    }else {
        $message_foldererror="Les données n'ont pas été enregistrées car le formulaire est incomplet.";
    }

    ?>
    <div class="container">
        <h1>MY SITE</h1>
           <?php
        if  ($message_error) : ?>
        <p class="error"><?= $message_error ?></p>
        <?php endif ?>

         <?php
        if  ($message_success) : ?>
        <p class="success"><?= $message_success ?></p>
        <?php endif ?>
            <?php
        if  ($message_folder) : ?>
        <p class="folder"><?= $message_folder ?></p>
        <?php endif ?>
            <?php
        if  ($message_folder2) : ?>
        <p class="folder2"><?= nl2br($message_folder2) ?></p>
        <?php endif ?>
            <?php
        if  ($message_foldererror) : ?>
        <p class="foldererror"><?= $message_foldererror ?></p>
        <?php endif ?>
        <!-- Formulaire-->
         <form action="" method="post">
            <label for="nom">Nom de L'utilisateur :</label>
            <input type="text" name="nom" placeholder="votre nom">
            <label for="prenom">Prénom de L'utilisateur :</label>
            <input type="text" name="prenom" placeholder="votre prénom">
            <input type="submit" value="Envoyer">
         </form>
    </div>
    
</body>
</html>