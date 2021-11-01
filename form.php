<?php

if($_SERVER['REQUEST_METHOD'] === "POST") {

    $uploadDir = 'upload/pictures';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $extensions_ok = ['jpg', 'jpeg', 'png','webp' ];
    $maxFileSize = 1000000;

    if ((!in_array($extension, $extensions_ok))) {
        echo $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    } elseif (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        echo $errors[] = "Votre fichier doit faire moins de 2M !";
    }else {
        $uploadFile = uniqid('', true) . '.' . $extension;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
        echo 'L\'image a bien été envoyée';
        echo '<img src="' . $uploadFile . '">';
        echo $_POST['firstname']. PHP_EOL;
        echo $_POST['lastname']. PHP_EOL;
        echo $_POST['age']. 'ans';
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="firstname" id="firstname" placeholder="Renseigne ton prénom"><br>
    <input type="text" name="lastname" id="lastname" placeholder="Renseigne ton nom"><br>
    <label for="age">Renseigne ton âge(minimum 18 ans)</label><br>
    <input type="number" name="age" id="age" min="18">ans<br>
    <?php ?>
    <label for="imageUpload">Télécharge une photo de profil</label><br>
    <input type="file" name="avatar" id="imageUpload" /><br>
    <button name="send">Envoyer</button>
</form>
