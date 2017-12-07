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
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper to include inline CSS
 *
 * # Example:
 * Include in template
 *
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
 */
class CssInlineViewHelper extends AbstractViewHelper
{
    /**
     * Include CSS Content
     *
     * @param bool $compress Define if file should be compressed
     * @param string $path Path to the CSS file which should be included
     */
    public function render($compress = true, $path = null)
    {
        $content = trim($this->renderChildren());
        if (!is_null($path) && strtolower(substr($path, -4)) === '.css') {
            $content .= GeneralUtility::getUrl(GeneralUtility::getFileAbsFileName($path));
        }
        $name = md5($content);
        if (!empty($content)) {
            /** @var PageRenderer $pageRenderer */
            $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
            $pageRenderer->addCssInlineBlock($name, $content, $compress);
        }
    }
}
