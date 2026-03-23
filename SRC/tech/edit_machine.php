<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'tech') {
    header('Location: ../login.php');
    exit;
}
require_once __DIR__ . '/../inc/db.php';
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: list_machines.php');
    exit;
}
$message = '';
$result_os = mysqli_query($mysqli, "SELECT id, nom FROM os ORDER BY nom");
$result_const = mysqli_query($mysqli, "SELECT id, nom FROM constructeur ORDER BY nom");

$sql = "SELECT * FROM machine WHERE id = ?";
$stmt = mysqli_prepare($mysqli, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$machine = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);
if (!$machine) {
    header('Location: list_machines.php');
    exit;
}

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
        $sql = "UPDATE machine
                SET nom = ?, modele = ?, cpu = ?, ram = ?, os_id = ?, constructeur_id = ?, batiment = ?, salle = ?, etat = ?
                WHERE id = ?";
        $stmt = mysqli_prepare($mysqli, $sql);
        mysqli_stmt_bind_param($stmt, 'sssiiisssi',
            $nom, $modele, $cpu, $ram, $os_id, $constructeur_id, $batiment, $salle, $etat, $id);
        $ok = mysqli_stmt_execute($stmt);
        $message = $ok ? 'Machine mise à jour.' : 'Erreur : ' . mysqli_error($mysqli);
        mysqli_stmt_close($stmt);
        if ($ok) {
            $machine['nom'] = $nom;
            $machine['modele'] = $modele;
            $machine['cpu'] = $cpu;
            $machine['ram'] = $ram;
            $machine['os_id'] = $os_id;
            $machine['constructeur_id'] = $constructeur_id;
            $machine['batiment'] = $batiment;
            $machine['salle'] = $salle;
            $machine['etat'] = $etat;
        }
    } else {
        $message = 'Nom et modèle sont obligatoires.';
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Modifier une machine</title>
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
      <li><a href="list_machines.php">Retour à la liste</a></li>
      <li><a class="btn secondary" href="../logout.php">Déconnexion</a></li>
    </ul>
  </header>
  <main class="container">
    <div class="card" style="max-width:640px;margin:0 auto">
      <h1>Modifier une machine</h1>
      <?php if ($message): ?>
        <p class="note"><?php echo htmlspecialchars($message); ?></p>
      <?php endif; ?>
      <form class="form" method="post" action="edit_machine.php?id=<?php echo $id; ?>">
        <label>Nom
          <input class="input" type="text" name="nom" value="<?php echo htmlspecialchars($machine['nom']); ?>" required>
        </label>
        <label>Modèle
          <input class="input" type="text" name="modele" value="<?php echo htmlspecialchars($machine['modele']); ?>" required>
        </label>
        <label>CPU
          <input class="input" type="text" name="cpu" value="<?php echo htmlspecialchars($machine['cpu']); ?>">
        </label>
        <label>RAM (Mo)
          <input class="input" type="number" name="ram" value="<?php echo (int)$machine['ram']; ?>">
        </label>
        <label>Système d’exploitation
          <select class="input" name="os_id">
            <option value="0">-- Non renseigné --</option>
            <?php mysqli_data_seek($result_os, 0); ?>
            <?php while ($os = mysqli_fetch_assoc($result_os)): ?>
              <option value="<?php echo $os['id']; ?>" <?php if ($machine['os_id'] == $os['id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($os['nom']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </label>
        <label>Constructeur
          <select class="input" name="constructeur_id">
            <option value="0">-- Non renseigné --</option>
            <?php mysqli_data_seek($result_const, 0); ?>
            <?php while ($c = mysqli_fetch_assoc($result_const)): ?>
              <option value="<?php echo $c['id']; ?>" <?php if ($machine['constructeur_id'] == $c['id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($c['nom']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </label>
        <label>Bâtiment
          <input class="input" type="text" name="batiment" value="<?php echo htmlspecialchars($machine['batiment']); ?>">
        </label>
        <label>Salle
          <input class="input" type="text" name="salle" value="<?php echo htmlspecialchars($machine['salle']); ?>">
        </label>
        <label>État
          <select class="input" name="etat">
            <option value="actif" <?php if ($machine['etat'] === 'actif') echo 'selected'; ?>>actif</option>
            <option value="rebut" <?php if ($machine['etat'] === 'rebut') echo 'selected'; ?>>rebut</option>
          </select>
        </label>
        <button class="button" type="submit">Enregistrer</button>
      </form>
    </div>
  </main>
</body>
</html>

