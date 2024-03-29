<?php

namespace Jh\LandingCategories\Plugin\Category\Attribute\Source;

use Jh\LandingCategories\Model\Config\Data as LandingCategoryData;
use Magento\Catalog\Model\Category\Attribute\Source\Mode;

/**
 * @author Diego Cabrejas <diego@wearejh.com>
 */
class ModePlugin
{
    /**
     * @var LandingCategoryData
     */
    private $landingCategoryData;

    public function __construct(LandingCategoryData $landingCategoryData)
    {
        $this->landingCategoryData = $landingCategoryData;
    }

    /**
     * Add the landing category display mode
     * @param Mode $subject
     * @param $result
     * @return array
     */
    public function afterGetAllOptions(Mode $subject, $result)
    {
        if (is_array($result)) {
            $catData = $this->landingCategoryData->get();
            foreach ($catData as $option) {
                $result[] = ['value' => $option['layout'], 'label' => $option['label']];
            }
        }
        return $result;
    }
}
