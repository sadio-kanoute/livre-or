<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['login'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentaire = $_POST['commentaire'];
    $stmt = $pdo->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?, ?, NOW())");
    $stmt->execute([$commentaire, $_SESSION['id']]);
    header("Location: livre-or.php");
    exit();
}
?>

<main>
  <h2>Ajouter un commentaire</h2>
  <form method="POST">
    <textarea name="commentaire" placeholder="Votre commentaire" required></textarea>
    <button type="submit">Poster</button>
  </form>
</main>

<?php include 'footer.php'; ?>
