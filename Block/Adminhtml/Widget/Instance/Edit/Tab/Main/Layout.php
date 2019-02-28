<?php

namespace Jh\LandingCategories\Block\Adminhtml\Widget\Instance\Edit\Tab\Main;

use Jh\LandingCategories\Model\Config\Data as LandingCategoryData;
use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\Product\Type;
use Magento\Framework\Phrase;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Widget\Block\Adminhtml\Widget\Instance\Edit\Tab\Main\Layout as MainLayout;

/**
 * @author Diego Cabrejas <diego@wearejh.com>
 */
class Layout extends MainLayout
{
    protected $_template = 'Magento_Widget::instance/edit/layout.phtml';
    /**
     * @var LandingCategoryData
     */
    private $landingCategoryData;

    public function __construct(
        Context $context,
        Type $productType,
        LandingCategoryData $landingCategoryData,
        array $data = [],
        Json $serializer = null
    )
    {
        parent::__construct($context, $productType, $data, $serializer);
        $this->landingCategoryData = $landingCategoryData;
    }

    /**
     * Extended to add the jh_category_landing option.
     * This allows the user to place widgets only on landing categories.
     *
     * @return array
     */
    protected function _getDisplayOnOptions()
    {
        $options = parent::_getDisplayOnOptions();
        $match = __('Categories')->getText();

        foreach ($options as &$option) {

            if (!($option['label'] instanceof Phrase)) {
                continue;
            }

            if ($option['label']->getText() === $match) {
                $newOptions = [];
                foreach ($this->landingCategoryData->get() as $landingData) {
                    $newOptions[] = [
                        'value' => $landingData['name'],
                        'label' => $this->escapeJs(__($landingData['label']))
                    ];
                }
                $beforeOptions = $option['value'];
                $option['value'] = \array_merge($newOptions, $beforeOptions);
            }

        }
        return $options;
    }

    /**
     * @return array
     */
    public function getDisplayOnContainers()
    {
        $container = parent::getDisplayOnContainers();
        $landingCategoryData = $this->landingCategoryData->get();

        foreach ($landingCategoryData as $data) {
            $container[$data['name']] = [
                'label' => 'Categories',
                'code' => 'categories',
                'name' => $data['layout'],
                'layout_handle' => $data['layout'],
                'is_anchor_only' => 0,
                'product_type_id' => '',
            ];
        }
        return $container;
    }
}
