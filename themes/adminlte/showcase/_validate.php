<?php
    $status = [
        0=>Yii::t('app','Not yet verified'),
        1=>Yii::t('app','Verified'),
        2=>Yii::t('app','Not Confirmed')
    ];
    $color = [
        0=>'warning',
        1=>'success',
        2=>'danger'
    ];
    $icon = [
        0=>'icon-exclamation',
        1=>'icon-like',
        2=>'icon-dislike'
    ];
?>

    <span class="service-icon text-<?= $color[$validate] ?> rounded-circle mx-auto mb-3"><i class="<?= $icon[$validate] ?>"></i></span>
    <h4><strong>Result</strong></h4>
    <p class="text-faded mb-0">
        <div class="info-box shadow-sm">
            <div class="info-box-content">
                <span class="info-box-text"><?= Yii::t('app','Status') ?>: </span>
                <span class="info-box-number"><?= $status[$validate] ?></span>
            </div>
        </div>
    </p>

    <?php
    if (isset($response)):
    ?>
    <?php //echo '<pre>'.print_r($response,true).'</pre>'; ?>

    <div class="jumbotron jumbotron-fluid bg-transparent ">
      <div class="container">
        <div class="alert alert-primary" role="alert">
            <div class="row">
                <div class="col-sm-3 text-bold">
                    <?= Yii::t('app','Block hash') ?>
                </div>
                <div class="col-sm-9 text-break">
                    <?= $response->blockHash; ?>
                </div>
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
            <div class="row">
                <div class="col-sm-3 text-bold">
                    <?= Yii::t('app','Block number') ?>
                </div>
                <div class="col-sm-9 text-break">
                    <?= $response->blockNumber; ?>
                </div>
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
            <div class="row">
                <div class="col-sm-3 text-bold">
                    <?= Yii::t('app','Transaction hash') ?>
                </div>
                <div class="col-sm-9 text-break">
                    <?= $response->hash; ?>
                </div>
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
            <div class="row">
                <div class="col-sm-3 text-bold">
                    <?= Yii::t('app','Saved hash') ?>
                </div>
                <div class="col-sm-9 text-break">
                    <?= $response->input; ?>
                </div>
            </div>
        </div>
      </div>
    </div>


    <?php endif; ?>
