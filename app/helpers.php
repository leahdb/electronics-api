<?php

if (! function_exists('cdnasset')) {
    function cdnasset($str, $rootDir = 'public', $providePlaceHolder = false) {
        // Default to fallback placeholder if image doesn't exist
        if (($str == null || $str == '') && $providePlaceHolder) {
            $str = 'static/placeholder-image.png';
        }

        $cdnURL = env('CDN_URL');
        $isURL = filter_var($str, FILTER_VALIDATE_URL);

        // If an image is for some reason an online URL use it as is
        if ($isURL) {
            return $str;
        }

        return $cdnURL . '/' . $rootDir . '/' . $str;
    }
}
