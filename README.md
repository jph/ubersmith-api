Ubersmith API layer
===================

Copyright (c) 2014 James Hynes

For full license details see LICENSE

What I've intended to do here is make a nice layer for Ubersmith's 2.0 API, as the example shipped with the software is lacking in readability. As of recent changes, the URI scheme must now be specified bby the user. This allows for use over http or https.

```php
<?php
require 'ubersmith.php';

$api = new Ubersmith('http://1.2.3.4', 'apiuser', 'apiuser');
$args = [ 'client_id' => 1001 ];
$api->client_service_list(json_encode($args))->execute(); # executes client.service_list
print_r($api->result());
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
