document.addEventListener("DOMContentLoaded", function () {
    const inputPesquisa = document.getElementById("pesquisa");
    const listaCursos = document.getElementById("cursos-lista");

    inputPesquisa.addEventListener("keyup", function () {
        let termo = inputPesquisa.value.trim();

        fetch("shared/inc/buscar-cursos.php?pesquisa=" + encodeURIComponent(termo))
            .then(response => response.text())
            .then(data => {
                listaCursos.innerHTML = data;
            })
            .catch(error => console.error("Erro na busca:", error));
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("details").forEach((detail) => {
        let icon = detail.querySelector("summary i");

        detail.addEventListener("toggle", function () {
            if (detail.open) {
                icon.classList.remove("bi-chevron-down");
                icon.classList.add("bi-chevron-up");
            } else {
                icon.classList.remove("bi-chevron-up");
                icon.classList.add("bi-chevron-down");
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const toggleSearch = document.getElementById("toggleSearch");
    const searchBar = document.getElementById("pesquisa");

    toggleSearch.addEventListener("click", function () {
        searchBar.classList.toggle("active");

        if (searchBar.classList.contains("active")) {
            searchBar.focus();
        }
    });
});
