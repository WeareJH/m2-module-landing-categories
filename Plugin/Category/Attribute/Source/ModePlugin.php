<?php

namespace Jh\LandingCategories\Plugin\Category\Attribute\Source;

use Magento\Catalog\Model\Category\Attribute\Source\Mode;

/**
 * @author Diego Cabrejas <diego@wearejh.com>
 */
class ModePlugin
{
    const DM_LANDING = 'JH_LANDING';

    /**
     * Add the landing category display mode
     * @param Mode $subject
     * @param $result
     * @return array
     */
    public function afterGetAllOptions(Mode $subject, $result)
    {
        if (is_array($result)) {
            $result[] = ['value' => self::DM_LANDING, 'label' => __('Landing Category')];
        }

        return $result;
    }
}
