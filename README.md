### DNGO Book Cover Creator

Usage;

First install package via composer;

```
composer require dngo-io/cover-dreator
```


Sample code;
> To use this package, you need to install [PHP GD](http://php.net/manual/en/book.image.php) library to server

```php
require ("vendor/autoload.php");


use DngoIO\CoverCreator\Generator;

$selectors = [
        'font-size' => 18,  //px
        'font-type' => __DIR__ . '../assets/Roboto-Regular.ttf', //path of ttf file on server
        'text-color' => [61,183,228],
        'left' => 0,
        'top' => 0,
        'background-url' => __DIR__ . '../assets/background.jpg' //path of the png
    ];


try {
    $generator = new Generator("My Text On Image", $selectors);
    $generator->generate();
}catch (\Exception $e) {
    echo $e->getMessage();
}

```


#### Available Selector Values

|  Name |  Value  |   Description |
|-------|---------|---------------|
|  font-size |  integer | Font size  in px. Only integer values |
|  font-type |  file    | Font file on the server. Exact path and file name. |
|  text-color |  array |  text color as RGB |
|  left |  integer |  Margin Left value of text |
|  top |  integer |  Margin Top value of text |
|  background-url |  file |  Backgroun file on the server. Exact path and file name. Should be PNG or JPG |


### Availabile Config Values
the ``Generator`` class takes third parameter as configs.

| Name | Value  | Description |
|------|--------|-------------|
|   auto-center   |  bool  | Enable text center on image |
|   angle   | integer |Angle of the text on image |
|   header  | string | default value of header when image generated. default is  ``Content-type: image/jpeg`` |


### Error Handling

CoverCreator has 2 exceptions.
`` InvalidFileException`` is thrown when the background image is not ok.
``InvalidTypeException`` is thrown when any of selector value is not valid.
