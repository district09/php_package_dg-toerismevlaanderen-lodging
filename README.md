# Digipolis - Toerismevlaanderen Lodging

This package integrates with the [Toerismevlaanderen Lodging][tv.lodging] linked
open data [SPARQL endpoint][tv.lodging.sparql].

It also contains the value objects representing the returned data.

[![Github][github-badge]][github-link]

[![Build Status Master][travis-master-badge]][travis-master-link]
[![Build Status Develop][travis-develop-badge]][travis-develop-link]
[![Maintainability][codeclimate-maint-badge]][codeclimate-maint-link]
[![Test Coverage][codeclimate-cover-badge]][codeclimate-cover-link]

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

[github-badge]: https://img.shields.io/badge/github-digipolis_toerismevlaanderen_lodging-blue.svg?logo=github
[github-link]: https://github.com/digipolisgent/drupal8_site_kuanza

[travis-master-badge]: https://travis-ci.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging.svg?token=anXPs46DEwgxP8RmJPAJ&branch=master "Travis build master"
[travis-master-link]: https://travis-ci.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging
[travis-develop-badge]: https://travis-ci.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging.svg?token=anXPs46DEwgxP8RmJPAJ&branch=develop "Travis build develop"
[travis-develop-link]: https://travis-ci.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging

[codeclimate-maint-badge]: https://api.codeclimate.com/v1/badges/c837ebbed37a47b41c38/maintainability
[codeclimate-maint-link]: https://codeclimate.com/repos/5d5d2ccb4626e0019f00d14b/maintainability
[codeclimate-cover-badge]: https://api.codeclimate.com/v1/badges/c837ebbed37a47b41c38/test_coverage
[codeclimate-cover-link]: https://codeclimate.com/repos/5d5d2ccb4626e0019f00d14b/test_coverage
