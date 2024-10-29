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
$confirmation="";
$sexe="";
$ddn="";

$class_pseudo="";
$class_mdp="";
$class_confirmation="";
$class_sexe="";
$class_date="";

if(!empty($_POST))                                                                                              //Si le formulaire est soumit
{
    $login=$_POST["login"];
    $mdp=$_POST["mdp"];
    $confirmation=$_POST["confirmation"];
    $sexe=$_POST["sexe"];
    $ddn=$_POST["ddn"];

    if(!empty($login) && !empty($mdp) && !empty($confirmation) && !empty($sexe) && !empty($ddn))                //Si aucun champs sont vides
    {
        
        if(checkLog($login)==1)                                                                                 //Si le pseudo est différent qu'un login de la db
        {
            if(preg_match("#^.{8,15}$#",$login))                                                                //Si le login contient entre 8 et 15 cractères
            {
                if(!preg_match("#\s#",$login))                                                                  //Si le login ne contient pas d'espace
                {
                    if(preg_match("#.{8,15}#",$mdp))                                                            //Si le mdp contient entre 8 et 15 caractères
                    {
                        if(!preg_match("#\s#",$mdp))                                                            //Si le mdp ne contient pas d'espace
                        {
                            if(preg_match("#[A-Z]#",$mdp))                                                      //Si le mdp contient une majuscule
                            {
                                if(preg_match("#[0-9]#",$mdp))                                                  //Si le mdp contient un chiffre
                                {
                                    if(preg_match("#[\~\@\#\_\^\*\%\/\.\+\:\;\=]#",$mdp))
                                    {
                                        if($mdp==$confirmation)
                                        {
                                            $aujourdhui=date("Y-m-d");
                                            $diff=(date_diff(date_create($ddn),date_create($aujourdhui)))->format("%y");
                                            if($diff>=14)
                                            {
                                                chatInscription($login,$mdp,$sexe,$ddn);
                                                $msg_error_connexion="Vous avez bien été enregistrer !";
                                                header("location:index.php");
                                                exit(0);
                                            }
                                            else
                                            {
                                                $msg_error_date="Vous devez avoir minimum 14 ans";
                                                $class_date="error";
                                            }
                                        }
                                        else
                                        {
                                            $msg_error_confirmation="La confirmation ne correspond pas avec le mot de passe";
                                            $class_confirmation="error";
                                        }
                                    }
                                    else
                                    {
                                        $msg_error_mdp="Le mot de passe doit contenir au moins un cractère spécial: [~@#_^*%/.+:;=]";
                                        $class_mdp="error";
                                    }
                                }
                                else
                                {
                                    $msg_error_mdp="Le mot de passe doit contenir au moins un chiffre";
                                    $class_mdp="error";
                                }
                            }
                            else
                            {
                                $msg_error_mdp="Le mot de passe doit contenir au moins une lettre majuscule";
                                $class_mdp="error";
                            }
                        }
                        else
                        {
                            $msg_error_mdp="Le mot de passe ne doit pas contenir d'espace";
                            $class_mdp="error";
                        }
                    }
                    else
                    {
                        $msg_error_mdp="Le mot de passe doit contenir entre 8 et 15 caractères";
                        $class_mdp="error";
                    }
                }
                else
                {
                    $msg_error_login="Le login ne doit pas contenir d'espace";
                    $class_pseudo="error";
                }
            }
            else
            {
                $msg_error_login="Le login doit contenir entre 8 et 15 caractères";
                $class_pseudo="error";
            }
        }
        else
        {
            $msg_error_login="Le login existe déjà";
            $class_login="error";
        }
    }
    else                                                                        //Si des champs sont vides
    {
        $msg_error_inscription="Veuillez complèter tous les champs";            //Msg général si tout les champs ne sont pas complèt
        $class_inscription_error="error";
        if(empty($login))                                                       //si login vide
        {
            $msg_error_login="Ce champ est vide";
            $class_pseudo="error";
        }
        if(empty($mdp))                                                         //si mdp est vide
        {
            $msg_error_mdp="Ce champ est vide";
            $class_mdp="error";
        }
        if(empty($confirmation))                                                //si confirmation mdp est vide
        {
            $msg_error_confirmation="Ce champ est vide";
            $class_confirmation="error";
        }
        if(empty($sexe))                                                        //si sexe vide
        {
            $msg_error_sexe="Veuillez cocher une option";
            $class_sexe="error";
        }
        if(empty($ddn))                                                         //si ddn vide
        {
            $msg_error_date="Veuillez selectionner une date";
            $class_date="error";
        }
    }
}
    
include("vue/inscription.php");

?>