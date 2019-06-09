<div class="card">
    <div class="card-header">
        <h5><?= $this->context->pageName; ?></h5>
    </div>
    <div class="card-body">
        <?php
        if ($response['status'] == 'success') {
            print_r($response['data']);
        } else { ?>
            <div class="alert alert-info m-3">
                <?= $response['message']; ?>
            </div>
        <?php } ?>
    </div>
</div>
