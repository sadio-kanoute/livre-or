<?php
include 'config.php';
include 'header.php';

$erreur = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $stmt->execute([$login]);
        if ($stmt->rowCount() > 0) {
            $erreur = "Ce login existe déjà.";
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

<main>
  <h2>Inscription</h2>
  <form method="POST">
    <input type="text" name="login" placeholder="Login" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="password" name="confirm" placeholder="Confirmer le mot de passe" required>
    <button type="submit">S'inscrire</button>
  </form>
  <p class="error"><?= $erreur ?></p>
</main>

<?php include 'footer.php'; ?>
