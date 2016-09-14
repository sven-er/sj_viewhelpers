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
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper;
/**
 * If Viewhelper vor TestInt
 * Inspired by Björn Fromme, EXT:vhs
 *
 * # Example: Basic example
 * # Include in template
 *
 * <code>
 * {namespace sj=SvenJuergens\SjViewhelpers\ViewHelpers}
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
class TestIntViewHelper extends AbstractConditionViewHelper
{
    /**
     * Render method
     *
     * @param mixed $value
     * @return string
     */
    public function render($value)
    {
        if (MathUtility::canBeInterpretedAsInteger($value) === true) {
            return $this->renderThenChild();
        } else {
            return $this->renderElseChild();
        }
    }
}
