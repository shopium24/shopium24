<?php

use panix\engine\Html;
use panix\engine\CMS;



?>

<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">Login/ID</th>
                <th class="text-center">Дата окончания</th>
                <th class="text-center">Тариф</th>
                <th class="text-center">server</th>
                <th class="text-center">proxy</th>
                <th class="text-center">Использовано</th>
                <th class="text-center">Доп. услуги</th>
                <th class="text-center">Опции</th>
            </tr>
            <?php foreach ($response as $id => $data) { ?>
                <tr>
                    <td class="text-center"><?= Html::a($data['login'], ['/admin/hosting/hosting-account/info', 'account' => $data['login']]); ?>
                        [<?= $data['id']; ?>]
                    </td>
                    <td class="text-center"><span class="badge badge-secondary"><?= $data['valid_untill']; ?></span>
                    </td>
                    <td>

                        <div>Тариф: <?= $data['plan']['name']; ?> (<?= $data['plan']['id']; ?>)</div>
                        <?php foreach ($data['plan']['price'] as $key => $res) { ?>
                            <div><?= $key ?> мес. <?= $res; ?> <?= $data['plan']['currency']; ?></div>
                        <?php } ?>
                        <br>
                        <div><strong>Место на SSD диске:</strong> <?= CMS::filesize($data['plan']['quota']['disc'] * 1024 * 1024); ?>
                        </div>
                        <div><strong>inode</strong> <?= $data['plan']['quota']['inode']; ?></div>
                        <div>
                            <strong>Сайтов</strong> <?= ($data['plan']['quota']['sites'] != 999) ? $data['plan']['quota']['sites'] : 'неограниченно'; ?>
                        </div>
                        <div><strong>php_memory_limit</strong> <?= $data['plan']['quota']['php_memory_limit']; ?> MB
                        </div>
                    </td>
                    <td>

                        <div>Name: <?= $data['server']['name'] ?></div>
                        <div>ip: <?= CMS::ip($data['server']['ip']); ?></div>
                        <div>is_using_proxy: <?= $data['server']['is_using_proxy'] ?></div>
                        <div>is_extra_ip: <?= $data['server']['is_extra_ip'] ?></div>
                        <div>country: <?= $data['server']['country'] ?></div>
                    </td>
                    <td>
                        <div>ipv4: <?= CMS::ip($data['proxy']['ipv4']) ?></div>
                        <div>ipv6: <?= $data['proxy']['ipv6'] ?></div>
                    </td>
                    <td>
                        <div>Место на диске FTP/Mysql: <?= CMS::filesize($data['usage']['disc'] * 1024 * 1024) ?></div>
                        <div>inode: <?= $data['usage']['inode'] ?></div>
                        <div>Сайтов: <?= $data['usage']['sites'] ?></div>
                    </td>
                    <td>
                        <?php foreach ($data['extra'] as $ext) { ?>
                            <span class="badge badge-success"><?= $ext ?></span>
                        <?php } ?>


                    </td>
                    <td class="text-center">
                        <?= Html::a(Html::icon('cart'), ['/admin/hosting/billing/pay', 'invoice' => $data['id']], ['class' => 'btn btn-sm btn-outline-secondary']) ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
