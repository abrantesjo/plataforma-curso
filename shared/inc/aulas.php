<?php
function getModulos($cursoId) {
    $modulosMock = [
        1 => [
            "Módulo 1: Introdução" => ["Aula 1: Apresentação", "Aula 2: Conceitos Iniciais"],
            "Módulo 2: Fundamentos" => ["Aula 1: Estruturas Básicas", "Aula 2: Prática com Exercícios"],
        ],
        2 => [
            "Módulo 1: História e Evolução" => ["Aula 1: História da Computação", "Aula 2: Grandes Nomes da Tecnologia"],
            "Módulo 2: Programação" => ["Aula 1: Algoritmos", "Aula 2: Estruturas de Dados"],
        ],
        3 => [
            "Módulo 1: A história do Design" => ["Aula 1: Introdução", "Aula 2: Conceitos básicos"],
            "Módulo 2: Acessibilidade no Design" => ["Aula 1: Conceitos da inclusão", "Aula 2: Aula prática"],
        ],
        4 => [
            "Módulo 1: Introdução" => ["Aula 1: Apresentação", "Aula 2: Conceitos Iniciais"],
            "Módulo 2: Fundamentos" => ["Aula 1: Estruturas Básicas", "Aula 2: Prática com Exercícios"],
        ],
        5 => [
            "Módulo 1: Introdução ao Marketing" => ["Aula 1: Introdução e conceitos", "Aula 2: Marketing digital e sua importância"],
            "Módulo 2: Estudos de caso" => ["Aula 1: Landing Pages", "Aula 2: Estratégia de pesquisa paga"],
        ],
        6 => [
            "Módulo 1: Introdução" => ["Aula 1: Conceitos de UX", "Aula 2: Conceitos de UI"],
            "Módulo 2: Usabilidade e design responsivo" => ["Aula 1: Boas práticas de texto e microinterações", "Aula 2: Fluxos de navegação"],
        ]
    ];

    return $modulosMock[$cursoId] ?? ["Nenhum módulo disponível"];
}
?>
