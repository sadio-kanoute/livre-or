<?php
session_start();
require_once 'config.php'; 
include 'header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (empty($login) || empty($password) || empty($confirm)) {
        $errors[] = "Tous les champs sont obligatoires.";
    } elseif ($password !== $confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = ?");
        $stmt->execute([$login]);
        if ($stmt->fetch()) {
            $errors[] = "Ce login est déjà utilisé.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO utilisateurs (login, password) VALUES (?, ?)");
            $insert->execute([$login, $hash]);
            header("Location: connexion.php");
            exit();
        }
    }
}
?>

<main class="form-page">
  <h2>Inscription</h2>

  <?php if ($errors): ?>
    <div class="error-box">
      <?php foreach ($errors as $e): ?>
        <p><?= htmlspecialchars($e) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="POST">
    <label for="login">Login</label>
    <input type="text" name="login" id="login" required>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>

    <label for="confirm">Confirmation</label>
    <input type="password" name="confirm" id="confirm" required>

    <button type="submit" class="btn">S'inscrire</button>
  </form>
</main>

<?php include 'footer.php'; ?>
