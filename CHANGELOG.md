# Changelog

All Notable changes to `digipolisgent/toerismevlaanderen-lodging` package.

## [Unreleased]

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

[0.2.2]: https://github.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging/compare/0.2.1...0.2.2
[0.2.1]: https://github.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging/releases/tag/0.1.0
[Unreleased]: https://github.com/digipolisgent/php_package_dg-toerismevlaanderen-lodging/compare/master...develop
