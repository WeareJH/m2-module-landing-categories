<?php

namespace Jh\LandingCategories\Model\Config;

use Magento\Framework\Config\SchemaLocatorInterface;
use Magento\Framework\Module\Dir;
use Magento\Framework\Module\Dir\Reader;

class SchemaLocator implements SchemaLocatorInterface
{
    /**
     * Get path to merged config schema
     *
     * @return string|null
     */
    protected $_schema = null;

    public function __construct(Reader $moduleReader)
    {
        $this->_schema = $moduleReader->getModuleDir(Dir::MODULE_ETC_DIR, 'Jh_LandingCategories') . DIRECTORY_SEPARATOR . 'landing_categories.xsd';
    }

    public function getSchema()
    {
        return $this->_schema;
    }

    /**
     * Get path to per file validation schema
     *
     * @return string|null
     */
    public function getPerFileSchema()
    {
        return null;
    }
}
