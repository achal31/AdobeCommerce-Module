<?php

namespace Vendor\ApiGetProductDetailModule\Model\Api;

use Vendor\ApiGetProductDetailModule\Api\RelatedProductInterface;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductItemInterfaceFactory;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterfaceFactory;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductResponseInterfaceFactory;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductResponseInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Product\Media\Config as MediaConfig;

class RelatedProduct implements RelatedProductInterface
{
    /**
     * Constructor
     *
     * @param ProductRepositoryInterface $productRepository
     * @param RelatedProductItemInterfaceFactory $itemFactory
     * @param RelatedProductDataInterfaceFactory $dataFactory
     * @param RelatedProductResponseInterfaceFactory $responseFactory
     * @param ProductCollectionFactory $productCollectionFactory
     * @param CategoryRepositoryInterface $categoryRepository
     * @param MediaConfig $mediaConfig
     */
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected RelatedProductItemInterfaceFactory $itemFactory,
        protected RelatedProductDataInterfaceFactory $dataFactory,
        protected RelatedProductResponseInterfaceFactory $responseFactory,
        protected ProductCollectionFactory $productCollectionFactory,
        protected CategoryRepositoryInterface $categoryRepository,
        protected MediaConfig $mediaConfig
    ) {
    }

    /**
     * Get products from the same category
     *
     * @param string $sku
     * @return RelatedProductResponseInterface
     */
    public function getRelatedProducts(string $sku): RelatedProductResponseInterface
    {
        try {
            $product = $this->productRepository->get($sku);
            $categoryIds = $product->getCategoryIds();

            $relatedItems = [];

            if (!empty($categoryIds)) {
                // Use first category to find similar products
                $category = $this->categoryRepository->get($categoryIds[0]);

                $collection = $this->productCollectionFactory->create();
                $collection->addAttributeToSelect(['name', 'price', 'small_image', 'sku'])
                           ->addCategoryFilter($category)
                           ->addFieldToFilter('entity_id', ['neq' => $product->getId()])
                           ->setPageSize(10)
                           ->setCurPage(1);

                foreach ($collection as $relatedProduct) {
                    $item = $this->itemFactory->create();
                    $item->setId($relatedProduct->getId());
                    $item->setSku($relatedProduct->getSku());
                    $item->setName($relatedProduct->getName());
                    $item->setPrice((float)$relatedProduct->getPrice());
                    $item->setThumbnail($this->mediaConfig->getMediaUrl($relatedProduct->getSmallImage()));

                    $relatedItems[] = $item;
                }
            }

            $data = $this->dataFactory->create();
            $data->setSku($sku);
            $data->setRelatedProducts($relatedItems);

            $response = $this->responseFactory->create();
            $response->setSuccess(true);
            $response->setMessage('Similar category products fetched successfully.');
            $response->setResponseData($data);

            return $response;

        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $response = $this->responseFactory->create();
            $response->setSuccess(false);
            $response->setMessage("Product with SKU '{$sku}' not found.");
            $response->setResponseData(null);
            return $response;

        } catch (\Exception $e) {
            $response = $this->responseFactory->create();
            $response->setSuccess(false);
            $response->setMessage("An error occurred: " . $e->getMessage());
            $response->setResponseData(null);
            return $response;
        }
    }
}
