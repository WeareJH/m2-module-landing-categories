<?php

namespace Jh\LandingCategories\Observer\Layout;

use Jh\LandingCategories\Plugin\Category\Attribute\Source\ModePlugin;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Registry;

/**
 * @author Diego Cabrejas <diego@wearejh.com>
 */
class LoadBeforeObserver implements ObserverInterface
{
    const LANDING_CATEGORY_LAYOUT_HANDLE = 'jh_category_landing';

    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var \Jh\LandingCategories\Model\Config\Data
     */
    private $categoryData;

    public function __construct(
        Registry $registry,
        \Jh\LandingCategories\Model\Config\Data $categoryData
    )
    {
        $this->registry = $registry;
        $this->categoryData = $categoryData;
    }

    /**
     * Add custom layout handle for landing categories
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();

        if ('catalog_category_view' !== $event->getFullActionName()) {
            return;
        }

        if (empty($this->registry->registry('current_category'))) {
            return;
        }

        $displayMode = $this->getCustomLayoutHandle();

        if ($displayMode === null) {
            return;
        }

        $event->getLayout()->getUpdate()->addHandle($displayMode['layout']);
    }

    protected function getCustomLayoutHandle()
    {
        $currentCategory = $this->registry->registry('current_category');
        $displayMode = $currentCategory->getDisplayMode();
        $categoryData = $this->categoryData->get();

        foreach ($categoryData as $key => $value) {
            if ($value["name"] === $displayMode) {
                return $value;
            }
        }
        return null;

    }
}
