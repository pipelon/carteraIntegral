<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Resumen jurídico</h4>
</div>
<div class="modal-body">
    <?php if (!empty($model->jur_gestiones_juridicas)): ?>
        <div class="gestion-juridica popupProceso">
            <div class="row">
                <?php foreach ($model->jur_gestiones_juridicas as $gestion) : ?>            
                    <div class="col-md-12">
                        <blockquote>
                            <?= nl2br($gestion->descripcion_gestion); ?>
                            <small><?= $gestion->usuario_gestion; ?> el <cite title="Source Title"><?= $gestion->fecha_gestion; ?></cite></small>
                        </blockquote>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-outline">Save changes</button>
</div>