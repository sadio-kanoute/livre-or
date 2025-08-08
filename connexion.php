<?php
include 'config.php';
include 'header.php';

$erreur = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login'] = $user['login'];
        $_SESSION['id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        $erreur = "Login ou mot de passe incorrect.";
    }
}
?>

<main>
  <h2>Connexion</h2>
  <form method="POST">
    <input type="text" name="login" placeholder="Login" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
  </form>
  <p class="error"><?= $erreur ?></p>
</main>

<?php include 'footer.php'; ?>
