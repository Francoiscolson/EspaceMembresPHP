<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=ma_db;charset=utf8', 'root', ''); //se connecter a la base de données (a mettre dans une fonctions plus tard)
}
catch (Exception $e)
{
    die('Erreur: '.$e->getMessage());
}







if(isset($_POST['envoie']))
{

  if(!empty($_POST['password']) AND !empty($_POST['pseudo'])){
      $pseudo=$_POST['pseudo'];
      $password=$_POST['password'];
     $password_hach =sha1($password);


      $req = $bdd->prepare('SELECT ID from membres WHERE pseudo=:pseudo AND pass=:password'); // je pépapre la bdd a recevoir l'id de la personne ayant le pseudo "..." et le mdp "..."
      $req->execute(array(     //je place les variables
          'pseudo'=> $pseudo,
          'password' => $password_hach

      ));
     $resultat = $req->fetch(); // fecth recupére la premiere ligne (il faudrait faire un while pour tout afficher crf : open class)

     if(!$resultat) //si il y a erreur dans resultat
     {
         echo "vous avez entré un mauvais mot de passe ou un mauvais pseudo";
     }
      else{
          echo $resultat['ID']; // je recupere l'id de la personne ayant le pseudo "..." et le mot de passe "..."
      }
  }
}

?>
<html>

<form action="connexion.php" method="post">
Pseudo:               <input type="text" name="pseudo" ><br/>
Mot de passe :        <input type="password" name="password"><br/>
Connexion automatique <input type="checkbox" name="connexion"><br/>
                      <input type="submit" name="envoie" value="Se connecter"><br/>

</form>


</html>