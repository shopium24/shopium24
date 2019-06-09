<?php

namespace app\modules\hosting\forms\site;

use panix\engine\CMS;
use Yii;
use app\modules\hosting\components\Api;
use panix\engine\base\Model;


/**
 * Class HostSiteConfigWSForm
 * @package app\modules\hosting\forms\hosting_site
 *
 * ============== Внимание! Все остальные параметры ниже - необязательные. При этом, если параметр не указан,
 * ============== система автоматически установит пустые значения или значения по-умолчанию в зависимости от параметра.
 *
 *
 *
 * @property $disable_service_url (bool:0|1) Отключить сервисный адрес.
 * @property $default_host (bool:0|1) обрабатывать все запросы для несуществующих субдоменов доменного имени указанного хоста.
 * @property $document_root_suffix домашняя директория. Разрешено использовать только символы латиницы, точку, тире и знак подчеркивания
 * @property $ip (string) IP адрес сайта. В случае наявности выделенного IP, Вы можете настроить работу сайта посредством данного IP. По-умолчанию установлен общий IP.
 * @property $default_ip (bool:0|1) установить обработку прямых запросов на сайт через указанный в параметре ip выделенный IP адрес.
 * @property $aliases array массив псевдонимов - дополнительных адресов, по которым будет доступен сайт.
 *
 * ============== Внимание! Cистема автоматически добавляет псевдонимы формата www.*. ==============
 *
 * @property $fcgi_php_files: (array) массив расширений файлов, которые будут обрабатываться интерпретатором PHP.
 * @property $static_files: (array) массив расширений файлов, для ускоренной отдачи которых используется быстрый сервер nginx. При запросе файла с расширением, которое добавлено в статические, не производится обработка .htaccess - то есть mod_rewrite и mod_expires для этих файлов не работают.
 *
 *
 *
 * @property int $static_files_expire_default (int) период в часах, на который статические файлы будут кешироваться в браузере посетителей. Рекомендуемый период составляет 1 неделя и больше. По-умолчанию установлено 0 часов (не кешировать). Доступные значения:
 *           0 - не кешировать;
 *           1 - 1 час;
 *           3 - 3 часа;
 *           8 - 8 часов;
 *           12 - 12 часов;
 *           24 - 1 день;
 *           168 - 1 неделя;
 *           720 - 1 месяц;
 *           -1 - свой вариант;
 *
 * @property $static_files_expire_user int период в часах, свой вариант. Учитывается только при static_files_expire_default = -1.  Необходимо указывать в часах, как целое положительно число.
 * @property $static_404_redirect bool Передавать запрос на бекенд в случае, если статический файл не найден.
 * @property $php_mail string E-mail адрес, который будет указан в поле From при отправке почты при помощи функции mail() в PHP. Допускаются только те e-mail адреса, которые были зарегистрированы в указанном хостинг-аккаунте.
 * @property $modsecurity_enabled: bool включить обработку правил ModSecurity.
 * @property $modsecurity_disable_rules (array) массив идентификаторов правил, которые необходимо исключить из блокировок ModSecurity.
 * @property $charset: (enum) кодировка сайта. По-умолчанию установлено UTF-8. Доступные значения: CP1251, UTF-8, KOI8-R, ISO-8859-5.
 * @property $redirect: (enum) переадресация www. По-умолчанию установлено off. Доступные значения:
 *           off - отключена;
 *           www_from - переадресовывать запросы с www.<сайт> на <сайт>;
 *           www_to - переадресовывать запросы с <сайт> на www.<сайт>.
 * @property $https_redirect (enum) переадресация https. По-умолчанию установлено disabled. Доступные значения:
 *           disabled - отключена;
 *           to_https - переадресовывать запросы с https на http
 *           to_http - переадресовывать запросы с http на https.
 * @property $mp4_streaming (bool) cтриминг видео .mp4. Обеспечивает серверную поддержку псевдо-стриминга для .mp4 файлов.
 *
 * ============== Внимание! Параметр доступен только для владельцев Managed Dedicated.
 *
 *
 * @property $ssi bool Включить обработку Server Side Includes.
 * @property $enable_perl bool разрешить исполнение Perl скриптов на сайте.
 * @property $system_error_pages bool включить страницы ошибок (для всех сайтов аккаунта).
 * @property $optimize array массив с настройками оптимизации сайта. Список доступных параметров можно найти в разделе с описанием метода hosting_site_config_ws::optimize.
 *
 *
 */
class HostSiteConfigWSForm extends Model
{

    protected $module = 'hosting';
    public $account;
    public $host;


    public $disable_service_url;
    public $default_host;
    public $document_root_suffix;
    public $ip;
    public $default_ip;
    public $aliases;


    public $fcgi_php_files;
    public $static_files;
    public $static_files_expire_default = [
        '0 - не кешировать; 
1 - 1 час; 
3 - 3 часа; 
8 - 8 часов; 
12 - 12 часов; 
24 - 1 день; 
168 - 1 неделя; 
720 - 1 месяц; 
-1 - свой вариант;'
    ];
    public $static_files_expire_user;
    public $static_404_redirect;
    public $php_mail;

    public $modsecurity_enabled;
    public $modsecurity_disable_rules;
    public $charset = ['CP1251', 'UTF-8', 'KOI8-R', 'ISO-8859-5'];
    public $redirect = ['off', 'www_from', 'www_to'];
    public $https_redirect = ['disabled', 'to_https', 'to_http'];
    public $mp4_streaming;



    public $ssi;
    public $enable_perl;
    public $system_error_pages;
    public $optimize = [
        "combine_javascript",
        "combine_css",
        "move_css_above_scripts",
        "insert_dns_prefetch",
        "rewrite_javascript",
        "rewrite_css",
        "rewrite_style_attributes_with_url",
        "lazyload_images",
        "collapse_whitespace",
        "move_css_to_head",
        "remove_quotes",
        "inline_css",
        "inline_javascript",
        "trim_urls",
        "convert_meta_tags",
        "extend_cache_images",
        "extend_cache_scripts",
        "extend_cache_css"
    ];

    public function rules()
    {
        return [
            [[
                'account',
                'host',
                'disable_service_url',
                'default_host',
                'document_root_suffix',
                'ip',
                'default_ip',
                'aliases',
                'fcgi_php_files',
                'static_files',
                'static_files_expire_default',
                'static_files_expire_user',
                'static_404_redirect',
                'php_mail',
                'modsecurity_enabled',
                'modsecurity_disable_rules',
                'charset',
                'redirect',
                'https_redirect',
                'mp4_streaming',
                'ssi',
                'enable_perl',
                'system_error_pages',
                'optimize',
            ], "required"],


            // [['site', 'subdomain'], 'string'],
            // [['subdomain'], 'validateSubdomain'],
        ];
    }

}
