<?php
/**
 * Template: Single Trade Setup (custom post type slug: trade_setup)
 * Place this file at: wp-content/themes/kadence-child/single-trade_setup.php
 */
get_header(); ?>
<main class="container">
  <?php while (have_posts()): the_post(); ?>
    <article>
      <h1><?php the_title(); ?></h1>
      <p>
        <strong>Ticker:</strong> <?php the_field('ticker'); ?> |
        <strong>Market:</strong> <?php the_field('market'); ?> |
        <strong>Index:</strong> <?php the_field('index'); ?>
      </p>
      <div class="grid">
        <div>
          <ul>
            <li><b>Entry:</b> <?php the_field('entry'); ?></li>
            <li><b>Stop-loss:</b> <?php the_field('stop_loss'); ?></li>
            <li><b>Targets:</b> <?php the_field('target1'); ?> / <?php the_field('target2'); ?> / <?php the_field('target3'); ?></li>
            <li><b>Risk:Reward:</b> <?php the_field('rr'); ?></li>
            <li><b>Timeframe:</b> <?php the_field('timeframe'); ?></li>
          </ul>
          <h3>Rationale</h3>
          <div><?php the_field('rationale'); ?></div>
        </div>
        <div>
          <?php if($img = get_field('chart_image')): ?>
            <img src="<?php echo esc_url($img['url']); ?>" alt="Trade setup chart">
          <?php endif; ?>
        </div>
      </div>
      <hr />
      <div class="tv-embed">
        <?php echo do_shortcode('[tv symbol="NSE:NIFTY" interval="15"]'); ?>
      </div>
      <?php the_content(); ?>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
