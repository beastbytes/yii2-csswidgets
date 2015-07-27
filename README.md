# yii2-csswidgets
Yii2 Extension that provides UI widgets implemented in CSS only.

These widgets are an alternative to JUI widgets.

For license information see the [LICENSE](LICENSE.md)-file.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist beastbytes/yii2-csswidgets
```

or add

```json
"beastbytes/yii2-csswidgets": "*"
```

to the require section of your composer.json.

## Usage

### Accordion

```php
<?= Accordion::widget([
    'options' => [
        'single' => false // allow sections to be opened/closed individually. TRUE menas only one open section at a time
     ],
    'items' => [
        [
            'header' => 'Section 1 Header',
            'content' => 'Aenean hendrerit dolor ut venenatis molestie. Mauris viverra vulputate tortor sit amet mollis. Etiam sit amet mi eget lectus dictum congue ac sed orci.'
        ],
        [
            'header' => 'Section 2 Header',
            'content' => 'Sed a risus ac tellus dapibus consequat a id orci. Pellentesque mollis finibus tellus ac aliquam. Etiam rutrum nunc eu egestas fringilla. Nam scelerisque odio ac risus cursus, sed mollis sem dapibus. Nunc vel imperdiet ipsum, eu porta ipsum. Aenean augue massa, efficitur vitae blandit vel, accumsan eu ipsum.'
        ],
        [
            'header' => 'Section 3 Header',
            'content' => 'Aenean hendrerit dolor ut venenatis molestie. Mauris viverra vulputate tortor sit amet mollis. Etiam sit amet mi eget lectus dictum congue ac sed orci. Sed ultrices orci mi, at vulputate enim finibus pellentesque. Proin metus sem, tincidunt ac erat sed, auctor feugiat arcu.'
        ]
    ]
]) ?>
```

### Modal

```php
<?= Modal::widget([
    'label' => 'Click/Tap for more info', // the modal becomes visible when this text is clicked/tapped
    'title' => 'Lorem Ipsum',
    'content' => '<p>Aenean hendrerit dolor ut venenatis molestie. Mauris viverra vulputate tortor sit amet mollis. Etiam sit amet mi eget lectus dictum congue ac sed orci.</p><p>Sed a risus ac tellus dapibus consequat a id orci. Pellentesque mollis finibus tellus ac aliquam. Etiam rutrum nunc eu egestas fringilla. Nam scelerisque odio ac risus cursus, sed mollis sem dapibus. Nunc vel imperdiet ipsum, eu porta ipsum. Aenean augue massa, efficitur vitae blandit vel, accumsan eu ipsum.</p><p>Aenean hendrerit dolor ut venenatis molestie. Mauris viverra vulputate tortor sit amet mollis. Etiam sit amet mi eget lectus dictum congue ac sed orci. Sed ultrices orci mi, at vulputate enim finibus pellentesque. Proin metus sem, tincidunt ac erat sed, auctor feugiat arcu.</p>'
]) ?>
```

## CSS Assets

Each widget has a Base Asset, e.g. _BaseAccordionAsset.php_; this publishes the CSS that controls the widget's behaviour. The view should publish the asset that provides the skin for the widget - the default is _<Widget>Asset.php_, e.g. _AccordionAsset.php_. To change the look of the widgets either edit the included CSS asset files, e.g. _Accordion.css_ - do *not* edit the base CSS file, e.g. _BaseAccordion.css_. Alernatively provide your own <Widget>Asset file; this should declare the _Base<Widget>Asset.php_ as a dependancy to inherit the widget behaviour.

