
## API Endpoints for Localisation

The following API endpoints are available for managing localisation related data:

#### Get Country Details or List of Countries

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

Mağazadaki tüm ülkelerin listesini döndürür.

#### Get Zone Details or List of Zones

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

This endpoint returns a list of all the currencies in the store.

#### Get Language Details by Code or List of Languages

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

This endpoint returns a list of all the languages in the store.

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
