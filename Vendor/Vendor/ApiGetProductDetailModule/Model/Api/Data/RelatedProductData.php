<?php
namespace Vendor\ApiGetProductDetailModule\Model\Api\Data;

use Magento\Framework\DataObject;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterface;

class RelatedProductData extends DataObject implements RelatedProductDataInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->getData(RelatedProductDataInterface::SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        return $this->setData(RelatedProductDataInterface::SKU, $sku);
    }

    /**
     * {@inheritdoc}
     */
    public function getRelatedProducts()
    {
        return $this->getData(RelatedProductDataInterface::RELATED_PRODUCTS);
    }

    /**
     * {@inheritdoc}
     */
    public function setRelatedProducts(array $relatedProducts)
    {
        return $this->setData(RelatedProductDataInterface::RELATED_PRODUCTS, $relatedProducts);
    }
}
