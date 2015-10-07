<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=ma_db;charset=utf8', 'root', ''); //se connecter a la base de données (a mettre dans une fonctions plus tard)
}
catch (Exception $e)
{
    die('Erreur: '.$e->getMessage());
}


if(isset($_POST["envoie"])) // lordque l'utilisateur appuie sur le bouton inscription
{
    $pseudo=$_POST['pseudo'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    $email=$_POST['email'];



    if(!empty($pseudo) AND !empty($password) AND !empty($password2) AND !empty($email)) // les cases d'entrés utilisateurs ne doivent pas être vide
    {
        if($password==$password2) //vérifie que les deux mots de passe soient les mêmes
        {
            $password_hach = sha1($password); //Sécurité au niveau du mot de passe, il sera haché dans ma bd
            $req = $bdd->prepare('INSERT INTO membres(pseudo,pass,email,date_inscription)VALUES(:pseudo, :password, :email, CURDATE())');
            $req->execute(array(
                    'pseudo'=>$pseudo,
                    'password'=>$password_hach,
                    'email'=>$email
                )

            )    ;



        }
        else
        {
            echo "veuillez entrer le même mot de passe";
        }
    }


}




?>
<html>
<form action="" method="post">



Pseudo :                     <input type="text" name="pseudo" /><br/>
mot de passe :               <input type="password" name="password" /><br/>
Retapez votre mot de passe : <input type="password" name="password2" /><br/>
Adresse email :              <input type="email" name="email"/><br/>
<input type="submit" name="envoie" value="Inscription"><br/>

</form>



</html>