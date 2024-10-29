<?php ob_start();?>
    <main>
        <form action="#" method="post" class="main_form">
            <h2>Connexion</h2>
            
            <?php if(isset($msg_error_connexion)){echo "<p class='$class_connexion_error'>$msg_error_connexion</p>";}?>
            
            <label for="loginID">* Login :</label>
            <?php if(isset($msg_error_login)){echo "<p class='$class_pseudo'>$msg_error_login</p>";}?>
            <input type="text" name="login" id="loginID" value="<?= $login;?>" class="<?=$class_pseudo?>">
    
            <label for="mdpID">* Mot de passe :</label>
            <?php if(isset($msg_error_mdp)){echo "<p class='$class_mdp'>$msg_error_mdp</p>";}?>
            <input type="password" name="mdp" id="mdpID" class="<?=$class_mdp?>" value="<?=$mdp?>">
    
            <input type="submit" value="Se connecter">
    
            <p>Vous n'avez pas de compte ? <a href="index_inscription.php">Inscrivez-vous gratuitement</a></p>
        </form>
    </main>
<?php
$title="Connexion : OnlineChat";
$content=ob_get_contents();
ob_end_clean();
include("gabarit.php");
?>