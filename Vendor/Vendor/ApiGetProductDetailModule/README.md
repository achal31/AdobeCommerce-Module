# 📦 Magento 2 Related Products API Module

This Magento 2 module provides an API to fetch **related products** based on a given product SKU. It retrieves products from the **same category**, excluding the current product, and limits the result to **10 items**.

---

## 🔧 Installation

1. Place the module in the path:  
   `app/code/Vendor/ApiGetProductDetailModule`

2. Run the following Magento setup commands:

```bash
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
```

---

## 🔗 API Endpoint

**GET** `/rest/V1/related-products/:sku`

Fetch up to 10 related products from the same category.

---

## 📥 Request Details

### 🔸 Path Parameter:

| Parameter | Type   | Required | Description                         |
|-----------|--------|----------|-------------------------------------|
| `sku`     | string | ✅       | SKU of the base product to compare. |

### 🔸 Request Headers:

```http
Content-Type: application/json
Authorization: Bearer <admin_or_customer_token>
```

### 🔸 Example Request:

```http
GET /rest/V1/related-products/217387240
```

---

## 📤 Example Successful Response

```json
{
  "success": "1",
  "message": "Similar category products fetched successfully.",
  "response_data": {
    "sku": "217387240",
    "related_products": [
      {
        "id": "1979",
        "sku": "217428238",
        "name": "Disney Celebration Train",
        "price": "209",
        "thumbnail": "http://local.legoweb.com/media/catalog/product/4/3/43212_P1.jpg"
      },
      {
        "id": "1980",
        "sku": "217428205",
        "name": "LEGO® Iconic Chess Set",
        "price": "319",
        "thumbnail": "http://local.legoweb.com/media/catalog/product/4/0/40174_P1.jpg"
      }
      // ...up to 10 products
    ]
  }
}
```

---

## ❌ Example Error Response

```json
{
  "success": "0",
  "message": "Product not found for given SKU.",
  "response_data": []
}
```

---

## 🔐 Authentication

Magento’s built-in authentication is required. Use an **Admin Token** or **Customer Token**.

### Generate Admin Token:

```bash
POST /rest/V1/integration/admin/token
Content-Type: application/json

{
  "username": "admin",
  "password": "admin123"
}
```

Response:

```json
"eyJ0eXAiOiJKV1QiLCJhbGciOi..."
```

---

## 🧪 Unit Testing

Unit tests are located in:

```
app/code/Vendor/ApiGetProductDetailModule/Test/Unit/Model/Api/RelatedProductTest.php
```

### Run Unit Tests:

```bash
vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/Vendor/ApiGetProductDetailModule/Test/Unit/Model/Api/RelatedProductTest.php
```

