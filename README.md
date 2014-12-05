# SilverStripe PageHolder Module

Hide children from the CMS sitetree and allow management through a Versioned GridField.
Think `BlogHolder` but flexible and for any page type.  


Features
--------

* Automatically appends GridField(s) for managing children to the extended object
* Supports the CMS history view on manages pages.


Requirements
------------

ExcludeChildren https://github.com/micschk/silverstripe-excludechildren

Tested in SilverStripe 3.0, 3.1


Screenshots
-----------

![overview](https://github.com/briceburg/silverstripe-pageholder/blob/master/docs/screenshots/pageholder.png?raw=true)

![editing](https://github.com/briceburg/silverstripe-pageholder/blob/master/docs/screenshots/pageholder_edit.png?raw=true)



Usage 
=====

* Add the `PageHolderExtension` to Pages you want to use as holder pages. 
* Specify the child classes to hide from SiteTree and manage with GridField with the **$excluded_children** static.

```php

class AttorneysPage extends Page {

    private static $extensions = array(
       'PageHolderExtension'
    );
    
    private static $excluded_children = array('Attorney');
 
}    
```

* Flush the cache and run /dev/build, you will now see Attorney management under AttorneysPage types.


Configuration
=============

# Placing the GridField

By default, `PageHolderExtension` will add GridField(s) to _Root.Main_, before the _Metadata_ field.
Override this behavior through the **$pageholder_tab** and **$pageholder_insertBefore** statics.

```php

class AttorneysPage extends Page {
  private static $pageholder_tab = 'Root.Attorneys';
  private static $pageholder_insertBefore = 'settings';
  ...
}
```

Or, through [YAML Configuration](http://doc.silverstripe.org/framework/en/topics/configuration)

```yaml
---

AttorneysPage:
  pageholder_tab: Root.Attorneys
  pageholder_insertBefore: settings

```

# Changing the GridField Title

`PageHolderExtension` infers the GridField title from the plural name of the
child class. Set with the **$plural_name** static.

```php
class Attorney extends ChildPage
{
    private static $plural_name = 'Attorneys';
    ...    
}
```

Or, through [YAML Configuration](http://doc.silverstripe.org/framework/en/topics/configuration)

```yaml
---

Attorney:
  plural_name: Attorneys

```

Credits
=======

PageHolder provides an enhanced turn-key implementation of
* [ExcludeChildren Module](https://github.com/micschk/silverstripe-excludechildren)
* [Versioned GridField Module](https://github.com/icecaster/silverstripe-versioned-gridfield)

