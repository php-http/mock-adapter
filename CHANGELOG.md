# Change Log

## 1.6.1 - 2024-10-31

- Fix warnings with PHP 8.4. 

## 1.6.0 - 2023-05-21

### Fixed

- We actually did fallback to the legacy message factory discovery so 1.5.2 is broken.
  Changed to use PSR 17 factory discovery.
  If you allow the composer plugin of `php-http/discovery`, things will work out of the box.
  When disabled and you do not have a PSR-17 factory installed, you will need to explicitly require one, e.g. `nyholm/psr7`.

## 1.5.2 - 2023-05-17

**Broken, use 1.6.0 instead**

### Removed

- Removed dependency on `php-http/message-factory` as the mock client does not use it.

## 1.5.1 - 2023-04-30

### Added

- Allow `psr/http-message` version 2
- Build with PHP 8.1 and 8.2

## 1.5.0 - 2021-08-25

### Changed

- Provide `psr/http-client-implementation`
- Drop support for `php-http/httplug: 1.*` to be sure to implement a version of the client interface that implements the PSR.

## 1.4.1 - 2020-07-14

### Fixed

- Support PHP 7.4 and 8.0

## 1.4.0 - 2020-07-02

### Added

- Support for the PSR-17 response factory

### Changed

- Drop support for PHP 5 and 7.0
- Consistent implementation of union type checking

### Fixed

- `reset()` should not trigger `setDefaultException` error condition

## 1.3.1 - 2019-11-06

### Fixed

- `reset()` also resets `conditionalResults`

## 1.3.0 - 2019-02-21

### Added

- Conditional mock functionality

## 1.2.0 - 2019-01-19

### Added

- Support for HTTPlug 2.0.
- Support for php-http/client-common 2.0.

## 1.1.0 - 2018-01-08

### Added

- Default response functionality
- Default exception functionality
- `getLastRequest` method


## 1.0.1 - 2017-05-02

### Fixed

- `php-http/client-common` minimum dependency


## 1.0.0 - 2017-03-10

Stable release with no changes since 0.3


## 0.3.0 - 2016-02-26

### Added

- Support for custom MessageFactory

### Changed

- Updated dependencies


## 0.2.0 - 2016-02-01

### Changed

- Updated dependencies


## 0.1.1 - 2015-12-31


## 0.1.0 - 2015-12-29

### Added

- Initial release
