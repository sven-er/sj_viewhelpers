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
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper to include a css/js file
 * Original taken from EXT:news
 *
 * # Example: Basic example
 *
 * Include in template
 *
 * <code>
 * {namespace sj=SvenJuergens\SjViewhelpers\ViewHelpers}
 * </code>
 *
 * <code>
 * <sj:asset.includeFile path="{settings.cssFile}" />
 * <sj:asset.includeFile path="//maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7&hnear=Deutschland" isJsFile="true"/>
 * </code>
 * <output>
 * This will include the file provided by {settings} in the footer (js) or in the header (css)
 * </output>
 *
 */
class IncludeFileViewHelper extends AbstractViewHelper
{


    /**
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('path', 'string', ' Path to the CSS/JS file which should be included');
        $this->registerArgument('compress', 'boolean', 'Define if file should be compressed', false, false);
        $this->registerArgument(
            'isJsFile',
            'boolean',
            'Define that file is a JS File, useful for jsFiles withs Params 
             exp: //maps.googleapis.com/maps/api/js?sensor=false',
            false,
            false
        );
        $this->registerArgument(
            'external',
            'boolean',
            'Define that file is an external File, in getFileName from TYPO3 6.2
             is a check for http(s) to identify the external File, so files with //maps. ... are not included',
            false,
            false
        );
        $this->registerArgument(
            'async',
            'boolean',
            '(Since TYPO3 7.1) Allows the file to be loaded asynchronously, JS only',
            false,
            false
        );
        $this->registerArgument(
            'integrity',
            'string',
            '(Since TYPO3 7.3) Adds the integrity attribute to the script element to let 
            browsers ensure subresource integrity, JS only'
        );
    }


    /**
     * Include a CSS/JS file
     *
     * @return void
     */
    public function render()
    {
        if ($this->arguments['external'] === false) {
            $this->arguments['path'] = $GLOBALS['TSFE']->tmpl->getFileName($this->arguments['path']);
        }
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        // JS
        if (strtolower(substr($this->arguments['path'], -3)) === '.js' || $this->arguments['isJsFile'] === true) {
            $pageRenderer->addJsFooterFile(
                $this->arguments['path'],
                null,
                $this->arguments['compress'],
                null,
                null,
                null,
                null,
                $this->arguments['async'],
                $this->arguments['integrity']
            );

        // CSS
        } elseif (strtolower(substr($this->arguments['path'], -4)) === '.css') {
            $pageRenderer->addCssFile(
                $this->arguments['path'],
                'stylesheet',
                'all',
                null,
                $this->arguments['compress']
            );
        }
    }
}
