<?php

namespace Jh\LandingCategories\Block\Adminhtml\Widget\Instance\Edit\Tab\Main;

use Magento\Widget\Block\Adminhtml\Widget\Instance\Edit\Tab\Main\Layout as MainLayout;

/**
 * @author Diego Cabrejas <diego@wearejh.com>
 */
class Layout extends MainLayout
{
    protected $_template = 'Magento_Widget::instance/edit/layout.phtml';

    /**
     * Extended to add the jh_category_landing option.
     * This allows the user to place widgets only on landing categories.
     *
     * @return array
     */
    protected function _getDisplayOnOptions()
    {
        $options = [];
        $options[] = ['value' => '', 'label' => $this->escapeJsQuote(__('-- Please Select --'))];
        $options[] = [
            'label' => __('Categories'),
            'value' => [
                ['value' => 'anchor_categories', 'label' => $this->escapeJsQuote(__('Anchor Categories'))],
                ['value' => 'notanchor_categories', 'label' => $this->escapeJsQuote(__('Non-Anchor Categories'))],
                ['value' => 'jh_category_landing', 'label' => $this->escapeJsQuote(__('Landing Categories'))],
            ],
        ];
        foreach ($this->_productType->getTypes() as $typeId => $type) {
            $productsOptions[] = [
                'value' => $typeId . '_products',
                'label' => $this->escapeJsQuote($type['label']),
            ];
        }
        array_unshift(
            $productsOptions,
            ['value' => 'all_products', 'label' => $this->escapeJsQuote(__('All Product Types'))]
        );
        $options[] = ['label' => $this->escapeJsQuote(__('Products')), 'value' => $productsOptions];
        $options[] = [
            'label' => $this->escapeJsQuote(__('Generic Pages')),
            'value' => [
                ['value' => 'all_pages', 'label' => $this->escapeJsQuote(__('All Pages'))],
                ['value' => 'pages', 'label' => $this->escapeJsQuote(__('Specified Page'))],
                ['value' => 'page_layouts', 'label' => $this->escapeJsQuote(__('Page Layouts'))],
            ],
        ];
        return $options;
    }

    /**
     * @return array
     */
    public function getDisplayOnContainers()
    {
        $container = parent::getDisplayOnContainers();
        $container['jh_category_landing'] = [
            'label' => 'Categories',
            'code' => 'categories',
            'name' => 'jh_category_landing',
            'layout_handle' => 'jh_category_landing',
            'is_anchor_only' => 0,
            'product_type_id' => '',
        ];

        return $container;
    }
}
