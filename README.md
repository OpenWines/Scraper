OpenWines Open-Data scraper
===========================

OpenWines scraper, is a simple Command Line Interface to scrap 100% genuine open-data,
in order to generate fixtures dataset for OpenWines Products Information Manager.


## What is does

It scraps open-data sources like Wikipedia, and returns full complete lists of Appellations, Wine Varietals (_cépages_), with one column per infobox attribute.

By using these command lines:

```bash
bin/scraper appellation > output/appellations.csv  
bin/scraper cepage > output/cepages.csv  
```

you turns these infoboxes:

![infobox](output/infobox.png)

into this kind of [CSV file](output/appellations.csv) (26 columns, one per attribute):

![csv](output/csv.png)

## What is is

It's a simple command line application, heavily inspired by [Cilex](https://github.com/Cilex/Cilex).

It scraps Wikipedia URLs, parse structured content, and write CSV files. It uses 2 sources:

 - [infobox definitions from Wikipedia](config/Resources/Appellations/InfoboxModel) like [this one for appellations](https://fr.wikipedia.org/wiki/Mod%C3%A8le:Infobox_R%C3%A9gion_viticole)
 - and lists of URLs from Wikipedia [like this CSV for appellations](config/Sources/FR_AOC.csv).

## How to install it

 1. `git clone` _this_ repository.
 2. Download composer: `curl -s https://getcomposer.org/installer | php`
 3. Install dependencies: `php composer.phar install`


## How to use it

For scraping a whole list of wikipedia URLs:

```bash
bin/scraper appellation > output/appellations.csv  
bin/scraper cepage > output/cepages.csv  
```

For a single entity:

```bash
bin/scraper appellation muscadet > output/muscadet.csv
bin/scraper cepage cabernet-sauvignon > output/cabernet-sauvignon.csv
```

Output examples: 

 - list of all [appellations.csv](output/appellations.csv)
 - list of all [cepages.csv](output/cepages.csv)
 - 1 appellation: [muscadet.csv](output/muscadet.csv)
 - 1 cepage: [cabernet-sauvignon.csv](output/cabernet-sauvignon.csv)

Other available commands:

```bash
bin/scraper 
bin/scraper info
bin/scraper help appellation
bin/scraper appellation muscadet
```

## How to hack it

 - Create your new commands in `src/OpenWines/Command/`
 - Add your new commands to `bin/`
 - Add new Wikipedia infobox models [here](config/Resources/Appellations/InfoboxModel/)
 - Add more URLs to scrape [here](config/Sources/) (need to make it a parameter, no done already)

## How to package it (in a PHAR)

 - Download and install [box](https://box-project.github.io/box2/):
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

## How to reuse it

OpenWines Scraper is licensed under the [Open Software License (OSL 3.0)](http://opensource.org/licenses/osl-3.0.php)

## FAQ

Q: How do I scrap other kind of infoboxes from other Wikipedia URLs?

A: You've got 4 files to add in order to scrap your data:

 - +1 new InfoBoxType [here](src/OpenWines/DataSources/Wikipedia/Infobox)
 - +1 new Console Command [here](src/OpenWines/Command)
 - +1 new Wikipedia infobox model [here](config/InfoboxModel)(click on the (?) link in Wikipedia Infoboxes to retrieve it)
 - +1 new Wikipedia URLs CSV file [here](config/Sources)


Q: How do I contribute to Wikidata?

A: I don't know how, but more people ask for that. So feel free to contribute!