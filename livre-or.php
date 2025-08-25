<?php
require_once 'config.php';
include 'header.php';


$query = $pdo->query("
    SELECT commentaires.commentaire, commentaires.date, utilisateurs.login 
    FROM commentaires 
    INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id 
    ORDER BY commentaires.date DESC
");

$commentaires = $query->fetchAll();
?>

<main class="comments-page">
  <h2>Livre d'or</h2>

  <?php if (isset($_SESSION['user'])): ?>
    <a href="commentaire.php" class="btn">Ajouter un commentaire</a>
  <?php endif; ?>

  <?php if (count($commentaires) > 0): ?>
    <div class="comments-list">
      <?php foreach ($commentaires as $com): ?>
        <div class="comment-card">
          <p class="comment-meta">
            Posté le <?= date('d/m/Y H:i', strtotime($com['date'])) ?>
            par <strong><?= htmlspecialchars($com['login']) ?></strong>
          </p>
          <p class="comment-text"><?= nl2br(htmlspecialchars($com['commentaire'])) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>Aucun commentaire pour le moment. Soyez le premier !</p>
  <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
