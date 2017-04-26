<?php namespace CIC\Cicshorturls\Hook;

use CIC\Cicbase\Traits\Database;
use CIC\Cicbase\Utility\Arr;
use CIC\Cicshorturls\Utility\ShortUriConfigUtility;

/**
 * Class DataHandlerHook
 * @package CIC\Cicshorturls\Hook
 */
class RemoveCopiedShortUrisHook {
    use Database;

    /**
     * Check for Short URIs that were created by a page copy, and delete them from the database. As far as I can tell
     * this is the only way to _not_ copy an IRRE record when copying the parent.
     *
     * @param $command
     * @param $table
     * @param $id
     * @param $value
     * @param $dataHandler
     * @param $pasteUpdate
     * @param $pasteDatamap
     */
    public function processCmdmap_postProcess($command, $table, $id, $value, &$dataHandler, $pasteUpdate, $pasteDatamap) {
        /**
         * Only do this on copy
         */
        if ($command !== 'copy') {
            return;
        }

        /**
         * Bail if this isn't part of a page rec update
         */
        if ($table !== 'pages') {
            return;
        }

        /**
         * Get the Short URIs
         */
        $shortUriIds = static::getNewCopyShortUriIdsFromDataHandler($dataHandler);
        if (!count($shortUriIds)) {
            return;
        }

        /**
         *  Kill off any of the short URIs that were created by this copy action
         */
        static::removeShortUris($shortUriIds);
    }

    /**
     * @param $shortUriUids
     */
    protected static function removeShortUris($shortUriUids = []) {
        if (!count($shortUriUids)) {
            return;
        }

        static::db()->exec_DELETEquery(ShortUriConfigUtility::SHORT_URI_TABLE, 'uid IN(' . implode(',', Arr::uniquePositiveInts($shortUriUids)) . ')');
    }

    /**
     * @param $dataHandler
     * @return array
     */
    protected static function getNewCopyShortUriIdsFromDataHandler($dataHandler) {
        $copyMappingArray = $dataHandler->copyMappingArray[ShortUriConfigUtility::SHORT_URI_TABLE];
        if (!is_array($copyMappingArray)) {
            return [];
        }
        return $copyMappingArray ?: [];
    }
}
