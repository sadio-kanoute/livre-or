<?php
require_once 'config.php';
include 'header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {
        $errors[] = "Tous les champs sont obligatoires.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'login' => $user['login']
            ];
            header("Location: index.php");
            exit();
        } else {
            $errors[] = "Login ou mot de passe incorrect.";
        }
    }
}
?>

<main class="form-page">
  <h2>Connexion</h2>

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

    <button type="submit" class="btn">Se connecter</button>
  </form>
</main>

<?php include 'footer.php'; ?>
