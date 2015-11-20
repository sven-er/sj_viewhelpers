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


/**
 *
 * ViewHelper to get an Arraykey
 * Original Maximilian Kalus, http://www.auxnet.de/typo3-array-viewhelper-holt-variable-aus-array/
 *
 * # Example: Basic example
 * # Include in template
 *
 * <code>
 * {namespace sj=SvenJuergens\SjViewHelpers\Viewhelpers}
 * </code>
 *
 *
 * <code>
 *  <sj:arrayElement array="{array}" key="{lang}" variableName="myValue">
 *   <p>{myValue}</p>
 *  </sj:arrayElement>
 * </code>
 * <output>
 * 	"array[arrayKey]"
 * </output>
 *
  */
class ArrayElementViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * @param array $array to search in
     * @param string $key to search for
     * @param string $variableName variable name to set
     * @return string
     */
    public function render($array, $key, $variableName = 'element')
    {
        if (!is_array($array) || empty($array) || !isset($array[$key])) {
            $value = null;
        } else {
            $value = $array[$key];
        }

        $this->templateVariableContainer->add($variableName, $value);
        $content = $this->renderChildren();
        $this->templateVariableContainer->remove($variableName);

        return $content;
    }
}
