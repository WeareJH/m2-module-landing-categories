<?php

namespace Jh\LandingCategories\Model\Widget;

use Jh\LandingCategories\Model\Config\Data;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Widget\Model\Widget\Instance as WidgetInstance;

/**
 * @author Diego Cabrejas <diego@wearejh.com>
 */
class Instance extends WidgetInstance
{
    const LANDING_CATEGORY_LAYOUT_HANDLE = 'jh_category_landing';
    /**
     * @var Data
     */
    private $landingCategoryData;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Escaper $escaper,
        \Magento\Framework\View\FileSystem $viewFileSystem,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Catalog\Model\Product\Type $productType,
        \Magento\Widget\Model\Config\Reader $reader,
        \Magento\Widget\Model\Widget $widgetModel,
        \Magento\Widget\Model\NamespaceResolver $namespaceResolver,
        \Magento\Framework\Math\Random $mathRandom,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Widget\Helper\Conditions $conditionsHelper,
        \Jh\LandingCategories\Model\Config\Data $landingCategoryData,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $relatedCacheTypes = [],
        array $data = [],
        Json $serializer = null
    )
    {
        $this->landingCategoryData = $landingCategoryData;

        parent::__construct(
            $context, $registry, $escaper, $viewFileSystem, $cacheTypeList, $productType, $reader, $widgetModel,
            $namespaceResolver, $mathRandom, $filesystem, $conditionsHelper, $resource, $resourceCollection,
            $relatedCacheTypes, $data, $serializer
        );
    }

    protected function _construct()
    {
        parent::_construct();

        $landingCategoryData = $this->landingCategoryData->get();

        foreach ($landingCategoryData as $data) {
            $this->_layoutHandles[$data['layout']] = $data['layout'];
            $this->_specificEntitiesLayoutHandles[$data['layout']] = self::SINGLE_CATEGORY_LAYOUT_HANDLE;
        }


    }
}
