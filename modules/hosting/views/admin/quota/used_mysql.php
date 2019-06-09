<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Домен</th>
                <th>Размер</th>
            </tr>
            <?php foreach ($response as $data) { ?>
                <tr>
                    <td><?= $data['name']; ?></td>
                    <td><?= $data['size']; ?> MB</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>