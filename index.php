<?php
require_once("shared/inc/conf.php");

$ttsSite = TITULO_SITE;

// Header
require_once("shared/inc/header.php");

?>

<?php
    $pdo = new PDO('sqlite:shared/db/cursos.db');

    $stmt = $pdo->query('SELECT * FROM cursos LIMIT 6');
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




    <section class="section-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap-cursos">
                        <?php if (empty($cursos)): ?>
                            <p>Nenhum curso disponível no momento.</p>
                        <?php else: ?>
                            <?php foreach ($cursos as $curso): ?>
                                <div class="curso">
                                    <div class="bg" style="background-image: url('shared/images/<?php echo htmlspecialchars($curso['image']); ?>')">
                                        <div class="wrap-nome">
                                            <h2>
                                                <a href="descricao.php?id=<?php echo $curso['id']; ?>">
                                                    <?php echo htmlspecialchars($curso['name']); ?>
                                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                    
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="listagem.php" class="btn">Ver todos</a>
            </div>
        </div>
    </section>

<?php
    // Footer
    require_once('shared/inc/footer.php');
?>

