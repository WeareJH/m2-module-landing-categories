<?php

namespace Jh\LandingCategories\Model\Config;

use Magento\Framework\Config\ConverterInterface;

class Converter implements ConverterInterface
{
    /**
     * Convert config
     *
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $elems = $source->getElementsByTagName("view");
        $nodes = $this->convertToArray($elems);
        $views = \array_map(function (\DOMNode $node) {
            $attrs = $node->attributes;
            return [
                "name" => $attrs->getNamedItem('name')->nodeValue,
                "label" => $attrs->getNamedItem('label')->nodeValue,
                "layout" => $attrs->getNamedItem('layout')->nodeValue,
            ];

        }, $nodes);
        return $views;
    }

    private function convertToArray(\DOMNodeList $DOMNodeList)
    {
        $nodes = [];
        for ($i = 0; $i < $DOMNodeList->length; $i++) {
            $nodes[] = $DOMNodeList->item($i);
        }
        return $nodes;
    }
}