<?php

namespace Jh\LandingCategories\Model\Widget;

use Jh\LandingCategories\Model\Config\Data as LandingCategoryData;
use Magento\Catalog\Model\Product\Type;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Escaper;
use Magento\Framework\Filesystem;
use Magento\Framework\Math\Random;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\FileSystem as ViewFileSystemAlias;
use Magento\Widget\Helper\Conditions;
use Magento\Widget\Model\Config\Reader;
use Magento\Widget\Model\NamespaceResolver;
use Magento\Widget\Model\Widget;
use Magento\Widget\Model\Widget\Instance as WidgetInstance;

/**
 * @author Diego Cabrejas <diego@wearejh.com>
 */
class Instance extends WidgetInstance
{
    /**
     * @var LandingCategoryData
     */
    private $landingCategoryData;

    public function __construct(
        Context $context,
        Registry $registry,
        Escaper $escaper,
        ViewFileSystemAlias $viewFileSystem,
        TypeListInterface $cacheTypeList,
        Type $productType,
        Reader $reader,
        Widget $widgetModel,
        NamespaceResolver $namespaceResolver,
        Random $mathRandom,
        Filesystem $filesystem,
        Conditions $conditionsHelper,
        LandingCategoryData $landingCategoryData,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
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
