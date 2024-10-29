<?php
if(empty($_SESSION))
{
    session_start();
    if(!isset($_SESSION["pseudo"]))
    {
        header("location:index.php");
    }
}

include("model/fonctionDB.php");

$erreur_fichier="";
$class_fichier="";

if(!empty($_POST))
{
    $nom_fichier=$_FILES["telechargement"]["name"];
    $repertoir_tmp_fichier=$_FILES["telechargement"]["tmp_name"];
    $taille_fichier=$_FILES["telechargement"]["size"];
    $erreur_telechargement=$_FILES["telechargement"]["error"];
    $ext=explode(".",$nom_fichier);
    $extension_fichier=strtolower(end($ext));
    $extension_recquis=["jpg","png"];

    if(in_array($extension_fichier,$extension_recquis))
    {
        if($erreur_telechargement===0)
        {
            if($taille_fichier<=2097152) //2Mo
            {
                $nouveau_nom_fichier=$_SESSION["pseudo"].".".$extension_fichier;
                $destination_fichier="vue/public/avatar/".$nouveau_nom_fichier;
                move_uploaded_file($repertoir_tmp_fichier,$destination_fichier);
                modif_avatar($_SESSION["pseudo"],$nouveau_nom_fichier);
                $_SESSION["avatar"]=$nouveau_nom_fichier;
                header("location:index_parametre.php");
            }
            else
            {
                $erreur_fichier="Taille de l'image trop grande (2 Mo max)";
                $class_fichier="error";
            }
        }
        else
        {
            $erreur_fichier="Erreur lors du telechargement : (ERR: $erreur_telechargement";
            $class_fichier="error";
        }
    }
    else
    {
        $erreur_fichier="Veuillez télécharger un fichier avec l'extension \".png\" ou \".jpg\"";
        $class_fichier="error";
    }

}

include("vue/modif_avatar.php");
?>