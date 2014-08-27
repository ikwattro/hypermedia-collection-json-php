# PHP Library for handling Hypermedia Collection+Json Format

! WIP Status

Link to the Collection+Json Specification : https://github.com/collection-json/spec

### Installation

Add the library to your composer.json file

```json
{
    "require": {
        // your other deps,
        "kwattro/hypermedia-collection-json": "0.1@dev"
    }
}
```

### Usage

Usage of the library is simple :

#### Create a new Collection :

```php
require_once 'vendor/autoload.php';

use Kwattro\Hypermedia\CollectionJson\Collection;

$collection = new Collection();
$collection->addHref('http://example.com/api/movies');
```

#### Add items to the collection
```php
use Kwattro\Hypermedia\CollectionJson\Collection;
use Kwattro\Hypermedia\CollectionJson\Item;

$collection = new Collection();
$item = new Item();
$item->addData(array('name' => 'John', 'city' => 'Paradise City');
$item->addHref('http://example.com/user/1234/john');
$collection->addItem($item);
```

### (De-)Serializing

In order to serialize/deserialize objects, you just need to call the Serializer create static method :

```php
use Kwattro\Hypermedia\CollectionJson\Serializer;

// $myCollection = ... creating collection and items objects

$json = Serializer::create()->serialize($myCollection); // Returns a Json representation

// Deserializing :
$myObject = Serializer::create()->deserialize($json); // Returns a Collection object
```

### Tests

The lib is using `phpspec`

#### Running the test suite

```
bin/phpspec run
```

### TO-DO

* Implementing JMS/Serializer (partially done)
* Full compliant with Hypermedia Spec
