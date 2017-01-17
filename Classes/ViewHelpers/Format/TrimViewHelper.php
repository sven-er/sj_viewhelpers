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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Trims content by stripping off $characters
 * Original from EXT:vhs
 *
 * # Example: Basic example
 * # Include in template
 *
 * <code>
 * {namespace sj=SvenJuergens\SjViewhelpers\ViewHelpers}
 * </code>
 *
 * <sj:format.trim content="foo" characters="foo">
 * <!-- tag content - may be ignored! -->
 * </sj:format.trim>
 *
 *    Inline usage example
 *    {sj:format.trim(content: 'foo', characters: 'foo')}
 */
class TrimViewHelper extends AbstractViewHelper
{
    /**
     * @param string $content
     * @param string $characters
     * @return string
     */
    public function render($content = null, $characters = null)
    {
        if ($content === null) {
            $content = $this->renderChildren();
        }
        if (empty($characters) === false) {
            $content = trim($content, $characters);
        } else {
            $content = trim($content);
        }
        return $content;
    }
}
