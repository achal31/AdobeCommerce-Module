<?php
namespace Vendor\ApiGetProductDetailModule\Api\Data;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductItemInterface;

interface RelatedProductDataInterface
{
    public const SKU = 'sku';
    public const RELATED_PRODUCTS = 'related_products';

    /**
     * getSku
     *
     * @return string
     */
    public function getSku();

    /**
     * setSku
     *
     * @param  string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * getRelatedProducts
     * 
     * @return \Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductItemInterface[]
     */
    public function getRelatedProducts();

    /**
     * setRelatedProducts
     * 
     * @param \Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductItemInterface[] $relatedProducts
     * @return $this
     */
    public function setRelatedProducts(array $relatedProducts);
}
