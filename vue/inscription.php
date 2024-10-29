<?php ob_start();?>
    <main>
        <form action="#" method="post" class="main_form">
            <h2>Inscription</h2>

            <?php if(isset($msg_error_inscription)){echo "<p class='$class_inscription_error'>$msg_error_inscription</p>";}?>                                         <!--$msg_error_inscription: msg d'erreur général--> 

            <label for="loginID">* Login :</label>
            <?php if(isset($msg_error_login)){echo "<p class='$class_pseudo'>$msg_error_login</p>";}?>                       <!--$msg_error_login: msg d'erreur login-->
            <input type="text" name="login" id="loginID" value="<?= $login?>" class="<?=$class_pseudo?>">

            <label for="mdpID">* Mot de passe :</label>
            <?php if(isset($msg_error_mdp)){echo "<p class='$class_mdp'>$msg_error_mdp</p>";}?>                           <!--$msg_error_mdp: msg d'erreur mdp-->
            <input type="password" name="mdp" id="mdpID" value="<?php echo $mdp?>" class="<?=$class_mdp?>">

            <label for="checkMdpID">* Confirmation Mot de passe :</label>
            <?php if(isset($msg_error_confirmation)){echo "<p class='$class_confirmation'>$msg_error_confirmation</p>";}?>         <!--$msg_error_confirmation: msg d'erreur confirmation de mdp-->
            <input type="password" name="confirmation" id="checkMdpID" value="<?php echo $confirmation?>" class="<?=$class_confirmation?>">

            <section>
                <label>* Sexe :</label><br>
                <?php if(isset($msg_error_sexe)){echo "<p class='$class_sexe'>$msg_error_sexe</p>";}?><br>                     <!--$msg_error_sexe: msg d'erreur sexe-->
                <input type="radio" name="sexe" id="hommeID" value="M" required>
                <label for="hommeID">Homme</label>

                <input type="radio" name="sexe" id="femmeID" value="F">
                <label for="femmeID">Femme</label>

                <input type="radio" name="sexe" id="sansreponseID" value="S">
                <label for="sansreponseID">Sans réponse</label>
            </section>

            <label for="ddnID">* Date de naissance</label>
            <?php if(isset($msg_error_date)){echo "<p class='$class_date'>$msg_error_date</p>";}?>         <!--$msg_error_date: msg d'erreur date-->
            <input type="date" name="ddn" id="ddnID" value="<?php echo $ddn?>" class="<?=$class_date?>">

            <input type="submit" value="S'inscrire">

            <p>Vous avez déja un compte ? <a href="index.php">Se connecter</a></p>

        </form>
    </main>
<?php
$title="Inscription : OnlineChat";
$content=ob_get_contents();
ob_end_clean();
include ("gabarit.php");
?>