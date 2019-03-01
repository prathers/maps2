<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function() {
    $extConf = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \JWeiland\Maps2\Configuration\ExtConf::class
    );

    // Set latitude/longitude to float representation of extension configuration
    $GLOBALS['TCA']['tx_maps2_domain_model_poicollection']['columns']['latitude']['config']['default'] = number_format(
        $extConf->getDefaultLatitude(),
        6
    );
    $GLOBALS['TCA']['tx_maps2_domain_model_poicollection']['columns']['longitude']['config']['default'] = number_format(
        $extConf->getDefaultLongitude(),
        6
    );

    if ($extConf->getMapProvider() === 'both') {
        $GLOBALS['TCA']['tx_maps2_domain_model_poicollection']['columns']['map_provider']['config']['default'] = $extConf->getDefaultMapProvider();
    } else {
        $GLOBALS['TCA']['tx_maps2_domain_model_poicollection']['columns']['map_provider']['config']['default'] = $extConf->getMapProvider();
    }

    // Add column "categories" to tx_maps2_domain_model_poicollection table
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
        'maps2',
        'tx_maps2_domain_model_poicollection',
        'categories',
        []
    );
});
