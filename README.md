# Digipolis - Toerismevlaanderen Lodging

This package integrates with the [Toerismevlaanderen Lodging][tv.lodging] linked
open data [SPARQL endpoint][tv.lodging.sparql].

It also contains the value objects representing the returned data.

## Install

Add the package repository to composer.json:

``` json
{
    ...
    "repositories": [
        ...
        {
            "type": "composer",
            "url": "https://packagist.gentgrp.gent.be"
        },
        ...
    ],
    ...
}
```

Install the package:

```bash
composer require digipolis/toerismevlaanderen-lodging
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed
recently.

## Testing

Run the test suite:

``` bash
vendor/bin/phpunit
```

## Examples

See the [examples](examples) directory how to use the service wrappers.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more
information.

[tv.lodging]: https://data.toerismevlaanderen.be/linked-data-gebruik
[tv.lodging.sparql]: https://linked.toerismevlaanderen.be/sparql
