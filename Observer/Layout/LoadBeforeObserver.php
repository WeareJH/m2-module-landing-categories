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

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
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

        if (ModePlugin::DM_LANDING !== $this->registry->registry('current_category')->getDisplayMode()) {
            return;
        }

        $event->getLayout()->getUpdate()->addHandle(self::LANDING_CATEGORY_LAYOUT_HANDLE);
    }
}
