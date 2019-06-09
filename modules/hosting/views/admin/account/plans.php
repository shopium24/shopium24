<?php
//print_r($response);die;
?>

<?php

use panix\engine\Html;
use panix\engine\CMS;

?>

<div class="row">
    <?php foreach ($response as $id => $data) { ?>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h5><?= $data['id']; ?> <?= $data['name']; ?> (<?= $data['name_billing']; ?>)</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td><?php
                                print_r($data);
                                ?>Место на SSD диске:</td>
                            <td><?= CMS::filesize($data['quota']['disc'] * 1024 * 1024); ?></td>
                        </tr>
                        <tr>
                            <td>inode</td>
                            <td><?= number_format($data['quota']['inode'], 0, '.', ','); ?></td>
                        </tr>
                        <tr>
                            <td>Расположение серверов</td>
                            <td><?= $data['resources_allocation']; ?></td>
                        </tr>



                        <tr>
                            <td>Сайтов</td>
                            <td><?= ($data['count']['vdomains'] != 999) ? $data['count']['vdomains'] : 'неограниченно'; ?></td>
                        </tr>
                        <tr>
                            <td>Субдоменов</td>
                            <td><?= ($data['count']['vhosts'] != 999) ? $data['count']['vhosts'] : 'неограниченно'; ?></td>
                        </tr>
                        <tr>
                            <td>Memory Limit</td>
                            <td><?= $data['quota']['php_memory_limit']; ?> MB</td>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="2">Цены</th>
                        </tr>


                        <?php foreach ($data['price'] as $month => $price) { ?>
                            <?php if ($price != -1) { ?>
                                <tr>
                                    <td>
                                        <?= $month ?> мес.
                                    </td>
                                    <td>
                                        <h5 class="d-inline"><?= number_format($price, 0, '.', ' '); ?></h5> <?= $data['currency']; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <?= Html::a(Html::icon('cart') . ' Купить', ['/admin/hosting/billing/pay', 'invoice' => $data['id']], ['class' => 'btn btn-sm btn-secondary']) ?>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
