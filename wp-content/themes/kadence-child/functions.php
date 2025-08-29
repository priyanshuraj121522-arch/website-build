<?php
if (!defined('ABSPATH')) { exit; }

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('kadence-child', get_stylesheet_uri(), [], '1.0');
});

/**
 * TradingView shortcode fallback: [tv symbol="NSE:NIFTY" interval="60" timezone="Asia/Kolkata" height="480"]
 * If a separate plugin provides the shortcode, this will be ignored.
 */
if (!shortcode_exists('tv')) {
  add_shortcode('tv', function($atts){
    $a = shortcode_atts([
      'symbol' => 'NSE:NIFTY',
      'interval' => '60',
      'timezone' => 'Asia/Kolkata',
      'height' => '480'
    ], $atts);
    $id = 'tv_' . md5($a['symbol'].$a['interval'].$a['timezone']);
    ob_start(); ?>
    <div class="tradingview-widget-container">
      <div id="<?php echo esc_attr($id); ?>" style="height:<?php echo intval($a['height']); ?>px;"></div>
      <script src="https://s3.tradingview.com/tv.js"></script>
      <script>
        new TradingView.widget({
          container_id: "<?php echo esc_js($id); ?>",
          symbol: "<?php echo esc_js($a['symbol']); ?>",
          interval: "<?php echo esc_js($a['interval']); ?>",
          timezone: "<?php echo esc_js($a['timezone']); ?>",
          theme: "dark",
          style: "1",
          autosize: true,
          withdateranges: true,
          locale: "en"
        });
      </script>
    </div>
    <?php return ob_get_clean();
  });
}
