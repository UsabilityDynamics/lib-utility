## Classes

 - Utility: General utility methods.
 - Job: Job and processing handling.
 - Loader: PSR class loader. 

## Utility Methods

 - extend()
 - defaults()
 - pluralize()
 - singularize()
 - ordinalize()
 - hashify_file_name()
 - can_get_image()
 - ...

## Changelog

0.2.4
 - Added Utility::hashify_file_name() method;
 - Added seperator options to Utility:;create_slug() to support things such as "::"

## Usage

```PHP
// Extend an Array or Object with another for easily setting of defaults. This is similar to extend() but in reverse.
$settings = UsabilityDynamics\Utility::defaults( $configurationObject, $defaultsObject );

// Find composer.json file and return as Object.
$composer = UsabilityDynamics\Utility::findUp( 'composer.json', __DIR__ );
echo "Versio is {$composer->version}."
```

## License

(The MIT License)

Copyright (c) 2013 Usability Dynamics, Inc. &lt;info@usabilitydynamics.com&gt;

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
