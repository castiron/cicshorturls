<?php

namespace CIC\Cicshorturls\Utility;

/**
 * Class UriUtility
 * @package CIC\Cicshorturls\Utility
 */
class UriUtility {
    /**
     * @param $uri
     * @return string
     */
    public static function normalizeUri($uri) {
        $temp = preg_replace('~^[\s /]*~', '', $uri);
        return preg_replace('~[\s /]*$~', '', $temp);
    }
}
