# Changelog

All Notable changes to `digipolisgent/toerismevlaanderen-lodging` package.

## [2.0.0]

### Added

- Add PHP 8.x support.
- Add qa-php to validate code quality.

### Updated

- Update digipolisgent/api-client to 3.x
- Update digipolisgent/value to 3.x.

### Changed

- Change minimal PHP version to 7.4.

## [1.0.0]

First stable release of the `digipolisgent/toerismevlaanderen-lodging` package.

### Changed

* Made this package open source.

## [0.2.5]

### Added

* VG-1966: Added support for letter ratings.

## [0.2.4]

### Fixed

* VG-1878: Reverted validating and ignoring phone numbers.

## [0.2.3]

### Fixed

* VG-1878: Fixed validating and ignoring invalid phone numbers.

## [0.2.2]

### Fixed

* VG-1836: Fixed wrong order of concatenated data.

## [0.2.1]

### Fixed

* VG-1803: Fixed image URL scheme.
* VG-1803: Fixed website URL of addresses with bad data.

## [0.2.0]

### Added

* VG-1660: Added Grumphp to run quality checks.

### Changed

* VG-1660: Replaced the single phone number, email address, website address by
  collections.
* VG-1660: Replaced star ratings by rating interface: the returned rating value
  can also be a category rating or can be empty.

### Fixed

* VG-1660: Fixed the lodging details query.

## [0.1.0]

Initial package.

### Added

* Added getting the number of lodgings by given filters.
* Added getting a list of lodgings by given filters.
* Added getting the details of a single lodging.

[2.0.0]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/1.0.0...2.0.0
[1.0.0]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/0.2.5...1.0.0
[0.2.5]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/0.2.4...0.2.5
[0.2.4]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/0.2.3...0.2.4
[0.2.3]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/0.2.2...0.2.3
[0.2.2]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/0.2.1...0.2.2
[0.2.1]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/releases/tag/0.1.0
[Unreleased]: https://github.com/district09/php_package_dg-toerismevlaanderen-lodging/compare/main...develop
