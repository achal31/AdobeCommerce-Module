<?php
namespace Vendor\ApiGetProductDetailModule\Api\Data;

interface RelatedProductItemInterface
{
    public const ID = 'id';

    public const SKU = 'sku';

    public const NAME = 'name';

    public const PRICE = 'price';

    public const THUMBNAIL = 'thumbnail';
    
    /**
     * getId
     *
     * @return string
     */
    public function getId();

    /**
     * setId
     *
     * @param  string $id
     * @return $this
     */
    public function setId($id);

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
     * getName
     *
     * @return string
     */
    public function getName();

    /**
     * setName
     *
     * @param  string $name
     * @return $this
     */
    public function setName($name);


    /**
     * getPrice
     *
     * @return string
     */
    public function getPrice();

    /**
     * setPrice
     *
     * @param  string $price
     * @return $this
     */
    public function setPrice($price);


    /**
     * getThumbnail
     *
     * @return string
     */
    public function getThumbnail();

    /**
     * setThumbnail
     *
     * @param  string $thumbnail
     * @return $this
     */
    public function setThumbnail($thumbnail);

}
