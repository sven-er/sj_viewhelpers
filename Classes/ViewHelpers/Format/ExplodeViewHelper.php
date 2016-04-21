<?php

namespace SvenJuergens\SjViewhelpers\ViewHelpers;

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
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
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
 *  <sj:format.explode contentString="{teaser.bodytext}" by="PHP_EOL" isAConstant="true" returnAs="elements">
 *  <f:for each="{elements}" as="element">
 *    <p>{element}</p>
 *  </f:for>
 *  </sj:format.explode>
 * </code>
 * <output>
 *
 * </output>
 */
class ExplodeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * Make an array out of String by Linebreak
     *
     * @param string $contentString to change to array
     * @param string $by Explode String by this
     * @param bool $isAConstant is "$by" a Constant like PHP_EOL
     * @param string $returnAs variable name to set
     * @return string
     */
    public function render($contentString = null, $by=null, $isAConstant=false, $returnAs = 'elements')
    {
        if($contentString === null){
            return $this->renderChildren();
        }

        if($by === null){
            $by = "PHP_EOL";
            $isAConstant = true;
        }
        $value = GeneralUtility::trimExplode( ($isAConstant ? constant($by) : $by), $contentString);

        $this->templateVariableContainer->add($returnAs, $value);
        $content = $this->renderChildren();
        $this->templateVariableContainer->remove($returnAs);
        return $content;
    }
}
