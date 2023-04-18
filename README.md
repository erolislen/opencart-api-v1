

## API Endpoints for Category

The following API endpoints are available for managing category related data:

#### Get Category Details

```http
  GET /api/rest/category
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `category_id`| `string` | Belirtilen kategori ID'sine sahip kategorinin ayrıntılarını alır. |

#### Get List of Categories

```http
  GET /api/rest/categories
```


| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `status` `orderby` `sort` `limit`| `string` | Mağazadaki tüm kategorilerin listesini alır.|



#### Deleting Category Data

```http
  DELETE /api/rest/category
```

| Parameter    | Type     | Description                |
| :--------    | :------- | :------------------------- |
| `category_id`| `string` | Belirtilen kategori ID'sine sahip kategoriyi siler.      |



## API Endpoints for Customer

The following API endpoints are available for managing customer related data:

#### Get Customer Details

```http
  GET /api/rest/customer
```

| Parameter    | Type     | Description                |
| :--------    | :------- | :------------------------- |
| `customer_id`| `string` | Belirtilen müşteri ID'sine sahip müşterinin ayrıntılarını alır.|

#### Get Customer By Email

```http
  GET api/rest/customer/getCustomerByEmail
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `email`     | `string` | Mağazadaki tüm müşterilerin listesini alır.|


#### Get Customers

```http
  GET api/rest/customer/getCustomers
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `status` `orderby` `sort` `limit`| `string` | Belirtilen e-posta adresine sahip müşterinin ayrıntılarını alır.|

#### Delete Customer

```http
  DELETE /api/rest/customer/deleteCustomer
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `customer_id`| `string` | Belirtilen müşteri ID'sine sahip müşteriyi siler.    |

#### Get Customer Group Details

```http
  GET /api/rest/customer/getCustomerGroup
```

| Parameter    | Type     | Description                |
| :--------    | :------- | :------------------------- |
| `customer_group_id`| `string` | Belirtilen müşteri grubu ID'sine sahip müşteri grubunun ayrıntılarını alır.|

#### Get Customer Groups

```http
  GET api/rest/customer/getCustomerGroups
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `orderby` `sort` `limit`| `string` | Mağazadaki tüm müşteri gruplarının listesini alır.|


## API Endpoints for Localisation

The following API endpoints are available for managing localisation related data:

#### Get Country Details

```http
  GET /api/rest/localisation/getCountry
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `country_id`| `string` | Belirtilen ülke ID'sine sahip ülkenin ayrıntılarını alır  |

#### Get List of Countries

```http
  GET /api/rest/localisation/getCountries
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `status` `orderby` `sort` `limit`| `string` | Mağazadaki tüm ülkelerin listesini döndürür.|


#### Get Zone Details
```http
  GET /api/rest/localisation/getZone
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `zone_id`    | `string` | Belirtilen bölge ID'sine sahip bölgenin ayrıntılarını alır      |

#### Get List of Zones for a Country

```http
  GET /api/rest/localisation/getZonesByCountryId
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `country_id` | `string`| Belirtilen ülke ID'sine sahip tüm bölgelerin listesini döndürür.     |


#### Get Currency Details by Code or List of Currencies

```http
  GET /api/rest/localisation/getCurrencyByCode
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `code`       | `string`| Belirtilen para birimi koduna sahip para biriminin ayrıntılarını alır.   |

#### Get List of Currencies

```http
  GET /api/rest/localisation/getCurrencies
```


| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `status` `orderby` `sort` `limit`| `string` | 	Mağazadaki tüm para birimlerinin listesini döndürür.|


#### Get Language Details

```http
  GET /api/rest/localisation/getLanguage
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `code`       | `string`| Belirtilen dil koduna sahip dilin ayrıntılarını alır.

#### Get List of Languages

```http
  GET /api/rest/localisation/getLanguages
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `status` `orderby` `sort` `limit`| `string` | Mağazadaki tüm dillerin listesini döndürür.|


#### Get Order Status Details by ID or List of Order Statuses

```http
  GET /api/rest/localisation/getOrderStatus
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `order_status_id`| `string`| Belirtilen sipariş durumu ID'sine sahip sipariş durumunun ayrıntılarını alır.|


#### Get List of Order Statuses

```http
  GET /api/rest/localisation/getOrderStatuses
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `language_id` `orderby` `sort` `limit`| `string` | Mağazadaki tüm sipariş durumlarının listesini döndürür.|

 

## API Endpoints for Manufacturer

The following API endpoints are available for managing manufacturer related data:

#### Get Manufacturer Details

```http
  GET /api/rest/manufacturer/getManufacturer
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `manufacturer_id`| `string` | Belirtilen üretici ID'sine sahip üreticinin ayrıntılarını alır.  |

#### Get List of Manufacturers

```http
  GET /api/rest/manufacturer/getManufacturers
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `status` `orderby` `sort` `limit`| `string` | Mağazadaki tüm üreticilerin listesini alır.|


#### Get Total Manufacturers
```http
  GET /api/rest/manufacturer/getTotalManufacturers
```

Mağazadaki tüm üreticilerin toplam sayısını döndürür.

#### Get List of Zones for a Country

```http
  DELETE /api/rest/manufacturer/deleteManufacturer
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `manufacturer_id` | `string`| Belirtilen üretici ID'sine sahip üreticiyi siler.     |


## API Endpoints for Order

The following API endpoints are available for managing order related data:

#### Get Order Details

```http
  GET /api/rest/order/getOrder
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `order_id`| `string` | Retrieves the details of the specified order.  |

#### Get List of Orders

```http
  GET /api/rest/order/getOrders
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `order_status` `orderby` `sort` `limit` `start_date` `end_date`|  `string` | Retrieves a list of all orders in the store..|


#### Get Order Products
```http
  GET /api/rest/order/getOrderProducts
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `order_id`| `string` | Retrieves the products associated with the specified order.  |

#### Get Order Options

```http
  GET /api/rest/order/getOrderOptions
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `order_id` `order_product_id` | `string`| Retrieves the options associated with the specified order.   |


#### Get Order Totals
```http
  GET /api/rest/order/getOrderTotals
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `order_id`| `string` | Retrieves the totals associated with the specified order.  |

#### Delete Order
```http
  DELETE /api/rest/order/deleteOrder
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `order_id`| `string` | Deletes the specified order. |
