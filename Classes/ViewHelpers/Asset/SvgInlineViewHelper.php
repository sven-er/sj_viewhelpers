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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper to include inline SVG
 *
 * # Example:
 * Include in template
 *
 * <code>
 *  <html data-namespace-typo3-fluid="true"
 *       xmlns:sj="http://typo3.org/ns/SvenJuergens/SjViewhelpers/ViewHelpers"
 *  >
 * </code>
 *
 * # Example: Basic example
 *
 * <code>
 * <sj:asset.svgInline path="{settings.svgInlinePathToFolder}">contentIconPin</sj:svgInline>
 * </code>
 *
 * <output>
 *
 * </output>
 */
class SvgInlineViewHelper extends AbstractViewHelper
{

    /**
     * View helper returns HTML, thus we need to disable output escaping
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initializes the arguments
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        $this->registerArgument(
            'path',
            'string',
            'Path to the Folder with the svg File',
            true
        );
    }

    /**
     * Include SVG Content
     *
     * @return string
     */
    public function render(): string
    {
        $content = trim($this->renderChildren());
        if ($this->arguments['path'] !== null) {
            return GeneralUtility::getUrl(
                GeneralUtility::getFileAbsFileName($this->arguments['path'] . $content . '.svg')
            );
        }
        return 'missing path to Folder /' . $content;
    }
}
