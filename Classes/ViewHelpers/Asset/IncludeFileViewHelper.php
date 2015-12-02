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

/**
 * ViewHelper to include a css/js file
 * Original taken from EXT:news
 *
 * # Example: Basic example
 *
 * Include in template
 *
 * OLD:
 * <code>
 * {namespace sj=Tx_Sjviewhelpers_ViewHelpers}
 * </code>
 *
 * NEW:
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
class IncludeFileViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * Include a CSS/JS file
     *
     * @param string $path Path to the CSS/JS file which should be included
     * @param boolean $compress Define if file should be compressed
     * @param boolean $isJsFile Define that file is a JS File, useful for jsFiles withs Params exp: //maps.googleapis.com/maps/api/js?sensor=false
     * @param boolean $external Define that file is an external File, in getFileName from TYPO3 6.2 is a check for http or https to identify the external File, so files with //maps. ... aren't included
     * @return void
     */
    public function render($path, $compress = false, $isJsFile = false, $external = false)
    {
        if ($external === false) {
            $path = $GLOBALS['TSFE']->tmpl->getFileName($path);
        }
        // JS
        if (strtolower(substr($path, -3)) === '.js' || $isJsFile === true) {
            $GLOBALS['TSFE']->getPageRenderer()->addJsFooterFile($path, null, $compress, null);

        // CSS
        } elseif (strtolower(substr($path, -4)) === '.css') {
            $GLOBALS['TSFE']->getPageRenderer()->addCssFile($path, 'stylesheet', 'all', '', $compress);
        }
    }
}
