<?php
require_once("shared/inc/conf.php");

$ttsSite = TITULO_SITE;

// Header
require_once("shared/inc/header.php");

header('Content-Type: text/html; charset=utf-8');

$pdo = new PDO('sqlite:shared/db/cursos.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
$pdo->exec("PRAGMA encoding = 'UTF-8';");

$pesquisa = $_GET['pesquisa'] ?? '';
$ordenacao = $_GET['ordenacao'] ?? 'recentes';
$categoria = $_GET['categoria'] ?? '';

$sql = 'SELECT * FROM cursos WHERE name LIKE :pesquisa';
$params = [':pesquisa' => "%$pesquisa%"];

if (!empty($categoria)) {
    $sql .= ' AND category = :categoria';
    $params[':categoria'] = $categoria;
}

if ($ordenacao === 'maior-duracao') {
    $sql .= ' ORDER BY duration DESC';
} else {
    $sql .= ' ORDER BY duration ASC';
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtCategorias = $pdo->query("SELECT DISTINCT category FROM cursos ORDER BY category ASC");
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_COLUMN);
?>

<section class="section-listagem">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-bar d-flex justify-content-end gap-3 mb-4">
                    <div class="search-container">
                        <button id="toggleSearch" class="search-icon d-block d-md-none">
                            <i class="bi bi-search"></i>
                        </button>
                        <input type="text" id="pesquisa" class="search-input" placeholder="Pesquisar cursos" value="<?php echo htmlspecialchars($pesquisa); ?>" aria-label="Pesquisar">
                    </div>

                    <div class="dropdown">
                        <button class="btn-dropdown" type="button" id="categoriaDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Filtrar">
                            <i class="bi bi-funnel"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="categoriaDropdown">
                            <li><a class="dropdown-item categoria-option" href="?pesquisa=<?php echo urlencode($pesquisa); ?>&ordenacao=<?php echo urlencode($ordenacao); ?>">Todas</a></li>
                            <?php foreach ($categorias as $cat): ?>
                                <li>
                                    <a class="dropdown-item categoria-option" href="?pesquisa=<?php echo urlencode($pesquisa); ?>&ordenacao=<?php echo urlencode($ordenacao); ?>&categoria=<?php echo urlencode($cat); ?>">
                                        <?php echo htmlspecialchars($cat); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="btn-dropdown" type="button" id="ordenacaoDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Ordenar">
                            <i class="bi bi-arrow-down-up"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="ordenacaoDropdown">
                            <li><a class="dropdown-item ordenacao-option" href="?pesquisa=<?php echo urlencode($pesquisa); ?>&categoria=<?php echo urlencode($categoria); ?>&ordenacao=menor-duracao">Menor Duração</a></li>
                            <li><a class="dropdown-item ordenacao-option" href="?pesquisa=<?php echo urlencode($pesquisa); ?>&categoria=<?php echo urlencode($categoria); ?>&ordenacao=maior-duracao">Maior Duração</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="wrap-cursos" id="cursos-lista">
                <?php if (empty($cursos)): ?>
                    <p class="no-results">Nenhum curso encontrado.</p>
                <?php else: ?>
                    <?php foreach ($cursos as $curso): ?>
                        <div class="curso">
                            <p>Id do curso: <?php echo $curso['id']; ?></p>
                            <div class="bg" style="background-image: url('shared/images/<?php echo htmlspecialchars($curso['image']); ?>')">
                                <h2>
                                    <a href="descricao.php?id=<?php echo $curso['id']; ?>">
                                        <?php echo htmlspecialchars($curso['name']); ?>
                                    </a>
                                </h2>
                            </div>

                            <div class="wrap-descricao">
                                <p class="categoria <?php echo strtolower(str_replace(' ', '-', removerAcentos($curso['category']))); ?>"><?php echo htmlspecialchars($curso['category']); ?></p>

                                <p class="text-start pt-4"><?php echo htmlspecialchars($curso['description']); ?></p>
                                
                                <p class="text-start">Duração do curso: <?php echo htmlspecialchars($curso['duration']); ?> horas</p>

                                <a class="btn-saiba-mais" href="descricao.php?id=<?php echo $curso['id']; ?>">Saiba mais<i class="bi bi-arrow-right-circle-fill"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// Footer
require_once('shared/inc/footer.php');
?>
