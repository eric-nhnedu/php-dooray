# php-dooray
Dooray SDK for PHP - Can easily use APIs provided by Dooray! (https://www.dooray.com) service.

The PHP SDK is provided based on the API documentation at the following URL:
- https://helpdesk.dooray.com/share/pages/9wWo-xwiR66BO5LGshgVTg/2939987647631384419

## 💾 Install

This SDK can be used by using the package manager or downloading the source directly. However, we highly recommend using the package manager.

## Via Package Manager
This SDK are registered in two package managers, composer. You can conveniently install it using the commands provided by the package manager. When using composer, be sure to use it in the environment PHP 5.6+ is installed.

### composer

```sh
$ composer create-project nhn-edu/php-dooray example-app
```

## 🔨 Usage

A personal authentication token is required to use the SDK.
Follow the steps below to obtain a personal authentication token.

1. Log in to Dooray PC Web.
2. Click the cogwheel icon (내설정; My Settings) at the top-right of the screen.
3. Click the [설정; Settings] button.
4. Click the API menu and click the "개인 인증 토큰; Personal Authentication Token" menu.
5. Click the "인증 토큰 생성하기; Generate Authentication Token" button.
6. Fill in the "용도; Use" field with a suitable description and click the "생성하기; Create" button.
7. Click the "복사하기; Copy" button to copy the "인증 토큰; Authentication Token" to the clipboard.

### Example - Retrieve Project Info

#### PHP Code

```php
<?php

require ('vendor/autoload.php');

use NhnEdu\PhpDooray\DoorayProjectApi;


$projectApi = new DoorayProjectApi('-- Your Personal Authentication Token Here --');

$project = $projectApi->getProject("-- Your Project ID(Number) Here --");

var_dump($project);
```

#### Output Result

```
object(stdClass)#7 (9) {
  ["id"]=>
  string(19) "(Your Project ID Here)"
  ["code"]=>
  string(5) "@eric"
  ["description"]=>
  string(0) ""
  ["state"]=>
  string(6) "active"
  ["scope"]=>
  string(7) "private"
  ["type"]=>
  string(7) "private"
  ["organization"]=>
  object(stdClass)#8 (1) {
    ["id"]=>
    string(19) "blah blah blah"
  }
  ["wiki"]=>
  object(stdClass)#9 (1) {
    ["id"]=>
    NULL
  }
  ["drive"]=>
  object(stdClass)#10 (1) {
    ["id"]=>
    string(19) "blah blah blah"
  }
}
```