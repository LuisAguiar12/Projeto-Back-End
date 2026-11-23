
function abrirModal() {
    document.getElementById("modalProduto").classList.add("ativo");
}

function fecharModal() {
    document.getElementById("modalProduto").classList.remove("ativo");
}

// Fecha ao clicar fora da caixa
document.getElementById("modalProduto").addEventListener("click", function(event) {
    if (event.target === this) {
        fecharModal();
    }
});

// Fecha ao apertar ESC
document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        fecharModal();
    }
});
