OpenWines Open-Data scraper
===========================

OpenWines scraper, is a simple Command Line Interface to scrap 100% genuine open-data,
in order to generate fixtures dataset for OpenWines Products Information Manager.

It's a simple command line application, heavily inspired by [Cilex](https://github.com/Cilex/Cilex) to develop simple tools
based on [Symfony2][1] components.

## Installation

 1. `git clone` _this_ repository.
 2. Download composer: `curl -s https://getcomposer.org/installer | php`
 3. Install dependencies: `php composer.phar install`


## Usage

```bash
bin/scraper appellation muscadet > muscadet.csv
```

Output example: [muscadet.csv](examples/muscadet.csv)

Other available commands:

```bash
bin/scraper 
bin/scraper info
bin/scraper help appellation
bin/scraper appellation muscadet
```

## Hack

 - Create your new commands in `src/OpenWines/Command/`
 - Add your new commands to `bin/`


## Creating a PHAR

 - Download and install [box][5]:
```sh
curl -LSs https://box-project.github.io/box2/installer.php | php
chmod +x box.phar
mv box.phar /usr/local/bin/box
```
 - Update the project phar config in box.json
 - Create the package:
```sh
box build
```
 - Run the commands:
```sh
./scraper.phar info
```
 - enjoy a lot.

## License

OpenWines Scraper is licensed under the [Open Software License (OSL 3.0)](http://opensource.org/licenses/osl-3.0.php)

[1]: http://symfony.com
[2]: http://silex.sensiolabs.org
[3]: http://cilex.github.com/get/cilex.phar
[4]: http://cilex.github.com/documentation
[5]: https://box-project.github.io/box2/

## FAQ

Q: How do I pass configuration into the application?

A: You can do this by adding the following line, where $configPath is the path to the configuration file you want to use:

```php
$app->register(new \OpenWines\Provider\ConfigServiceProvider(), array('config.path' => $configPath));
```

The formats currently supported are: YAML, XML and JSON