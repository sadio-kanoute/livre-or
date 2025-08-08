<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Livre d'or</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="livre-or.php">Livre d'or</a></li>

        <?php if (isset($_SESSION['login'])): ?>
          <li><a href="commentaire.php">Commenter</a></li>
          <li><a href="profil.php">Profil</a></li>
          <li><a href="deconnexion.php">Déconnexion</a></li>
        <?php else: ?>
          <li><a href="inscription.php">Inscription</a></li>
          <li><a href="connexion.php">Connexion</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
