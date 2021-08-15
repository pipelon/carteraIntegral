<?php
/* @var $this yii\web\View */

$this->title = 'CILES';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">

            <!-- PROCESOS-->
            <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-list-2"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Procesos</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/procesos/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?>

            <!-- CLIENTES-->
            <?php if (\Yii::$app->user->can('/clientes/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Clientes</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/clientes/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?>

            <!-- DEUDORES -->
            <?php if (\Yii::$app->user->can('/deudores/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-coins"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Deudores</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/deudores/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?>

            <!-- TIPO DE PROCESO -->
            <?php if (\Yii::$app->user->can('/tipo-procesos/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-squares-2"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tipos de procesos</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/tipo-procesos/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?> 

            <!-- TIPO DE CASOS -->
            <?php if (\Yii::$app->user->can('/tipo-casos/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-squares-2"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tipos de casos</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/tipo-casos/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?> 

            <!-- BIENES -->
            <?php if (\Yii::$app->user->can('/bienes/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-list-3"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Bienes</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/bienes/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?> 

            <!-- DOCUMENTOS DE ACTIVACION -->
            <?php if (\Yii::$app->user->can('/documentos-activacion/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-list-3"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Documentos de activación</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/documentos-activacion/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?> 

            <!-- ETAPAS PROCESALES -->
            <?php if (\Yii::$app->user->can('/etapas-procesales/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-list-3"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Etapas procesales</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/etapas-procesales/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?> 
            
             <!-- ESTADOS DEL PROCESO -->
            <?php if (\Yii::$app->user->can('/estados-proceso/index') || \Yii::$app->user->can('/*')) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <span class="info-box-icon"><i class="flaticon-list-3"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Estados del proceso</span>
                            <span class="info-box-number">&nbsp;</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <i class="fa fa-arrow-circle-right"></i> 
                                <?= \yii\bootstrap\Html::a('Ver más', ['/estados-proceso/index'], ['style' => 'color: white']); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>  
            <?php endif; ?> 

        </div>

    </div>
</div>
