    <footer class="footer container">
      <p class="fine-print">
        Copyright © <?= Date('Y') ?> Alex Holt
        <?php if ( is_user_logged_in() ): ?>
          <a class="fine-print" href="/journal">Journal</a>
        <?php endif; ?>
      </p>
    </footer>

    <?php wp_footer() ?>
  </body>
</html>
