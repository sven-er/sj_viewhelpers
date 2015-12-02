<?php

namespace SvenJuergens\SjViewhelpers\ViewHelpers\Condition;

/**
 * This file is part of the TYPO3 CMS project.
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

/**
 * If Viewhelper vor LanguageCode
 * Inspired by Maximilian Kalus, http://www.auxnet.de/typo3-sprachen-viewhelper-fuer-fluid/
 *
 * # Example: Basic example
 * # Include in template
 *
 * <code>
 * {namespace sj=SvenJuergens\SjViewhelpers\ViewHelpers}
 * </code>
 *
  * <sj:condition.language value="de">
 *       <f:then>
 *         <f:render partial="de" />
  *       </f:then>
 *       <f:else>
 *           <f:render partial="en" />
 *       </f:else>
 *   </sj:condition.language>
 */
class LanguageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper
{
    /**
     * Render method
     *
     * @param mixed $value
     * @return string
     */
    public function render($value)
    {
        if ($this->getLanguageCode() == $value) {
            return $this->renderThenChild();
        } else {
            return $this->renderElseChild();
        }
    }

    /**
     * Get the current language
     */
    protected function getLanguageCode()
    {
        $languageCode = '';
        if (TYPO3_MODE === 'FE') {
            if (isset($GLOBALS['TSFE']->config['config']['language'])) {
                $languageCode = $GLOBALS['TSFE']->config['config']['language'];
            }
        } elseif (strlen($GLOBALS['BE_USER']->uc['lang']) > 0) {
            $languageCode = $GLOBALS['BE_USER']->uc['lang'];
        }
        return $languageCode;
    }
}
