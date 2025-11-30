<?php if ($data['history']): ?>
    <?php foreach ($data['history'] as $thv): ?>
        <div class="d-flex mt-4 border rounded px-3 py-2">
            <div class="col-6">
                <div class="row">
                    <div class="<?php echo $thv['type_class']; ?> fw-medium th-nominal"><?php echo $thv['total_amount']; ?></div>
                </div>
                <div class="row">
                    <div class="text-body-tertiary fw-medium th-date"><?php echo $thv['created_on']; ?></div>
                </div>
            </div>
            <div class="col-6 py-2">
                <div class="th-type text-end py-2 fw-medium"><?php echo $thv['description']; ?></div>
            </div>
        </div>
    <?php endforeach; ?>
<?php if(!$data['hide_showmore_btn']):?>
<div class="row">
    <a href="#" class="th-show-more text-danger fw-bold text-center mt-4"
       data-limit="<?php echo $data['limit'] ?>">Show more</a>
</div>
<?php endif; ?>
<?php
else:?>
<div class="text-center text-body-tertiary">Maaf tidak ada histori transaksi</div>
<?php endif;?>
