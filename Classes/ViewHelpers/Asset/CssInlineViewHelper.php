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
 * ViewHelper to include inline CSS
 *
 * # Example:
 * Include in template
 *
 * OLD:
 * {namespace sj=Tx_Sjviewhelpers_ViewHelpers}
 *
 * NEW:
 * * {namespace sj=SvenJuergens\SjViewhelpers\ViewHelpers}
 *
 * # Example: Basic example
 * <code>
 * <sj:asset.cssInline > .test{display:block ...} </sj:asset.cssInline>
 * </code>
 *
 * <code>
 * <sj:asset.cssInline path="{settings.cssInlineFile}"> .test{ display:block ...} </sj:asset.cssInline>
 * </code>
 *
 * <output>
 *
 * </output>
 *
 */
class CssInlineViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * Include CSS Content
     *
     * @param boolean $compress Define if file should be compressed
     * @param string $path Path to the CSS file which should be included
     * @return void
     */
    public function render($compress = true, $path = null)
    {
        $content = trim($this->renderChildren());
        if (!is_null($path) && strtolower(substr($path, -4)) === '.css') {
            $content .= GeneralUtility::getUrl(GeneralUtility::getFileAbsFileName($path));
        }
        $name = md5($content);
        if (!empty($content)) {
            $GLOBALS['TSFE']->getPageRenderer()->addCssInlineBlock($name, $content, $compress);
        }
    }
}
