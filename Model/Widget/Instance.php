<?php

namespace Jh\LandingCategories\Model\Widget;

use Magento\Widget\Model\Widget\Instance as WidgetInstance;

/**
 * @author Diego Cabrejas <diego@wearejh.com>
 */
class Instance extends WidgetInstance
{
    const LANDING_CATEGORY_LAYOUT_HANDLE = 'jh_category_landing';

    protected function _construct()
    {
        parent::_construct();
        $this->_layoutHandles['jh_category_landing'] = self::LANDING_CATEGORY_LAYOUT_HANDLE;
        $this->_specificEntitiesLayoutHandles['jh_category_landing'] = self::SINGLE_CATEGORY_LAYOUT_HANDLE;
    }
}
