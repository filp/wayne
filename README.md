<img align="right" src="http://i.imgur.com/ioms1mc.png" height="300px">

# wayne
[Laravel4](http://four.laravel.com) debug toolbar

*More info coming eventually*

**wayne** is a debugger toolbar, much like the one you'd find in one of those fancy space-age frameworks like Symfony 2.
It provides some useful information about what's going on with your **Laravel 4** application, and helps you spend
more time doing what matters, and less time doing what doesn't.

But that's not all, besides providing generic information, **wayne** can also be tailored to your specific application,
through a simple yet flexible system of toolbar widgets, built through a fluent interface, or from your own templates.

# Usage

*Note: this is an implementation proposal, the final product may be very very different.*

## Building a widget using the `Wayne` facade and the fluent interface

```php
Wayne::widget()
  ->title('Current Date')
  ->description('Shows the current date')
  ->icon(URL::asset('calendar.png'))
  ->text('Today is monday')
->attach();
```
