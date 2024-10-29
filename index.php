<?php
if(empty($_SESSION))
{
    session_start();
    if(isset($_SESSION["pseudo"]))
    {
        header("location:index_chat.php");
    }
}
include("model/fonctionDB.php");

$login="";
$mdp="";

$class_mdp="";
$class_pseudo="";



if(!empty($_POST))
{
    $login=$_POST["login"];
    $mdp=$_POST["mdp"];

    if(!empty($login) && !empty($mdp))
    {
        if(chatConnexion($login,$mdp))
        {
            $_SESSION=getList($login);
            header("location:index_chat.php");
        }
        else
        {
            $msg_error_connexion="Login et/ou mot de passe incorrect";
            $class_connexion_error="error";
            $class_pseudo="error";
            $class_mdp="error";
            include("vue/connexion.php");
        }
    }
    else
    {
        if(empty($login))
        {
            $msg_error_login="Ce champ est vide";
            $class_pseudo="error";
        }
        if(empty($mdp))
        {
            $msg_error_mdp="Ce champ est vide";
            $class_mdp="error";
        }
        include("vue/connexion.php");
    }
}
else
{
    include("vue/connexion.php");
}
?>