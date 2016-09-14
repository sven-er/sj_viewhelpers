<?php

namespace SvenJuergens\SjViewhelpers\ViewHelpers\Format;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper to wrap the FirstWord of a Text
 *
 * # Example: Basic example
 * # Include in template
 *
 * <code>
 * {namespace sj=SvenJuergens\SjViewhelpers\ViewHelpers}
 * </code>
 *
 * <code>
 * <sj:format.firstWordWrap wrap="<strong>|</strong>"> {headline} </sj:format.firstWordWrap>
 * </code>
 * <output>
 *
 * </output>
 */
class FirstWordWrapViewHelper extends AbstractViewHelper
{
    /**
     * Wrap the First Word
     *
     * @param string $content Content string
     * @param string $wrap A wrap value - [part 1] | [part 2]
     * @return string
     */
    public function render($content = null, $wrap = null)
    {
        if ($content === null) {
            $content = $this->renderChildren();
        }
        if ($wrap !== null) {
            $wrapArr = GeneralUtility::trimExplode('|', $wrap);
            $tempContent = GeneralUtility::trimExplode(' ', $this->renderChildren());
            if (count($wrapArr) > 0 && count($tempContent) > 0) {
                $content = $wrapArr[0] . $tempContent[0] . $wrapArr[1];
                unset($tempContent[0]);
                $content .= ' ' . implode(' ', $tempContent);
            }
        }
        return $content;
    }
}
