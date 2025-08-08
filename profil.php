<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['login'])) {
    header('Location: connexion.php');
    exit();
}

$erreur = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_login = $_POST['login'];
    $new_password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($new_password !== $confirm) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE utilisateurs SET login = ?, password = ? WHERE id = ?");
        $update->execute([$new_login, $hash, $_SESSION['id']]);
        $_SESSION['login'] = $new_login;
        $success = "Profil mis à jour.";
    }
}
?>

<main>
  <h2>Modifier le profil</h2>
  <form method="POST">
    <input type="text" name="login" value="<?= $_SESSION['login'] ?>" required>
    <input type="password" name="password" placeholder="Nouveau mot de passe" required>
    <input type="password" name="confirm" placeholder="Confirmer le mot de passe" required>
    <button type="submit">Modifier</button>
  </form>
  <p class="error"><?= $erreur ?></p>
  <p class="success"><?= $success ?></p>
</main>

<?php include 'footer.php'; ?>
