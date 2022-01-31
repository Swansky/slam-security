<?php


class ViewManager
{

    static array $blocks = array();
    private const  BASE_PATH_TEMPLATE = "./view/templates/";
    static string $cache_path = 'cache/';
    static bool $cache_enabled = FALSE;

    static function view($file, $data = array()): void
    {
        $file = self::BASE_PATH_TEMPLATE . $file . ".html";
        $cached_file = self::cache($file);
        extract($data, EXTR_SKIP);
        require $cached_file;
    }

    static function cache($file): string {
        if (!file_exists(self::$cache_path)) {
            mkdir(self::$cache_path, 0744);
        }
        $cached_file = self::$cache_path . str_replace(array('/', '.html'), array('_', ''), $file . '.php');
        if (!self::$cache_enabled || !file_exists($cached_file) || filemtime($cached_file) < filemtime($file)) {
            $code = self::includeFiles($file);
            $code = self::compileCode($code);
            file_put_contents($cached_file, '<?php class_exists(\'' . __CLASS__ . '\') or exit; ?>' . PHP_EOL . $code);
        }
        return $cached_file;
    }

    static function compileCode($code): string
    {
        $code = self::compileYield($code);
        $code = self::compileEscapedEchos($code); // html special char
        $code = self::compileEchos($code);
        return self::compilePHP($code);
    }

    static function includeFiles($file): string
    {
        $code = file_get_contents($file);
        preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $value) {
            $pathToExtends = self::BASE_PATH_TEMPLATE . $value[2] . ".html";
            $code = str_replace($value[0], self::includeFiles($pathToExtends), $code);
        }
        return preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);
    }

    static function compilePHP($code): string
    {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
    }

    static function compileEchos($code): string
    {
        return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $code);
    }

    static function compileEscapedEchos($code): string
    {
        return preg_replace('~\{{{\s*(.+?)\s*\}}}~is', '<?php echo htmlentities($1, ENT_QUOTES, \'UTF-8\') ?>', $code);
    }

    static function compileYield($code): string
    {
        foreach (self::$blocks as $block => $value) {
            $code = preg_replace('/{% ?yield ?' . $block . ' ?%}/', $value, $code);
        }
        return preg_replace('/{% ?yield ?(.*?) ?%}/i', '', $code);
    }

}

