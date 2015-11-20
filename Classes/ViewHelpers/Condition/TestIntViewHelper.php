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
 * If Viewhelper vor TestInt
 * Inspired by Björn Fromme, EXT:vhs
 *
 * # Example: Basic example
 * # Include in template
 *
 * <code>
 * {namespace sj=SvenJuergens\SjViewHelpers\Viewhelpers}
 * </code>
 *
  * <sj:condition.testInt value="{uid}">
 *       <f:then>
 *         // do this
  *       </f:then>
 *       <f:else>
 *           // do that
 *       </f:else>
 *   </sj:condition.testInt>
 */
class TestIntViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper
{
    /**
     * Render method
     *
     * @param mixed $value
     * @return string
     */
    public function render($value)
    {
        if ($this->canBeInterpretedAsInteger($value) === true) {
            return $this->renderThenChild();
        } else {
            return $this->renderElseChild();
        }
    }

    /*
    * Copy from canBeInterpretedAsIntegeger TYPO3 6.1.3
    */
    public function canBeInterpretedAsInteger($var)
    {
        if ($var === '' || is_object($var) || is_array($var)) {
            return false;
        }
        return (string) intval($var) === (string) $var;
    }
}
