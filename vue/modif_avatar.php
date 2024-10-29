<?php
ob_start();
?>
<main>
    <article class="chat">
        <a href="index_parametre.php">Retour</a>
        <form action="#" method="POST" enctype="multipart/form-data" class="page_profil">
            <label >Veuillez télécharger votre nouvel avatar :<br></label>
            <?php 
            if(isset($erreur_fichier))
            {
                echo "<p class='$class_fichier'>$erreur_fichier</p>";
            }
            ?>
            <input type="file" name="telechargement" id="telechargementID">
            <input type="submit" value="Enregistrer" name="upload">                      <!-- Si pas de "name" il ne l'upload pas-->
        </form>
    </article>
</main>
<?php
$title="Modification de l'avatar - OnlineChat";
$content=ob_get_contents();
ob_end_clean();
include("gabarit.php");
?>