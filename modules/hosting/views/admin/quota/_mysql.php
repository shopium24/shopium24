<?php if($response){ ?>
<table class="table table-bordered table-striped">
    <tr>
        <th>Домен</th>
        <th class="text-center">Размер</th>
    </tr>
    <?php foreach ($response as $data) { ?>
        <tr>
            <td><?= $data['name']; ?></td>
            <td class="text-center"><?= $data['size']; ?> MB</td>
        </tr>
    <?php } ?>
</table>
<?php } ?>