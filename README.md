# Short URIs for TYPO3 Pages

This extension a field to page records where you can specify short an arbitrary number URIs for the page. The short URIs
 become 301 redirects to the given page. 

## Configuration

Configure the storage page for your URI records:

```php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cicshorturls']['storagePid'] = 1234;
```

or in Page TSConfig:

```typo3_typoscript
TCAdefaults.tx_cicshorturls_domain_model_shorturi.pid = 1234
```
