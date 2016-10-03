<?php namespace CIC\Cicshorturls\Tca;

use CIC\Cicshorturls\Utility\UriUtility;

/**
 * Class UrlNormalizeEvaluation
 * @package CIC\Cicshorturls\Tca
 */
class UrlNormalizeEvaluation {
    /**
     * JavaScript code for client side validation/evaluation
     *
     * @return string JavaScript code for client side validation/evaluation
     */
    public function returnFieldJS() {
        return 'return value.replace(/^[/]+|[/]+$/g, \'\');';
    }

    /**
     * Server-side validation/evaluation on saving the record
     * NB: This doesn't seem to work, maybe because of the IRRE context [?]
     *     In any case, the client-side support should cover it
     *
     * @param string $value The field value to be evaluated
     * @return string Evaluated field value
     */
    public function evaluateFieldValue($value) {
        return UriUtility::normalizeUri($value);
    }

    /**
     * Server-side validation/evaluation on opening the record
     *
     * @param array $parameters Array with key 'value' containing the field value from the database
     * @return string Evaluated field value
     */
    public function deevaluateFieldValue(array $parameters) {
        return UriUtility::normalizeUri($parameters['value']);
    }
}
