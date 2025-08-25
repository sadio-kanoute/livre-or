<?php include 'header.php'; ?>
<main class="accueil">
  <section class="hero">
    <h1>Bienvenue sur le Livre d'or</h1>
    <p>Découvrez ce que les visiteurs pensent de nous, ou partagez vous-même votre avis !</p>
    <div class="cta">
      <button onclick="window.location.href='livre-or.php'" class="btn">Voir les commentaires</button>
      <?php if (!isset($_SESSION['login'])): ?>
        <button onclick="window.location.href='inscription.php'" class="btn secondary">Créer un compte</button>
      <?php endif; ?>
    </div>
  </section>

  <section class="presentation">
    <h2>Pourquoi ce site ?</h2>
    <p>
      Ce site a été réalisé dans le cadre de la formation <strong><a href="https://laplateforme.io" target="_blank">La Plateforme.io</a></strong>.
      Il permet aux utilisateurs de s'exprimer librement, de partager leurs ressentis, et de découvrir l'avis des autres.
    </p>
    <p>
      L'idée est simple : créer un espace de liberté d'expression avec une touche moderne et sécurisée.
    </p>
  </section>
</main>
<?php include 'footer.php'; ?>
