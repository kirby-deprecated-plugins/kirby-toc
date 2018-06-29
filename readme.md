# Kirby TOC - Table Of Contents

![Version 0.1](https://img.shields.io/badge/version-0.1-blue.svg) ![MIT license](https://img.shields.io/badge/license-MIT-green.svg) [![Donate](https://img.shields.io/badge/give-donation-yellow.svg)](https://www.paypal.me/DevoneraAB)

Automatically generate a table of contents nested list of your content.

[**Installation instructions**](docs/install.md)

**By default the table of contents should now be visible at the top of all your pages.**

## Options

The following options can be set in your `/site/config/config.php` file:

```php
c::get('kirby.toc.class', 'toc');
c::set('kirby.toc.filters', ['headings', 'auto']);
c::set('kirby.toc.field.method.name', 'toc');
c::set('kirby.toc.replacement', '{{ toc }}');
c::set('kirby.toc.slug.method', function($heading) {
    return str::slug($heading);
};
```

## kirby.toc.class

By default the table of contents nested list will be wrapped by `<div class="toc"></div>`. You can't remove it, but you can set another class name if you want.

```php
c::get('kirby.toc.class', 'table-of-contents');
```

### kirby.toc.filters

By default two filters are used on the content to add the nested table of contents list.

```php
c::set('kirby.toc.filters', ['headings', 'auto']);
```

#### headings

This filter will add id attributes to all h1-h6 tags. The id is extracted from the heading text and converted to slugs with the `str::slug()` method by default.

```text
## Hello h2
```

...becomes...

```text
<h2 id="hello-h2">Hello h2</h2>
```

**Be aware:** If you already have an id on your heading tag, it will not be replaced with a new one.

#### auto

This filter add the table of contents nested list at the top of the content.

#### tag

This filter add the table of contents where you put a replacement tag. By default you can add `{{ toc }}` somewhere in your content and it will be replaced by the table of contents.

### kirby.toc.field.method.name

In case you don't want the table of contents of all your pages, you can use a field method instead of the filters.

#### Disable filters

You should not use both filters and a field method. Therefor you should disable the filters when using the field method.

```php
c::set('kirby.toc.filters', []);
```

By default you can do something like this in your snippet/template:

```php
echo $page->text()->kt()->toc()
```

#### Use another field method name

If you don't like the name of the field method you can change it like this:

```php
c::set('kirby.toc.field.method.name', 'my_new_toc_name');
```

### kirby.toc.replacement

In case you use `kirby.toc.filters` with `tag`, you may want to change the tag name `{{ toc }}` to something else.

```php
c::set('kirby.toc.replacement', '{{ my_toc_list }}');
```

### kirby.toc.slug.method

By default, Kirby `str::slug()` method is used to convert headings into ids. It works well in english but for swedish words `ä` can be translated to `ae` which is not nice. In that case it should be `a`. Because of things like that you can replace the slug engine with your own.

```php
c::set('kirby.toc.slug.method', function($heading) {
    return mySuperSlugMethod($heading);
};
```

## Add the table of contents yourself

In case you need to add the table of contents nested list in your templates or snippets you can use the methods directly.

**Something like below will present the nested table of contents list:**

```php
$TOC = new TOC();
echo $TOC->list($page->text()->kt());
```

## CSS

To make the nested table of contents list look better you need to add some counters. Here is how to do that in CSS:

```html
<style>
ol {
    counter-reset: section;
    list-style-type: none;
}

li::before {
    counter-increment: section;
    content: counters(section, ".") " ";
}
</style>
```

## Changelog

**0.1**

- Initial release

## Requirements

- [**Kirby**](https://getkirby.com/) 2.5.10+

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/jenstornell/kirby-toc/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.

## Credits

- [Jens Törnell](https://github.com/jenstornell)