<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'adminweb') {
    header('Location: ../login.php');
    exit;
}
require_once __DIR__ . '/../inc/db.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $mot_de_passe = trim($_POST['mot_de_passe'] ?? '');
    if ($login !== '' && $mot_de_passe !== '') {
        $sql = "INSERT INTO utilisateur (login, mot_de_passe, role) VALUES (?, ?, 'tech')";
        $stmt = mysqli_prepare($mysqli, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $login, $mot_de_passe);
        $ok = mysqli_stmt_execute($stmt);
        $message = $ok ? 'Technicien créé avec succès.' : 'Erreur : ' . mysqli_error($mysqli);
        mysqli_stmt_close($stmt);
    } else {
        $message = 'Veuillez remplir tous les champs.';
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Créer un technicien</title>
  <link rel="stylesheet" href="../style/styles.css">
</head>
<body>
  <header class="nav">
    <div class="brand">
      <a href="admin.php" class="brand-link">
        <img src="../images/logo_sae.webp" alt="Logo">
      </a>
      <span class="badge">Admin Web</span>
    </div>
    <ul>
      <li><a href="admin.php">Retour admin</a></li>
      <li><a class="btn secondary" href="../logout.php">Déconnexion</a></li>
    </ul>
  </header>
  <main class="container">
    <div class="card" style="max-width:520px;margin:0 auto">
      <h1>Créer un technicien</h1>
      <?php if ($message): ?>
        <p class="note"><?php echo htmlspecialchars($message); ?></p>
      <?php endif; ?>
      <form class="form" method="post" action="create_tech.php">
        <label>Login
          <input class="input" type="text" name="login" required>
        </label>
        <label>Mot de passe
          <input class="input" type="text" name="mot_de_passe" required>
        </label>
        <button class="button" type="submit">Créer</button>
      </form>
    </div>
  </main>
</body>
</html>

