Ubersmith API layer
MIT Licensed

```php
<?
$api = new Ubersmith('http://192.168.0.10/api/', 'apiuser', 'apiuser');
$result = $api->list_services('{ "clientid": 1001 }')->response();
var_dump($result);
```
