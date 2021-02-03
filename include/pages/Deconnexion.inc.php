<?php
if(!empty($_SESSION["user"])){
  session_unset ( );
  header('Location: index.php?page=0');
} else {
  echo "<h1>Vous n'êtes pas connecté</h1>";
}
?>
