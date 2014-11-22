# SilverStripe HolderPage Module

Hide subpages / children from the CMS sitetree and allow management through a 
versioned gridfield. Think `BlogHolder` but flexible and for any page type.  


## Notes 

* Automatically adds GridField(s) for managing child pages to Root.Main, above Metadata.
* Supports the CMS history view on manages pages.


## Usage

1. Add the PageHolderExtension to Pages you want to use as holder pages.
2. Define the page types to manage via `child_page_classes` static.
  * Array Key is ClassName, Array Value is Field Title


*Tested in SilverStripe 3.1*

```
<?php

class AttorneysPage extends SystemPage {

    private static $extensions = array(
       'PageHolderExtension'
    );
    private static $child_page_classes = array('Attorney' => 'Attorneys');
    
    ....
    
```

## Credits
Convenience wrapper around [ExcludeChildren Module](https://github.com/micschk/silverstripe-excludechildren)
and [Versioned GridField Module](https://github.com/icecaster/silverstripe-versioned-gridfield)


Screenshots;
###overview
![overview](https://github.com/briceburg/silverstripe-holderpage/blob/master/docs/screenshots/holderpage.png?raw=true)
###link button search [via GridFieldExtensions]
![editing](http://github.com/briceburg/silverstripe-holderpage/blob/master/docs/screenshots/holderpage_edit.png?raw=true)
