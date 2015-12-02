<?php

namespace SvenJuergens\SjViewhelpers\ViewHelpers\Asset;

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

/**
 * ViewHelper to include a inline JS file
 *
 *
 *
 * # Example: Basic example
 * # Include in template
 *
 * <code>
 * {namespace sj=SvenJuergens\SjViewhelpers\ViewHelpers}
 * </code>
 *
 * <code>
 * <sj:asset.jsInline position="bottom"> ... </sj:asset.jsInline>
 * </code>
 * <output>
 *
 * </output>
 */
class JsInlineViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * Include JS Content
     *
     * @param string $position Optional
     * @param boolean $compress Define if file should be compressed
     * @return void
     */
    public function render($position = null, $compress = true)
    {
        $content = GeneralUtility::minifyJavaScript($this->renderChildren());
        $name = md5($content);

        if ($position == 'bottom') {
            $GLOBALS['TSFE']->getPageRenderer()->addJsFooterInlineCode($name, $content, $compress);
        } else {
            $GLOBALS['TSFE']->getPageRenderer()->addJsInlineCode($name, $content, $compress);
        }
    }
}
