<?php
namespace app\modules\hosting;
use Yii;
class Module extends \panix\engine\WebModule {

    public $icon ='seo-monitor';


    public function afterInstall() {
        Yii::$app->db->import($this->id);
        return parent::afterInstall();
    }

    public function afterUninstall() {
        //Удаляем таблицу модуля
        Yii::$app->db->createCommand()->dropTable(Redirects::tableName());
        Yii::$app->db->createCommand()->dropTable(SeoMain::tableName());
        Yii::$app->db->createCommand()->dropTable(SeoParams::tableName());
        Yii::$app->db->createCommand()->dropTable(SeoUrl::tableName());
        return parent::afterUninstall();
    }
    public function getInfo() {
        return [
            'label' => Yii::t('hosting/default', 'MODULE_NAME'),
            'author' => 'andrew.panix@gmail.com',
            'version' => '1.0',
            'icon' => $this->icon,
            'description' => Yii::t('hosting/default', 'MODULE_DESC'),
            'url' => ['/admin/hosting'],
        ];
    }

    public function getAdminMenu() {
        return [
            'hosting' => [
                'label' => Yii::t('hosting/default', 'MODULE_NAME'),
                'url' =>'#',
                'icon'=>'server',
                'items' =>[
                    [
                        'label' => Yii::t('hosting/default', 'MODULE_NAME'),
                        'url' =>['/admin/hosting'],
                        'icon' => $this->icon,
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'DOMAIN'),
                        'url' =>['/admin/hosting/domain'],
                        'icon' => $this->icon,
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'BILLING'),
                        'url' =>['/admin/hosting/billing'],
                        'icon' => 'cash-money',
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'HOSTING_FTP'),
                        'url' =>['/admin/hosting/ftp'],
                        'icon' => 'folder-open',
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'HOSTING_MAILBOX'),
                        'url' =>['/admin/hosting/mailbox'],
                        'icon' => 'envelope',
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'HOSTING_LOG'),
                        'url' =>['/admin/hosting/log'],
                        'icon' => 'log',
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'HOSTING_QUOTA'),
                        'url' =>['/admin/hosting/quota'],
                        'icon' => $this->icon,
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'HOSTING_DATABASE'),
                        'url' =>['/admin/hosting/database'],
                        'icon' => 'database',
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'HOSTING_ACCOUNT'),
                        'url' =>['/admin/hosting/account'],
                        'icon' => 'database',
                    ],
                    [
                        'label' => Yii::t('hosting/default', 'HOSTING_SITE'),
                        'url' =>['/admin/hosting/site'],
                        'icon' => 'database',
                    ],
                    [
                        'label' => Yii::t('app', 'SETTINGS'),
                        'url' =>['/admin/hosting/settings'],
                        'icon' => 'settings',
                    ],
                ],
            ]
        ];
    }
    public function getAdminSidebar()
    {
        return (new \panix\mod\admin\widgets\sidebar\BackendNav)->findMenu($this->id)['items'];
    }
}
