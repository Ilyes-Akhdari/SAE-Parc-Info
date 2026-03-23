<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'tech') {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../inc/db.php';

$parPage = 10;

$resCount = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM machine");
$rowCount = mysqli_fetch_assoc($resCount);
$totalMachines = (int)$rowCount['total'];
$totalPages = $totalMachines > 0 ? (int)ceil($totalMachines / $parPage) : 1;

$pageCourante = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($pageCourante < 1) {
    $pageCourante = 1;
}
if ($pageCourante > $totalPages) {
    $pageCourante = $totalPages;
}

$offset = ($pageCourante - 1) * $parPage;

$sql = "SELECT m.id, m.nom, m.modele, m.cpu, m.ram, m.batiment, m.salle, m.etat,
               o.nom AS os_nom, c.nom AS constructeur_nom
        FROM machine m
        LEFT JOIN os o ON m.os_id = o.id
        LEFT JOIN constructeur c ON m.constructeur_id = c.id
        ORDER BY m.nom
        LIMIT ?, ?";
$stmt = mysqli_prepare($mysqli, $sql);
mysqli_stmt_bind_param($stmt, 'ii', $offset, $parPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Parc informatique</title>
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
    <div class="card">
      <h1>Parc informatique</h1>
      <p class="note">
        Machines affichées : 
        <?php
          $debut = $totalMachines === 0 ? 0 : $offset + 1;
          $fin = min($offset + $parPage, $totalMachines);
          echo $debut . " à " . $fin . " sur " . $totalMachines;
        ?>
      </p>
      <table class="table">
        <thead>
          <tr>
            <th>Nom</th><th>Modèle</th><th>CPU</th><th>RAM</th>
            <th>OS</th><th>Constructeur</th><th>Bât.</th><th>Salle</th><th>État</th><th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($totalMachines === 0): ?>
            <tr><td colspan="10">Aucune machine dans le parc.</td></tr>
          <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['modele']); ?></td>
                <td><?php echo htmlspecialchars($row['cpu']); ?></td>
                <td><?php echo htmlspecialchars($row['ram']); ?> Mo</td>
                <td><?php echo htmlspecialchars($row['os_nom']); ?></td>
                <td><?php echo htmlspecialchars($row['constructeur_nom']); ?></td>
                <td><?php echo htmlspecialchars($row['batiment']); ?></td>
                <td><?php echo htmlspecialchars($row['salle']); ?></td>
                <td><?php echo htmlspecialchars($row['etat']); ?></td>
                <td><a href="edit_machine.php?id=<?php echo $row['id']; ?>">Modifier</a></td>
              </tr>
            <?php endwhile; ?>
          <?php endif; ?>
        </tbody>
      </table>

      <?php if ($totalPages > 1): ?>
        <div class="pagination" style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap;">
          <?php if ($pageCourante > 1): ?>
            <a href="list_machines.php?page=<?php echo $pageCourante - 1; ?>">&laquo; Précédent</a>
          <?php endif; ?>

          <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <?php if ($p == $pageCourante): ?>
              <span style="font-weight:bold;"><?php echo $p; ?></span>
            <?php else: ?>
              <a href="list_machines.php?page=<?php echo $p; ?>"><?php echo $p; ?></a>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($pageCourante < $totalPages): ?>
            <a href="list_machines.php?page=<?php echo $pageCourante + 1; ?>">Suivant &raquo;</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>

