Ubersmith API layer
MIT Licensed

Basically what I intend to do here is make a nice layer for Ubersmith's 2.0 API, as the example shipped with the software is lacking in readability.

```php
<?
$api = new Ubersmith('http://192.168.0.10/api/', 'apiuser', 'apiuser');
$result = $api->list_services('{ "clientid": 1001 }')->response();
var_dump($result);
```

The example result will more or less be a passthrough from the 2.0 API, it's just the actual implementation stuff above that I want to make easier.
```plain
{
"status":true,
"error_no":null,
"error_msg":"",
"data": "api_data (serialised)"
}
```
