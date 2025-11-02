<?php
/**
 * The template for displaying the footer
 */
?>

<footer class="site-footer">
  <div class="footer-inner">
    <p>&copy; <?php echo date('Y'); ?> Design Everything. All rights reserved.</p>

    <?php if (has_nav_menu('footer')) : ?>
      <nav class="footer-nav">
        <?php
          wp_nav_menu([
            'theme_location' => 'footer',
            'container'      => false,
            'menu_class'     => 'footer-menu',
          ]);
        ?>
      </nav>
    <?php endif; ?>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
