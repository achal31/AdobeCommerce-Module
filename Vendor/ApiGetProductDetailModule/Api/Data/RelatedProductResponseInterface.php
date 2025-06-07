<?php
namespace Vendor\ApiGetProductDetailModule\Api\Data;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterface;

interface RelatedProductResponseInterface
{
    public const SUCCESS = 'success';

    public const MESSAGE = 'message';

    public const DATA = 'data';


    /**
     * getSuccess
     *
     * @return string
     */
    public function getSuccess();

    /**
     * setSuccess
     *
     * @param  string $success
     * @return $this
     */
    public function setSuccess($success);

    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage();

    /**
     * setMessage
     *
     * @param  string $message
     * @return $this
     */
    public function setMessage($message);

    /**
     * getData
     * 
     * @return \Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterface|null
     */
    public function getResponseData();

    /**
     * setData
     * 
     * @param \Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterface $data
     * @return $this
     */
    public function setResponseData(\Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterface $data);
}
