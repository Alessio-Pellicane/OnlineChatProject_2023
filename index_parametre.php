<?php
if(empty($_SESSION))
{
    session_start();
    if(!isset($_SESSION["pseudo"]))
    {
        header("location:index.php");
    }
}

include("vue/parametre.php");
?>