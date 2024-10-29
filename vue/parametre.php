<?php
ob_start();
?>

<main>
    <article class="chat">
        <a href="index_chat.php">Retour</a>
        <section class="page_profil">
            <img src="vue/public/avatar/<?php echo $_SESSION["avatar"];?>" alt="Mon avatar">
            <h4><?=$_SESSION["pseudo"];?></h4>    
            <h4>Sexe:</h4>
            <p><?=$_SESSION["genre"]?></p>
            <h4>Date de Naissance :</h4>
            <p><?=date("d/m/Y",strtotime($_SESSION["ddn"]))?></p>
        </section>
        <section class="menu_profil">
            <a href="index_modif_avatar.php">Changer ma photo de profil</a>
            <!-- <a href="">Changer mon mot de passe</a> -->
            <!-- <a href="">Supprimer mon compte</a> -->
        </section>
</main>

<?php
$title="Paramètre : OnlineChat";
$content=ob_get_contents();
ob_end_clean();
include("gabarit.php");
?>