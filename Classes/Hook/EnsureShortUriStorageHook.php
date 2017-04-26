<?php namespace CIC\Cicshorturls\Hook;

use CIC\Cicbase\Traits\Database;
use CIC\Cicshorturls\Utility\ShortUriConfigUtility;

/**
 * Class EnsureShortUriStorageHook
 * @package CIC\Cicshorturls\Hook
 */
class EnsureShortUriStorageHook {
    use Database;

    /**
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
         * Only do this on move. Copy is covered by RemoveCopiedShortUrisHook
         */
        if ($command !== 'move') {
            return;
        }

        /**
         * Only do this when a page is moved
         */
        if ($table !== 'pages') {
            return;
        }

        static::ensureStoragePidByPage($id);
    }

    /**
     * Update the pid on any short URIs belonging to this page ID
     *
     * @param int $pageUid
     */
    protected static function ensureStoragePidByPage($pageUid) {
        if (!$pageUid) {
            return;
        }

        $storagePid = ShortUriConfigUtility::shortUriStoragePid($pageUid);
        if (!$storagePid) {
            return;
        }

        static::db()->exec_UPDATEquery(ShortUriConfigUtility::SHORT_URI_TABLE, 'page=' . intval($pageUid), ['pid' => $storagePid]);
    }
}
