<?php declare(strict_types=1);

namespace UserAgent;

use Nette\Caching\Cache;
use Nette\Caching\IStorage;
use Nette\Caching\Storages\DevNullStorage;
use Nette\SmartObject;
use Nette\Utils\Json;


/**
 * Class UserAgentString
 *
 * re-implement goodflow core.
 *
 * @uses http://www.useragentstring.com/
 *
 * @author  geniv
 */
class UserAgentString extends UserAgent
{
    /** @var Cache */
    private static $cache;
    /** @var array */
    private static $data;


    /**
     * UserAgentString constructor.
     *
     * @param IStorage $storage
     */
    public function __construct(IStorage $storage)
    {
        self::$cache = new Cache($storage, 'cache-UserAgentString');
    }


    /**
     * Get response.
     *
     * @internal
     * @param string $userAgent
     * @return bool|string
     */
    private static function getResponse(string $userAgent)
    {
        return @file_get_contents('http://www.useragentstring.com/?getJSON=all&uas=' . urlencode($userAgent));
    }


    /**
     * Get data.
     *
     * @param string|null $agent
     * @param string|null $index
     * @return mixed|null
     */
    public static function getData(string $agent = null, string $index = null)
    {
        $ua = $agent ?: $_SERVER['HTTP_USER_AGENT'];

        if (self::$cache->getStorage() instanceof DevNullStorage) {
            // use static variable
            if (!isset(self::$data[$ua])) {
                self::$data[$ua] = self::getResponse($ua);
            }
            $response = self::$data[$ua];
        } else {
            // use cache
            $key = 'getData' . serialize($ua);
            $response = self::$cache->load($key);
            if ($response === null) {
                try {
                    $response = self::getResponse($ua);
                    self::$cache->save($key, $response);
                } catch (\Throwable $e) {
                }
            }
        }

        $data = null;
        try {
            $data = Json::decode($response, Json::FORCE_ARRAY);
        } catch (\Nette\Utils\JsonException $e) {
        }
        return ($index ? ($data[$index] ?? null) : $data);
    }


    /**
     * Is Linux.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isLinux(string $agent = null): bool
    {
        $name = self::getData($agent, 'os_type');
        if (!$name) {
            return parent::isLinux($agent);
        }
        return $name == 'Linux';
    }


    /**
     * Is mac.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isMac(string $agent = null): bool
    {
        $name = self::getData($agent, 'os_type');
        if (!$name) {
            return parent::isMac($agent);
        }
        return $name == 'Macintosh';
    }


    /**
     * Is windows.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isWindows(string $agent = null): bool
    {
        $name = self::getData($agent, 'os_type');
        if (!$name) {
            return parent::isWindows($agent);
        }
        return $name == 'Windows';
    }


    /**
     * Is chrome.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isChrome(string $agent = null): bool
    {
        $name = self::getData($agent, 'agent_name');
        if (!$name) {
            return parent::isChrome($agent);
        }
        return $name == 'Chrome';
    }


    /**
     * Is safari.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isSafari(string $agent = null): bool
    {
        $name = self::getData($agent, 'agent_name');
        if (!$name) {
            return parent::isSafari($agent);
        }
        return $name == 'Safari';
    }


    /**
     * Is firefox.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isFirefox(string $agent = null): bool
    {
        $name = self::getData($agent, 'agent_name');
        if (!$name) {
            return parent::isFirefox($agent);
        }
        return $name == 'Firefox';
    }


    /**
     * Is opera.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isOpera(string $agent = null): bool
    {
        $name = self::getData($agent, 'agent_name');
        if (!$name) {
            return parent::isOpera($agent);
        }
        return $name == 'Opera';
    }


    /**
     * Is android.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isAndroid(string $agent = null): bool
    {
        $name = self::getData($agent, 'agent_name');
        if (!$name) {
            return parent::isAndroid($agent);
        }
        return $name == 'Android Webkit Browser';
    }


    /**
     * Is IExplorer.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isIExplorer(string $agent = null): bool
    {
        $name = self::getData($agent, 'agent_name');
        if (!$name) {
            return parent::isIExplorer($agent);
        }
        return $name == 'Internet Explorer';
    }


    /**
     * Is wget.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isWget(string $agent = null): bool
    {
        $name = self::getData($agent, 'agent_name');
        if (!$name) {
            return parent::isWget($agent);
        }
        return $name == 'Wget';
    }


    /**
     * Is browser.
     *
     * @param array       $browsers
     * @param string|null $agent
     * @return bool
     */
    public static function isBrowser(array $browsers, string $agent = null): bool
    {
        // Chrome, Safari, Android Webkit Browser, Firefox, Opera, Internet Explorer
        if (is_array($browsers)) {
            return in_array(self::getData($agent, 'agent_name'), $browsers);
        }
        return false;
    }


    /**
     * Is os.
     *
     * @param array       $os
     * @param string|null $agent
     * @return bool
     */
    public static function isOs(array $os, string $agent = null): bool
    {
        // Linux, Windows, Macintosh
        if (is_array($os)) {
            return in_array(self::getData($agent, 'os_type'), $os);
        }
        return false;
    }


    /**
     * Get os.
     *
     * @param string|null $agent
     * @return string
     */
    public static function getOs(string $agent = null): string
    {
        $data = self::getData($agent);
        $result = '';
        if (isset($data['os_name'])) {
            $result = $data['os_type'];
            if ($data['linux_distibution'] && $data['linux_distibution'] != 'Null') {
                $result .= ' (' . $data['linux_distibution'] . ')';
            }

            if ($data['os_versionNumber'] && $data['os_versionNumber'] != 'Null') {
                $result .= ' (' . $data['os_versionNumber'] . ')';
            }
        }
        return $result;
    }


    /**
     * Get browser.
     *
     * @param string|null $agent
     * @return string
     */
    public static function getBrowser(string $agent = null): string
    {
        $data = self::getData($agent);
        return $data['agent_name'] . ' ' . $data['agent_version'];
    }


    /**
     * Is WebKit.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isWebKit(string $agent = null): bool
    {
        return parent::isWebKit($agent);
    }


    /**
     * Is Gecko.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isGecko(string $agent = null): bool
    {
        return parent::isGecko($agent);
    }
}
