<?php
require_once("conf.php");

header('Content-Type: text/html; charset=utf-8');

$databasePath = __DIR__ . '/../db/cursos.db';
$pdo = new PDO('sqlite:' . $databasePath, null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$pesquisa = $_GET['pesquisa'] ?? '';
$categoria = $_GET['categoria'] ?? '';
$ordem = $_GET['ordem'] ?? 'desc'; 

$sql = 'SELECT * FROM cursos WHERE name LIKE :pesquisa';

if (!empty($categoria)) {
    $sql .= ' AND category = :categoria';
}

if ($ordem === 'asc') {
    $sql .= ' ORDER BY duration ASC';
} else {
    $sql .= ' ORDER BY duration DESC';
}

$stmt = $pdo->prepare($sql);
$pesquisa = "%$pesquisa%";
$stmt->bindParam(':pesquisa', $pesquisa, PDO::PARAM_STR);

if (!empty($categoria)) {
    $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
}

$stmt->execute();
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($cursos)) {
    echo "<p class='no-results'>Nenhum curso encontrado.</p>";
} else {
    foreach ($cursos as $curso) {
        echo '<div class="curso">
                <p>Id do curso: ' . htmlspecialchars($curso['id']) . '</p>
                <div class="bg" style="background-image: url(\'shared/images/' . htmlspecialchars($curso['image']) . '\')">
                    <h2>
                        <a href="descricao.php?id=' . $curso['id'] . '">' . htmlspecialchars($curso['name']) . '</a>
                    </h2>
                </div>
                <div class="wrap-descricao">
                    <p class="categoria ' . strtolower(str_replace(' ', '-', removerAcentos($curso['category']))) . '">
                        ' . htmlspecialchars($curso['category']) . '
                    </p>
                    <p class="text-start pt-4">' . htmlspecialchars($curso['description']) . '</p>
                    <p class="text-start">Duração do curso: ' . htmlspecialchars($curso['duration']) . ' horas</p>
                    <a class="btn-saiba-mais" href="descricao.php?id=' . $curso['id'] . '">
                        Saiba mais <i class="bi bi-arrow-right-circle-fill"></i>
                    </a>
                </div>
              </div>';
    }
}
?>
