<?php

namespace SvenJuergens\SjViewhelpers\ViewHelpers\Media;

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

use TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Exception;

/* Extends the ImageViewhelper to allow lazyload
 *
 * Original: CHRISTIAN SONNTAG, http://www.motions-media.de/2014/03/11/extbase-fluid-image-viewhelper-erweitern-fuer-lazyloading/
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
 * 	<sj:media.lazyImage src="uploads/tx_nosimplegallery/{image.image}" title="..." alt="..." maxWidth="..." maxHeight="..." />
 * </code>
 *
 * <output>
 * <img data-lazy="typo3temp/_processed_/csm_BremenTREND_April2015_5_f99f74e189.png" title="..." alt="..." width="..." height="..." >
 * </output>
 *
 *
*/

class LazyImageViewHelper extends ImageViewHelper
{
    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerTagAttribute('data-lazy', 'string', 'original image for lazy loading', false);
    }

    /**
     * Resizes a given image (if required) and renders the respective img tag
     *
     * @see http://typo3.org/documentation/document-library/references/doc_core_tsref/4.2.0/view/1/5/#id4164427
     * @param string $src a path to a file, a combined FAL identifier or an uid (integer). If $treatIdAsReference is set, the integer is considered the uid of the sys_file_reference record. If you already got a FAL object, consider using the $image parameter instead
     * @param string $width width of the image. This can be a numeric value representing the fixed width of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param string $height height of the image. This can be a numeric value representing the fixed height of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param integer $minWidth minimum width of the image
     * @param integer $minHeight minimum height of the image
     * @param integer $maxWidth maximum width of the image
     * @param integer $maxHeight maximum height of the image
     * @param boolean $treatIdAsReference given src argument is a sys_file_reference record
     * @param FileInterface|AbstractFileFolder $image a FAL object
     *
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @return string Rendered tag
     */
    public function render($src = null, $width = null, $height = null, $minWidth = null, $minHeight = null, $maxWidth = null, $maxHeight = null, $treatIdAsReference = false, $image = null)
    {
        if (is_null($src) && is_null($image) || !is_null($src) && !is_null($image)) {
            throw new Exception('You must either specify a string src or a File object.', 1382284106);
        }
        $image = $this->imageService->getImage($src, $image, $treatIdAsReference);
        $processingInstructions = array(
            'width' => $width,
            'height' => $height,
            'minWidth' => $minWidth,
            'minHeight' => $minHeight,
            'maxWidth' => $maxWidth,
            'maxHeight' => $maxHeight,
        );
        $processedImage = $this->imageService->applyProcessingInstructions($image, $processingInstructions);
        $imageUri = $this->imageService->getImageUri($processedImage);

        $this->tag->addAttribute('data-lazy', $imageUri);
        $this->tag->addAttribute('width', $processedImage->getProperty('width'));
        $this->tag->addAttribute('height', $processedImage->getProperty('height'));

        $alt = $image->getProperty('alternative');
        $title = $image->getProperty('title');

        // The alt-attribute is mandatory to have valid html-code, therefore add it even if it is empty
        if (empty($this->arguments['alt'])) {
            $this->tag->addAttribute('alt', $alt);
        }
        if (empty($this->arguments['title']) && $title) {
            $this->tag->addAttribute('title', $title);
        }

        return $this->tag->render();
    }
}
