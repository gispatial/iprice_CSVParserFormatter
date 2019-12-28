# <img src="https://github.com/gispatial/iprice_CSVParserFormatter/blob/master/src/ip.png" width="12%"> ⚡ Laravel CLI CSV Parser/ Formatter.

> 2 approaches to consider:
>
> **DOM loading**: loads all the document, making it easy to navigate and parse, and as such provides maximum flexibility for contributors.
>
> **Streaming**: implies iterating through the document, acts like a cursor and stops at each element in its way, thus avoiding memory overkill.
>

All big files, callbacks will be executed in downloading manner and will be much more efficient with less memory leaks.

## Installation
```
composer require gispatial/iprice_CSVParserFormatter
```

## Recommended usage
Please delegate as possible the callback execution for the document reading:

(Laravel Queue based example)
```php
use Tightenco\Collect\Support\Collection;

StreamParser::xml("https://example.com/users.xml")->each(function(Collection $user){
    dispatch(new App\Jobs\SendEmail($user));
});
```

## Practical Input/Code/Output Samples

### XML
```xml
<hello_world>
    <book ISBN="10-000000-001">
        <title>HELLO WORLD</title>
        <comments>
                hElLo wOrLd
            </userComment>
        </comments>
    </book>
    [...]
</hello_world>
```
```php
use Tightenco\Collect\Support\Collection;

StreamParser::xml("https://example.com/hello_world.xml")->each(function(Collection $hello_world){
    var_dump($hello_world);
    var_dump($hello_world->get('output')->toArray());
});
```
```
class Tightenco\Collect\Support\Collection#19 (1) {
  protected $items =>
  array(4) {
    'ISBN' =>
    string(13) "10-000000-001"
    'title' =>
    string(25) "HELLO WORLD"
    'output' =>
    string(27) "hElLo wOrLd"
  }
}
```

### JSON
```json
[
  {
    "title": "HELLO WORLD",
    "output": [
      {"output": "hElLo wOrLd"}
    ]
  }
]
```
```php
use Tightenco\Collect\Support\Collection;

StreamParser::json("https://example.com/hello_world.json")->each(function(Collection $hello_world){
    var_dump($hello_world->get('output')->count());
});
```
```
int(2)
int(2)
```
### CSV
```csv
title,output
HELLO WORLD,"hElLo wOrLd"
CSV created! or generated to be exact!"
```
```php
use Tightenco\Collect\Support\Collection;

StreamParser::csv("https://example.com/hello_world.csv")->each(function(Collection $hello_world){
    var_dump($hello_world->get('output')->last());
});
```
```
string(29) "HELLO WORLD"
string(39) "hElLo wOrLd"
```

## Assessment done by JustEd @ R. Aidy
