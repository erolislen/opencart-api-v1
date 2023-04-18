

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
| `country_id` | `string`| This endpoint returns a list of all the zones for the specified country.     |


#### Get Currency Details by Code or List of Currencies

```http
  GET /api/rest/localisation/getCurrencyByCode
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `code`       | `string`| This endpoint returns the details of the currency with the specified code.     |

#### Get List of Currencies

```http
  GET /api/rest/localisation/getCurrencies
```


| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `status` `orderby` `sort` `limit`| `string` | This endpoint returns a list of all the currencies in the store.|


#### Get Language Details

```http
  GET /api/rest/localisation/getLanguage
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `code`       | `string`| This endpoint returns the details of the language with the specified code.

#### Get List of Languages

```http
  GET /api/rest/localisation/getLanguages
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `status` `orderby` `sort` `limit`| `string` | This endpoint returns a list of all the languages in the store.|


#### Get Order Status Details by ID or List of Order Statuses

```http
  GET /api/rest/localisation/getOrderStatus
```

| Parameter   | Type     | Description                |
| :--------   | :------- | :------------------------- |
| `order_status_id`| `string`| This endpoint returns the details of the order status with the specified ID.


#### Get List of Order Statuses

```http
  GET /api/rest/localisation/getOrderStatuses
```

This endpoint returns a list of all the order statuses in the store.
