<?php ob_start(); ?>
<main>
    <div class="chat">
        <div class="header_chat">
            <div class="profil_chat">
                <img src="vue/public/avatar/<?php echo $_SESSION["avatar"]; ?>" alt="avatar de l'utilisateur">
                <span><?php echo $_SESSION["pseudo"]; ?></span>
                <a href="index_parametre.php" class="button_deconnexion" style="background:unset;font-size:30px" title="Modifier mon profil"><i class="fas fa-magic" style="color: #000000;"></i></a>
            </div>
            <a href="index_deconnexion.php" class="button_deconnexion">Déconnexion</a>
        </div>

        <div class="pagination" style="text-align:center;">
            <?php
            if($page_courante>1)
            {
                echo "<a href='?page=".($page_courante-1)."'>Précédent</a>&nbsp";
            }
            for($i=1 ; $i<=$nb_page ; $i++)
            {
                if($i==$page_courante)
                {
                    echo $i;
                }
                else
                {
                    echo "<a href='?page=$i'>$i</a>&nbsp";
                }
            }
            if($page_courante<$nb_page)
            {
                echo "<a href='?page=".($page_courante+1)."'>Suivant</a>";
            }
            ?>
        </div>

        <div class="message_box">
            <?php
            foreach ($all_msg as $tab)                                                       /*Une boucle est mis en place dans la vue du profil. Elle parcours le tableau associatif (récupéré grâce à la fonction get_all_message) et affiche les messages. Selon les emetteurs, nous changeons la class css du "div" permettant de personaliser le contenu.*/ {
                $class_msg = ($tab["emetteur"] == $_SESSION["pseudo"]) ? "your_message" : "other_message";
                if ($tab["genre"] == "M") {
                    $class_genre = "homme";
                } elseif ($tab["genre"] == "F") {
                    $class_genre = "femme";
                } else {
                    $class_genre = "sans_reponse";
                }

            ?>
                <div class="message <?=$class_msg;?>">
                    <img src="vue/public/avatar/<?=$tab["avatar"]; ?>" alt="avatar de l'utilisateur">
                    <span class="<?=$class_genre;?>"><?=$tab["emetteur"];?></span>
                    <?php if($tab["emetteur"]==$_SESSION["pseudo"]){
                        echo "<a href='index_chat.php?page=".$page_courante."&delete=$tab[id]' style='float:right;'>X</a>";}
                    ?>
                    <p><?=$tab["message"]; ?></p>
                    <p class="date"><?=$tab["temps"];?></p>
                </div>
            <?php
            };
            ?>
        </div>

        <form action="#" method="post" class="send_message">
            <?php
            if (isset($error_textarea_msg)) {
                echo "<p class='$class_txt_area'>$error_textarea_msg</p>";
            }
            ?>
            <textarea name="message" cols="30" rows="5" placeholder="Votre message" id="messageID" class="<?=$class_txt_area?>"><?=$message;?></textarea>
            <input type="submit" value="Envoyer" name="send">
        </form>
    </div>
</main>
<?php
$title = "Home : OnlineChat";
$content = ob_get_contents();
ob_end_clean();
include("gabarit.php");
?>