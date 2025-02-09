<?php
$pdo = new PDO('sqlite:cursos.db');

$pdo->exec('
    CREATE TABLE IF NOT EXISTS cursos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        description TEXT NOT NULL,
        category TEXT NOT NULL,
        duration INTEGER NOT NULL,
        image TEXT NOT NULL
    )
');

$pdo->exec("
    INSERT INTO cursos (name, description, category, duration, image)
    VALUES
    ('Curso de PHP', 'Aprenda PHP do zero', 'Programação', 10, 'php.jpg'),
    ('Curso de JavaScript', 'Aprenda JavaScript moderno', 'Programação', 15, 'javascript.jpg'),
    ('Curso de Design', 'Design gráfico para iniciantes', 'Design', 20, 'design.jpg'),
    ('Curso de Python', 'Python para ciência de dados', 'Programação', 25, 'python.jpg'),
    ('Curso de Marketing Digital', 'Estratégias de marketing online', 'Marketing', 30, 'marketing.jpg')
");

echo "Banco de dados e tabela criados com sucesso!";
?>