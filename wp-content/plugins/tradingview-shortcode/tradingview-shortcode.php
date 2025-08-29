<?php
/**
 * Plugin Name: TradingView Shortcode
 * Description: Embed TradingView charts with [tv symbol="NSE:NIFTY" interval="15" timezone="Asia/Kolkata" height="480"]
 * Version: 1.0
 */
if (!defined('ABSPATH')) { exit; }

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
