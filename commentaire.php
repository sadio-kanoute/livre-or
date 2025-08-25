<?php
require_once 'config.php';
include 'header.php';

if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
    exit();
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentaire = trim($_POST['commentaire']);

    if (empty($commentaire)) {
        $errors[] = "Le champ commentaire est vide.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?, ?, NOW())");
        $stmt->execute([
            $commentaire,
            $_SESSION['user']['id']
        ]);
        $success = true;
        header("Location: livre-or.php");
        exit();
    }
}
?>

<main class="form-page">
  <h2>Ajouter un commentaire</h2>

  <?php if ($errors): ?>
    <div class="error-box">
      <?php foreach ($errors as $e): ?>
        <p><?= htmlspecialchars($e) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="POST">
    <label for="commentaire">Votre commentaire</label>
    <textarea name="commentaire" id="commentaire" rows="5" required></textarea>
    <button type="submit" class="btn">Poster</button>
  </form>
</main>

<?php include 'footer.php'; ?>
