<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'tech') {
    header('Location: ../login.php');
    exit;
}
require_once __DIR__ . '/../inc/db.php';
$message = '';
$result_os = mysqli_query($mysqli, "SELECT id, nom FROM os ORDER BY nom");
$result_const = mysqli_query($mysqli, "SELECT id, nom FROM constructeur ORDER BY nom");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $modele = trim($_POST['modele'] ?? '');
    $cpu = trim($_POST['cpu'] ?? '');
    $ram = (int)($_POST['ram'] ?? 0);
    $os_id = (int)($_POST['os_id'] ?? 0);
    $constructeur_id = (int)($_POST['constructeur_id'] ?? 0);
    $batiment = trim($_POST['batiment'] ?? '');
    $salle = trim($_POST['salle'] ?? '');
    $etat = $_POST['etat'] ?? 'actif';
    if ($nom !== '' && $modele !== '') {
        $sql = "INSERT INTO machine (nom, modele, cpu, ram, os_id, constructeur_id, batiment, salle, etat)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($mysqli, $sql);
        mysqli_stmt_bind_param($stmt, 'sssiiisss',
            $nom, $modele, $cpu, $ram, $os_id, $constructeur_id, $batiment, $salle, $etat);
        $ok = mysqli_stmt_execute($stmt);
        $message = $ok ? 'Machine ajoutée avec succès.' : 'Erreur : ' . mysqli_error($mysqli);
        mysqli_stmt_close($stmt);
    } else {
        $message = 'Nom et modèle sont obligatoires.';
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Ajouter une machine</title>
  <link rel="stylesheet" href="../style/styles.css">
</head>
<body>
  <header class="nav">
    <div class="brand">
      <a href="tech.php" class="brand-link">
        <img src="../images/logo_sae.webp" alt="Logo">
      </a>
      <span class="badge">Technicien</span>
    </div>
    <ul>
      <li><a href="tech.php">Menu technicien</a></li>
      <li><a class="btn secondary" href="../logout.php">Déconnexion</a></li>
    </ul>
  </header>
  <main class="container">
    <div class="card" style="max-width:640px;margin:0 auto">
      <h1>Ajouter une machine</h1>
      <?php if ($message): ?>
        <p class="note"><?php echo htmlspecialchars($message); ?></p>
      <?php endif; ?>
      <form class="form" method="post" action="add_machine.php">
        <label>Nom
          <input class="input" type="text" name="nom" required>
        </label>
        <label>Modèle
          <input class="input" type="text" name="modele" required>
        </label>
        <label>CPU
          <input class="input" type="text" name="cpu">
        </label>
        <label>RAM (Mo)
          <input class="input" type="number" name="ram" min="0">
        </label>
        <label>Système d’exploitation
          <select class="input" name="os_id">
            <option value="0">-- Non renseigné --</option>
            <?php while ($os = mysqli_fetch_assoc($result_os)): ?>
              <option value="<?php echo $os['id']; ?>"><?php echo htmlspecialchars($os['nom']); ?></option>
            <?php endwhile; ?>
          </select>
        </label>
        <label>Constructeur
          <select class="input" name="constructeur_id">
            <option value="0">-- Non renseigné --</option>
            <?php while ($c = mysqli_fetch_assoc($result_const)): ?>
              <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['nom']); ?></option>
            <?php endwhile; ?>
          </select>
        </label>
        <label>Bâtiment
          <input class="input" type="text" name="batiment">
        </label>
        <label>Salle
          <input class="input" type="text" name="salle">
        </label>
        <label>État
          <select class="input" name="etat">
            <option value="actif">actif</option>
            <option value="rebut">rebut</option>
          </select>
        </label>
        <button class="button" type="submit">Ajouter</button>
      </form>
    </div>
  </main>
</body>
</html>

