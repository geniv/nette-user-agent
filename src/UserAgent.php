<?php declare(strict_types=1);

namespace UserAgent;

use Nette\StaticClass;


/**
 * Class UserAgent
 *
 * re-implement goodflow core.
 *
 * @author  geniv
 */
class UserAgent
{
    use StaticClass;


    /**
     * UserAgent constructor.
     */
    private function __construct() { }


    /**
     * Get user agent.
     *
     * @internal
     * @param string|null $agent
     * @return string
     */
    private static function getUserAgent(string $agent = null): string
    {
        return $agent ?? ($_SERVER['HTTP_USER_AGENT'] ?? '');
    }


    /**
     * Is firefox.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isFirefox(string $agent = null): bool
    {
        return (preg_match('#(Firefox|Shiretoko)/([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is chrome.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isChrome(string $agent = null): bool
    {
        return (preg_match('#Chrome/([a-zA-Z0-9\.]+) Safari/([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is safari.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isSafari(string $agent = null): bool
    {
        return (preg_match('#Safari/([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is opera.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isOpera(string $agent = null): bool
    {
        return (preg_match('#Opera[ /]([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is IExplorer.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isIExplorer(string $agent = null): bool
    {
        return (preg_match('#(?i)msie|trident|edge ([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is android.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isAndroid(string $agent = null): bool
    {
        return (preg_match('#Android ([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }


//    /**
//     * IsI IPhone.
//     *
//     * @param string|null $agent
//     * @return bool
//     */
//    public static function isIPhone(string $agent = null): bool
//    {
//        return (preg_match('/(iPhone)/i', self::getUserAgent($agent)) == 1);
//    }
//
//
//    /**
//     * Is IPod.
//     *
//     * @param string|null $agent
//     * @return bool
//     */
//    public static function isIPod(string $agent = null): bool
//    {
//        return (preg_match('/(iPod)/i', self::getUserAgent($agent)) == 1);
//    }
//
//
//    /**
//     * Is WebOS.
//     *
//     * @param string|null $agent
//     * @return bool
//     */
//    public static function isWebOS(string $agent = null): bool
//    {
//        return (preg_match('#webOS/([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
//    }


    /**
     * Is Linux.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isLinux(string $agent = null): bool
    {
        return (preg_match('/(Linux)|(Android)/i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is Mac.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isMac(string $agent = null): bool
    {
        return (preg_match('/(Mac OS)|(Mac OS X)|(Mac_PowerPC)|(Macintosh)/i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is Windows.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isWindows(string $agent = null): bool
    {
        return (preg_match('/(Windows)/i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is WebKit.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isWebKit(string $agent = null): bool
    {
        return (preg_match('#AppleWebKit/([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is Gecko.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isGecko(string $agent = null): bool
    {
        return (preg_match('#Gecko/([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }


    /**
     * Is wget.
     *
     * @param string|null $agent
     * @return bool
     */
    public static function isWget(string $agent = null): bool
    {
        return (preg_match('#Wget/([a-zA-Z0-9\.]+)#i', self::getUserAgent($agent)) == 1);
    }
}
