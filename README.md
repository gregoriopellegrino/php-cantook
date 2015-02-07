# php-cantook
A PHP wrapper for Cantook (and Edigita) API for ebook sales. API specifications: http://help.cantook.net/support/solutions/articles/4000034849-the-web-services#2

## Installing
You can install throu Composer. Simply add "gregoriopellegrino/php-cantook" in your composer.json file like below.
```json
{
    "require": {
        "nategood/httpful": "*"
    }
}
```

## Using
You can find some code in the file test/test.php.

### Simulate a sale
```php
$platform = new Platform("https://edigita.cantook.net", "username", "password", 310);
$publication = new Publication("9788874028047", "epub", 2.99, "none");
$response = $platform->callService("simulation", $publication);
```

### Sale
```php
$platform = new Platform("https://edigita.cantook.net", "username", "password", 310);
$publication = new Publication("9788874028047", "epub", 2.99, "none");
$transaction = new Transaction("123456", "123456", "Gregorio Pellegrino");
$transaction->sale_state = "test";
$response = $platform->callService("sale", $publication, $transaction);
```

### Download
```php
$platform = new Platform("https://edigita.cantook.net", "username", "password", 310);
$publication = new Publication("9788874028047", "epub", 2.99, "none");
$transaction = new Transaction("123456", "123456", "Gregorio Pellegrino");
$transaction->sale_state = "test";
$response = $platform->callService("download", $publication, $transaction);
```

### Response structure
```
array(3) {
  ["url"]=> "https://edigita.cantook.net/api/organisations/..." // the requested url
  ["code"]=> 200												// the response code
  ["response"]=> "success"										// the response message
}
```