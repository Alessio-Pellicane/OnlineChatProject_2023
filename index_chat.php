<?php
if (empty($_SESSION)) {
    session_start();
    if(!isset($_SESSION["pseudo"]))             //Si les variables sessions n'existe pas, on redirige vers la page de connexion (permet éviter d'accèder au chat via l'url)
    {
        header("location:index.php");
    }
}
include("model/fonctionDB.php");

/*Système de pagination*/

$class_txt_area="";
$all_msg = get_all_message();                   

$msg_par_page=20;
$total_msg=count($all_msg);
$nb_page=ceil($total_msg/$msg_par_page);


if(isset($_GET["page"]) && !empty($_GET["page"]) && $_GET["page"]>0 && $_GET["page"]<=$nb_page)
{
    $_GET["page"]=intval($_GET["page"]);
    $page_courante=$_GET["page"];
}
else
{
    $page_courante=1;
}
$debut=($page_courante-1)*$msg_par_page;
$a=min($msg_par_page,$total_msg-$debut);
$all_msg=array_slice($all_msg,$debut,$a);

/*Suppression d'un message*/


/*Insertion d'un nouveau message*/

$message="";

if(!empty($_POST))
{
    $message=$_POST["message"];
    

    if(!empty($message))
    {
        if(strlen($message)<=1000)
        {
            new_msg($message,$_SESSION["pseudo"]);
            header("location:index_chat.php");
        }
        else
        {
            $error_textarea_msg="Message trop long (Max 1000 caractères). (".(1000-strlen($message)).")";
            $class_txt_area="error";
        }
    }
    else
    {
        $error_textarea_msg="Ce champs ne peut pas être vide !";
        $class_txt_area="error";
    }
}

include("vue/chat.php");