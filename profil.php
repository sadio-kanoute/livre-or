<?php
session_start();
require_once 'config.php';
include 'header.php';

if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
    exit();
}

$success = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newLogin = trim($_POST['login']);
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($newLogin) || empty($newPassword) || empty($confirmPassword)) {
        $errors[] = "Tous les champs sont obligatoires.";
    } elseif ($newPassword !== $confirmPassword) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    } else {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE utilisateurs SET login = ?, password = ? WHERE id = ?");
        $stmt->execute([$newLogin, $hash, $_SESSION['user']['id']]);
        $_SESSION['user']['login'] = $newLogin;
        $success = "Profil mis à jour avec succès.";
    }
}
?>

<main class="form-page">
  <h2>Modifier mon profil</h2>

  <?php if ($success): ?>
    <div class="success-box"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <?php if ($errors): ?>
    <div class="error-box">
      <?php foreach ($errors as $e): ?>
        <p><?= htmlspecialchars($e) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="POST">
    <label for="login">Nouveau login</label>
    <input type="text" name="login" id="login" value="<?= htmlspecialchars($_SESSION['user']['login']) ?>" required>

    <label for="password">Nouveau mot de passe</label>
    <input type="password" name="password" id="password" required>

    <label for="confirm_password">Confirmer le mot de passe</label>
    <input type="password" name="confirm_password" id="confirm_password" required>

    <button type="submit" class="btn">Mettre à jour</button>
  </form>
</main>

<?php include 'footer.php'; ?>
