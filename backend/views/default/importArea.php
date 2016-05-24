<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(
    [
        'id' => 'import-form',
        'method' => 'post',
        'options' => ['class'=>'form-horizontal adminex-form', 'enctype' => "multipart/form-data"]
    ]
); ?>
    <div class="form-group">
        <label class="col-lg-2 col-md-2 col-sm-2 control-label">
            选择文件
        </label>

        <div class="col-lg-2 col-md-2 col-sm-2">
            <input type="file" name="import-area" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 col-md-2 col-sm-2 control-label">
        </label>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <button class="btn btn-primary js-add-class" type="submit">保存</button>
        </div>
    </div>
<?php ActiveForm::end(); ?>