<?php
namespace JWeiland\Maps2\Client;

/*
 * This file is part of the maps2 project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Open Street Map Client which will send Requests to Open Street Map Servers
 */
class OpenStreetMapClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $title = 'Open Street Map';

    /**
     * Check result from Open Street Map Server for errors
     *
     * @param array|null $result
     * @return bool
     */
    protected function requestHasErrors($result)
    {
        $hasErrors = false;

        if ($result === null) {
            $this->messageHelper->addFlashMessage(
                'The response of Open Street Map was not a valid JSON response.',
                'Invalid JSON response',
                FlashMessage::ERROR
            );
            $hasErrors = true;
        }

        if (is_array($result) && empty($result)) {
            $this->messageHelper->addFlashMessage(
                LocalizationUtility::translate(
                    'error.noPositionsFound.body',
                    'maps2',
                    [
                        0 => $this->title
                    ]
                ),
                LocalizationUtility::translate('error.noPositionsFound.title', 'maps2'),
                FlashMessage::INFO
            );
            $hasErrors = true;
        }

        return $hasErrors;
    }
}