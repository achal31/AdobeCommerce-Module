<?php
namespace Vendor\ApiGetProductDetailModule\Model\Api\Data;

use Magento\Framework\DataObject;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductResponseInterface;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterface;

class RelatedProductResponse extends DataObject implements RelatedProductResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSuccess()
    {
        return $this->getData(RelatedProductResponseInterface::SUCCESS);
    }

    /**
     * {@inheritdoc}
     */
    public function setSuccess($success)
    {
        return $this->setData(RelatedProductResponseInterface::SUCCESS, $success);
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->getData(RelatedProductResponseInterface::MESSAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setMessage($message)
    {
        return $this->setData(RelatedProductResponseInterface::MESSAGE, $message);
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseData()
    {
        return $this->getData(RelatedProductResponseInterface::DATA);
    }

    /**
     * {@inheritdoc}
     */
    public function setResponseData(\Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterface $data)
    {
        return $this->setData(RelatedProductResponseInterface::DATA, $data);
    }
}
