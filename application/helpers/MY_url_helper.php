<?php

if (!function_exists('back_url_trans')) {
    function back_url_trans($url, $current) {
        if ($url === FALSE) {
            $url = site_url(INDEX);
        }
        if (strpos($url, 'register') !== FALSE ||
            strpos($url, 'login') !== FALSE) {
            $url = site_url(INDEX);
        }

        if (parse_url($url, PHP_URL_HOST) != parse_url($current, PHP_URL_HOST)) {
            $url = site_url(INDEX);
        }

        return $url;
    }
}
