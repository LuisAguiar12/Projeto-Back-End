<footer class="site-footer">
    <a class="site-footer-monograma" href="./home.php" aria-label="Lewis - início">
        <img src="./image/logo_footer.svg" alt="Lewis">
    </a>
    <p>Mais do que roupas: um estilo de vida.</p>
</footer>
<?php if (basename($_SERVER["SCRIPT_NAME"] ?? "") === "home.php"): ?>
<script src="./js/home.js" defer></script>
<?php endif; ?>
<script src="./js/motion.js" defer></script>
