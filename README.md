User agent
==========

via: http://www.useragentstring.com/

Installation
------------

```sh
$ composer require geniv/nette-user-agent
```
or
```json
"geniv/nette-user-agent": ">=1.0.0"
```

require:
```json
"php": ">=7.0.0",
"nette/nette": ">=2.4.0"
```

Include in application
----------------------

neon configure extension:
```neon
extensions:
    - UserAgent\Bridges\Nette\Extension
```

usage UserAgent:
```php
UserAgent::isFirefox()
UserAgent::isChrome()
UserAgent::isSafari()
UserAgent::isOpera()
UserAgent::isIExplorer()
UserAgent::isAndroid()
UserAgent::isLinux()
UserAgent::isMac()
UserAgent::isWindows()
UserAgent::isWebKit()
UserAgent::isGecko()
```

usage UserAgentString:
```php
UserAgentString::getData()
UserAgentString::isLinux()
UserAgentString::isMac()
UserAgentString::isWindows()
UserAgentString::isChrome()
UserAgentString::isSafari()
UserAgentString::isFirefox()
UserAgentString::isOpera()
UserAgentString::isAndroid()
UserAgentString::isIExplorer()
UserAgentString::isBrowser(['Chrome', 'Firefox', 'Internet Explorer'], agent)
UserAgentString::isOs(['Linux', 'Windows', 'Macintosh'], agent)
UserAgentString::getOs()
UserAgentString::getBrowser()
UserAgentString::isWebKit()
UserAgentString::isGecko()
```
_note: in offline mode use UserAgent, in development mode use static variable, in production mode use nette cache_
