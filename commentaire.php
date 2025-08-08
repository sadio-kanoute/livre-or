<?php
include 'config.php';
include 'header.php';

$commentaires = $pdo->query("
  SELECT commentaires.commentaire, commentaires.date, utilisateurs.login 
  FROM commentaires 
  INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id 
  ORDER BY commentaires.date DESC
")->fetchAll();
?>

<main>
  <h2>Livre d'or</h2>
  <?php foreach ($commentaires as $c): ?>
    <div class="comment">
      <p><strong>Posté le <?= date("d/m/Y à H:i", strtotime($c['date'])) ?> par <?= htmlspecialchars($c['login']) ?> :</strong></p>
      <p><?= nl2br(htmlspecialchars($c['commentaire'])) ?></p>
    </div>
  <?php endforeach; ?>

  <?php if (isset($_SESSION['login'])): ?>
    <p><a href="commentaire.php">→ Ajouter un commentaire</a></p>
  <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
