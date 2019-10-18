<?php
/* Shortcodes */
//[quote citation="Ross Hendry, Esquire"]
function shortcode_quote_output($atts, $content = null)
{
    if ($content == null) {
        return false;
    }
    $citation = isset($atts['citation']) ? $atts['citation'] : '';

    $output = '';
    ob_start();
    echo '<blockquote>';
    echo wpautop($content);
    if (!empty($citation)) {
        echo '<footer class="citation">' . $citation . '</footer>';
    }
    echo '</blockquote>';

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode('quote', 'shortcode_quote_output');
