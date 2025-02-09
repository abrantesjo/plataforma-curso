<?php
require_once("shared/inc/conf.php");

$ttsSite ='';

// Header
require_once("shared/inc/header.php");

require_once("shared/inc/aulas.php");

?>

<?php
if (!isset($_GET['id'])) {
    die('ID do curso não especificado.');
}

$pdo = new PDO('sqlite:shared/db/cursos.db');

$stmt = $pdo->prepare('SELECT * FROM cursos WHERE id = ?');
$stmt->execute([$_GET['id']]);
$curso = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$curso) {
    die('Curso não encontrado.');
}
?>

<section class="section-descricao">
    <div class="full-banner">
        <div class="item" style="background-image: url('shared/images/<?php echo htmlspecialchars($curso['image']); ?>')">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <button class="voltar-btn" onclick="window.history.back()"><i class="bi bi-chevron-left"></i> Voltar</button>

                        <p class="categoria <?php echo strtolower(str_replace(' ', '-', removerAcentos($curso['category']))); ?>"><?php echo htmlspecialchars($curso['category']); ?></p>
                        <h1 class="name"><?php echo htmlspecialchars($curso['name']); ?></h1>
                    </div>
                </div>
            </div>
        </div>
        

    </div>

    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <div class="curso">
                    <p class="duracao">Duração do curso: <?php echo htmlspecialchars($curso['duration']); ?> horas</p>

                </div>
            </div>

            <div class="col-md-5 col-12">
                <h2>Sobre o curso:</h2>
                <p class="descricao"><?php echo htmlspecialchars($curso['description']); ?></p>
            </div>
            <div class="col-md-6 col-12">
                <h2>Conteúdo do Curso:</h2>
                <?php
                $modulos = getModulos($curso['id']);
                foreach ($modulos as $modulo => $aulas): ?>
                    <details>
                        <summary><?php echo htmlspecialchars($modulo); ?><i class="bi bi-chevron-down"></i></summary>
                        
                            <?php foreach ($aulas as $aula): ?>
                                <p><?php echo htmlspecialchars($aula); ?></p>
                            <?php endforeach; ?>
                        
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</section>

<?php
// Footer
require_once('shared/inc/footer.php');
?>
