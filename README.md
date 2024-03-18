# SolutionPioneers Banner Slider extension


## 1. How to install SolutionPioneers Banner Slider

Add the following lines into your composer.json
 
```
"require":{
    ...
    "solution-pioneers/magento-banner-slider":"{version}"
 }
```
or install via composer

```
composer require solution-pioneers/magento-banner-slider
```

Then execute the following commands:

```
$ composer update
$ bin/magento setup:upgrade
$ bin/magento setup:static-content:deploy
```