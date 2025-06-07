<?php
namespace Vendor\ApiGetProductDetailModule\Model\Api\Data;

use Magento\Framework\DataObject;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductItemInterface;

class RelatedProductItem extends DataObject implements RelatedProductItemInterface
{
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData(RelatedProductItemInterface::ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(RelatedProductItemInterface::ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->getData(RelatedProductItemInterface::SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        return $this->setData(RelatedProductItemInterface::SKU, $sku);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getData(RelatedProductItemInterface::NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        return $this->setData(RelatedProductItemInterface::NAME, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->getData(RelatedProductItemInterface::PRICE);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        return $this->setData(RelatedProductItemInterface::PRICE, $price);
    }

    /**
     * {@inheritdoc}
     */
    public function getThumbnail()
    {
        return $this->getData(RelatedProductItemInterface::THUMBNAIL);
    }

    /**
     * {@inheritdoc}
     */
    public function setThumbnail($thumbnail)
    {
        return $this->setData(RelatedProductItemInterface::THUMBNAIL, $thumbnail);
    }
}
