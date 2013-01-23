Codeigniter with Zend GData Library
===================================
This allows you to use the Zend GData Library in a Codeigniter project with a tiny footprint (1 helper + zend folder).

Installation
------------
- Copy the contents of the repo to your Codeigniter folder.
- Uncomment the line that matches your OS in /application/helpers/zend_helper.php

```php
// $path_to_zend = str_replace('/', '\\', APPPATH) . 'zend\\'; //windows
// $path_to_zend = APPPATH . '/zend/'; //linux
```

Notes
-----
- You can add 'zend_helper' to helper Auto-load Helper Files list or load it manually.
- There is a controller example using GCalendar.
- Zend GData version is 1.21.1
- Tested setup: Codeigniter 2.1.3, Zend GData 1.21.1, xampp for windows (ssl on)
- If you want to update the Zend GData Library just replace the contents of /application/zend/Zend with the contents of the new version /library/Zend