<?php

namespace Vendor\ApiGetProductDetailModule\Test\Unit\Model\Api;

use PHPUnit\Framework\TestCase;
use Vendor\ApiGetProductDetailModule\Model\Api\RelatedProduct;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductItemInterfaceFactory;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterfaceFactory;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductResponseInterfaceFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Product\Media\Config as MediaConfig;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductItemInterface;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductDataInterface;
use Vendor\ApiGetProductDetailModule\Api\Data\RelatedProductResponseInterface;

class RelatedProductTest extends TestCase
{
    public function testGetRelatedProductsReturnsSuccessResponse()
    {
        $sku = '217387240';

        // Mock dependencies
        $productRepository = $this->createMock(ProductRepositoryInterface::class);
        $itemFactory = $this->createMock(RelatedProductItemInterfaceFactory::class);
        $dataFactory = $this->createMock(RelatedProductDataInterfaceFactory::class);
        $responseFactory = $this->createMock(RelatedProductResponseInterfaceFactory::class);
        $productCollectionFactory = $this->createMock(ProductCollectionFactory::class);
        $categoryRepository = $this->createMock(CategoryRepositoryInterface::class);
        $mediaConfig = $this->createMock(MediaConfig::class);

        // Mock product returned by repository
        $product = $this->getMockBuilder(Product::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getCategoryIds', 'getId'])
            ->getMock();
        $product->method('getCategoryIds')->willReturn([1]);
        $product->method('getId')->willReturn(10);
        $productRepository->method('get')->with($sku)->willReturn($product);

        // Mock category
        $category = $this->getMockBuilder(\Magento\Catalog\Model\Category::class)
            ->disableOriginalConstructor()
            ->getMock();
        $categoryRepository->method('get')->with(1)->willReturn($category);

        // Mock product collection
        $collection = $this->createMock(Collection::class);
        $productCollectionFactory->method('create')->willReturn($collection);
        $collection->method('addAttributeToSelect')->willReturnSelf();
        $collection->method('addCategoryFilter')->willReturnSelf();
        $collection->method('addFieldToFilter')->willReturnSelf();
        $collection->method('setPageSize')->willReturnSelf();
        $collection->method('setCurPage')->willReturnSelf();

        // Related product mock
        $relatedProduct = $this->getMockBuilder(Product::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId', 'getSku', 'getName', 'getPrice', 'getData'])
            ->getMock();
        $relatedProduct->method('getId')->willReturn(1979);
        $relatedProduct->method('getSku')->willReturn('217428238');
        $relatedProduct->method('getName')->willReturn('Disney Celebration Train');
        $relatedProduct->method('getPrice')->willReturn(209);
        $relatedProduct->method('getData')->with('small_image')->willReturn('4/3/43212_P1.jpg');

        $mediaConfig->method('getMediaUrl')->with('4/3/43212_P1.jpg')->willReturn('http://local.legoweb.com/media/catalog/product/4/3/43212_P1.jpg');
        $collection->method('getIterator')->willReturn(new \ArrayIterator([$relatedProduct]));

        // Related item setup
        $item = $this->createMock(RelatedProductItemInterface::class);
        $itemFactory->method('create')->willReturn($item);
        $item->method('setId')->willReturnSelf();
        $item->method('setSku')->willReturnSelf();
        $item->method('setName')->willReturnSelf();
        $item->method('setPrice')->willReturnSelf();
        $item->method('setThumbnail')->willReturnSelf();

        // Response data
        $data = $this->createMock(RelatedProductDataInterface::class);
        $dataFactory->method('create')->willReturn($data);
        $data->method('setSku')->willReturnSelf();
        $data->method('setRelatedProducts')->willReturnSelf();

        // Response wrapper
        $response = $this->createMock(RelatedProductResponseInterface::class);
        $responseFactory->method('create')->willReturn($response);
        $response->method('setSuccess')->with(true)->willReturnSelf();
        $response->method('setMessage')->with('Similar category products fetched successfully.')->willReturnSelf();
        $response->method('setResponseData')->with($data)->willReturnSelf();

        // Instantiate class under test
        $model = new RelatedProduct(
            $productRepository,
            $itemFactory,
            $dataFactory,
            $responseFactory,
            $productCollectionFactory,
            $categoryRepository,
            $mediaConfig
        );

        // Call method
        $result = $model->getRelatedProducts($sku);

        // Assert
        $this->assertSame($response, $result);
    }
}
