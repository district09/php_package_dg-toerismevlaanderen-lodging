# Toerismevlaanderen Lodging : Examples

This directory contains examples of how to use the 
`\DigipolisGent\Toerismevlaanderen\Lodging` package and to retrieve data from
the Lodging service.

## Install

The examples require the `config.php` file being in place and filled in.

Copy the `config.example.php` file to `config.php` and fill in the values.
Do not alter the example scripts, all variables are defined in the `config.php`
file.

Install the libraries:

```bash
composer install
```

## Examples

* `01-Count.php` : Count the number of lodgings in Gent.
* `02-List.php` : Get a list of lodgings in Gent that are Erkend or Vergund.
* `03-Lodging.php` : Get the details of a single lodging by its URI.

## Usage

The scripts can only be called from command line.

Example:

```bash
php 01-Count.php
```
