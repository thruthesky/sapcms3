<?php

namespace firebird;
/**
 *
 *
 * Class Language
 *
 * @package firebird
 *
 * @short
 *  - 언어 파일에 기록을 할 때에는 ini 형식을 따르면 되며, 연관 배열로 저장되게 하면 된다.
 *  - '#' 를 집어 넣어서 변수를 표기 할 수 있다.
 *      -- 예) 어서오세요, #name 님.
 *      -- 예) welcome = #name 님을 환영합니다"!"
 *
 * @Attention ?{}|&~!()^" 와 같은 특수 문자는 에러가 발생한다. 그때는 쌍따옴표로 감싸주면된다.
 *
 */
class Language
{
    static $language = [];


    /**
     *
     * @short ext/language 폴더에 있는 언어 파일을 로드해서 $language 에 보관한다.
     *      - 기본적으로 en.ini 파일을 로드하고,
     *      - $language_code 에 지정한 언어 파일을 추가로 로드하여,
     *      - $language 에 머징하여 보관한다.
     *      - 즉, 나중에 로드한 언어 파일의 값이 사용되고 없으면 en.ini 파일의 값이 사용 된다.
     *
     * @param null $language_code
     *
     */
    public static function initialize($language_code = null)
    {
        $path = APPPATH . '/ext/language/en.ini';
        self::$language = parse_ini_file($path);

        if ( $language_code && $language_code != 'en' ) {
            $path = APPPATH . "/ext/language/ko.ini";
            self::$language = array_merge(self::$language, parse_ini_file($path));
        }
    }



    /**
     *
     * @param $code
     * @param array $kvs
     * @return mixed
     * @code
     *
     * @endcode
     */
    public static function string($code, $kvs=[]) {
        $message = self::$language[$code];
        foreach( $kvs as $k => $v ) {
            $message = str_replace('#'.$k, $v, $message);
        }
        return $message;
    }

}
