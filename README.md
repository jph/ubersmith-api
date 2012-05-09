Ubersmith API layer
MIT Licensed

```php
 $api = new Ubersmith('http://27.131.77.74/api/', 'apiuser', 'apiuser');
 $result = $api->list_services('{ "clientid": 1001 }')->response();
 var_dump($result);
```
