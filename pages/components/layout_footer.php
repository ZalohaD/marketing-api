<?php
if (!isset($pageScript)) $pageScript = '';
?>

<footer class="py-3 mt-auto text-center">
  <span class="text-secondary" style="font-size:.8rem">&copy; <?= date('Y') ?> Space-Marketing</span>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php if ($pageScript): ?>
<script src="/assets/js/<?= $pageScript ?>"></script>
<?php endif; ?>
</body>
</html>
