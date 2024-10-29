<?php
function connexionDB()
{
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $dbName = "onlinechat";

    return mysqli_connect($host, $user, $pwd, $dbName);
}

function chatConnexion($log, $mdp)
{
    $log = htmlentities($log);
    $mdp = htmlentities($mdp);

    $connexion = connexionDB();

    if ($connexion) {
        $stmt = mysqli_prepare($connexion, "SELECT pseudo,mdp FROM utilisateur WHERE pseudo=?;");           //Requête préparer, recherche du log et mdp sur base du login
        mysqli_stmt_bind_param($stmt, "s", $log);                                                           //bind la variable comme paramètre
        mysqli_stmt_execute($stmt);                                                                         //Execution de la requête
        $res=mysqli_stmt_get_result($stmt);                                                                 //Récupération du jeu de résultat dans $res
        $result=mysqli_fetch_all($res,MYSQLI_ASSOC);                                                        //Je stock dans mon tableau associatif le jeu de résultat trouvé
        
        $user=!empty($result)?$result[0]["pseudo"]:10;
        $pwd=!empty($result)?$result[0]["mdp"]:null;
        mysqli_close($connexion);
        
        if ($log == $user && password_verify($mdp,$pwd)) 
        {
            $ok = 1;
        } 
        else 
        {
            $ok = 0;
        }
    }
    return $ok;
}

function checkLog($log)
{
    $log=htmlentities($log);

    $connexion=connexionDB();

    if($connexion)
    {
        $stmt=mysqli_prepare($connexion,"SELECT pseudo FROM utilisateur WHERE pseudo=?;");
        mysqli_stmt_bind_param($stmt,"s",$log);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$user);
        mysqli_stmt_fetch($stmt);
        mysqli_close($connexion);

        if($log!=$user)
        {
            $ok=1;
        }
        else
        {
            $ok=0;
        }
    }
    return $ok;
}

function chatInscription($log,$mdp,$sexe,$ddn)
{
    $log=htmlentities($log);
    $mdp=htmlentities($mdp);
    $mdp=password_hash($mdp,PASSWORD_DEFAULT);
    $sexe=htmlentities($sexe);
    $ddn=htmlentities($ddn);
    $avatar="default.jpg";

    $connexion=connexionDB();

    if($connexion)
    {
        $stmt=mysqli_prepare($connexion,"INSERT INTO utilisateur (pseudo,mdp,genre,ddn,avatar) VALUES (?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt,"sssss",$log,$mdp,$sexe,$ddn,$avatar);
        mysqli_stmt_execute($stmt);
        mysqli_close($connexion);
    }
}

function getList($log)
{
    $log=htmlentities($log);

    $connexion=connexionDB();

    if($connexion)
    {
        $stmt=mysqli_prepare($connexion,"SELECT * FROM utilisateur WHERE pseudo=?;");
        mysqli_stmt_bind_param($stmt,"s",$log);
        mysqli_stmt_execute($stmt);
        $res=mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($res);
        mysqli_close($connexion);
    }
}

function get_all_message()
{
    $connexion=connexionDB();

    if($connexion)
    {
        return mysqli_fetch_all(mysqli_query($connexion,"SELECT id,message,temps,emetteur,genre,avatar from chatmessage inner join utilisateur on emetteur=pseudo ORDER BY temps DESC;"),MYSQLI_ASSOC);
        mysqli_close($connexion);
    }
}

function new_msg($msg,$log)
{
    $msg=htmlentities($msg);
    $id=NULL;

    $connexion=connexionDB();

    if($connexion)
    {
        $stmt=mysqli_prepare($connexion,"INSERT INTO chatmessage (id,message,temps,emetteur) VALUES (?,?,NOW(),?);");
        mysqli_stmt_bind_param($stmt,"iss",$id,$msg,$log);
        mysqli_stmt_execute($stmt);
        mysqli_close($connexion);
    }
}

function modif_avatar($log,$avatar)
{
    $log=htmlentities($log);
    $avatar=htmlentities($avatar);

    $connexion=connexionDB();

    if($connexion)
    {
        $stmt=mysqli_prepare($connexion,"UPDATE utilisateur SET avatar=? WHERE pseudo=?");
        mysqli_stmt_bind_param($stmt,"ss",$avatar,$log);
        mysqli_stmt_execute($stmt);
        mysqli_close($connexion);
    }
}
?>