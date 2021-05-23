<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?=
                \yii\helpers\Html::img('@web/images/default-user.png',
                        [
                            'alt' => 'User Image',
                            'class' => 'img-circle'
                ])
                ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->fullName; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
            </div>
        </div>

        <?php if (!\Yii::$app->user->isGuest) : ?>
            <?php
            $callback = function ($menu) {
                if (count($menu['children']) > 0) {
                    $item = [
                        'label' => $menu['name'],
                        'url' => [$menu['route']],
                        'icon' => $menu['data'],
                        'options' => [
                            $menu['data'],
                            'class' => 'treeview'
                        ],
                        'items' => $menu['children']
                    ];
                } else {
                    $item = [
                        'label' => $menu['name'],
                        'icon' => $menu['data'],
                        'url' => [$menu['route']],
                    ];
                }
                return $item;
            };
            $items = \mdm\admin\components\MenuHelper::getAssignedMenu(
                            Yii::$app->user->id
                            , null
                            , $callback);

            echo \dmstr\widgets\Menu::widget([
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => $items,
                'submenuTemplate' => "<ul class='treeview-menu'>\n{items}\n</ul>\n",
                'encodeLabels' => false,
                'activateParents' => false,]);
            ?>
            <ul class="sidebar-menu">
                <li>
                    <?=
                    yii\bootstrap\Html::a(
                            '<i class="fa flaticon-logout"></i> <span>Salir</span>', ['/site/logout'], ['data-method' => 'post']
                    )
                    ?>
                </li>

            </ul>
        <?php endif; ?>
<!--        <i style="font-size:50px" class="flaticon-users"><i><br />
<i style="font-size:50px" class="flaticon-list-3"><i><br />
<i style="font-size:50px" class="flaticon-file-1"><i><br />
<i style="font-size:50px" class="flaticon-time-3"><i>103"; }<br />
<i style="font-size:50px" class="flaticon-profile-1"><i>104"; }<br />
<i style="font-size:50px" class="flaticon-time-2"><i>105"; }<br />
<i style="font-size:50px" class="flaticon-list-2"><i>106"; }<br />
<i style="font-size:50px" class="flaticon-multimedia-2"><i>107"; }<br />
<i style="font-size:50px" class="flaticon-interface-9"><i>108"; }<br />
<i style="font-size:50px" class="flaticon-file"><i>109"; }<br />
<i style="font-size:50px" class="flaticon-background"><i>10a"; }<br />
<i style="font-size:50px" class="flaticon-chat-1"><i>10b"; }<br />
<i style="font-size:50px" class="flaticon-graph"><i>10c"; }<br />
<i style="font-size:50px" class="flaticon-pie-chart"><i>10d"; }<br />
<i style="font-size:50px" class="flaticon-bag"><i>10e"; }<br />
<i style="font-size:50px" class="flaticon-warning-2"><i>10f"; }<br />
<i style="font-size:50px" class="flaticon-visible"><i>110"; }<br />
<i style="font-size:50px" class="flaticon-line-graph"><i>111"; }<br />
<i style="font-size:50px" class="flaticon-diagram"><i>112"; }<br />
<i style="font-size:50px" class="flaticon-statistics"><i>113"; }<br />
<i style="font-size:50px" class="flaticon-paper-plane"><i>114"; }<br />
<i style="font-size:50px" class="flaticon-cogwheel-2"><i>115"; }<br />
<i style="font-size:50px" class="flaticon-lifebuoy"><i>116"; }<br />
<i style="font-size:50px" class="flaticon-settings"><i>117"; }<br />
<i style="font-size:50px" class="flaticon-menu-button"><i>118"; }<br />
<i style="font-size:50px" class="flaticon-user"><i>119"; }<br />
<i style="font-size:50px" class="flaticon-apps"><i>11a"; }<br />
<i style="font-size:50px" class="flaticon-clock-1"><i>11b"; }<br />
<i style="font-size:50px" class="flaticon-close"><i>11c"; }<br />
<i style="font-size:50px" class="flaticon-pin"><i>11d"; }<br />
<i style="font-size:50px" class="flaticon-circle"><i>11e"; }<br />
<i style="font-size:50px" class="flaticon-interface-8"><i>11f"; }<br />
<i style="font-size:50px" class="flaticon-technology-1"><i>120"; }<br />
<i style="font-size:50px" class="flaticon-danger"><i>121"; }<br />
<i style="font-size:50px" class="flaticon-exclamation-square"><i>122"; }<br />
<i style="font-size:50px" class="flaticon-cancel"><i>123"; }<br />
<i style="font-size:50px" class="flaticon-calendar-2"><i>124"; }<br />
<i style="font-size:50px" class="flaticon-warning-sign"><i>125"; }<br />
<i style="font-size:50px" class="flaticon-more-5"><i>126"; }<br />
<i style="font-size:50px" class="flaticon-exclamation-2"><i>127"; }<br />
<i style="font-size:50px" class="flaticon-cogwheel-1"><i>128"; }<br />
<i style="font-size:50px" class="flaticon-book"><i>129"; }<br />
<i style="font-size:50px" class="flaticon-squares-4"><i>12a"; }<br />
<i style="font-size:50px" class="flaticon-clock"><i>12b"; }<br />
<i style="font-size:50px" class="flaticon-graphic-2"><i>12c"; }<br />
<i style="font-size:50px" class="flaticon-symbol"><i>12d"; }<br />
<i style="font-size:50px" class="flaticon-tool-1"><i>12e"; }<br />
<i style="font-size:50px" class="flaticon-laptop"><i>12f"; }<br />
<i style="font-size:50px" class="flaticon-event-calendar-symbol"><i>130"; }<br />
<i style="font-size:50px" class="flaticon-logout"><i>131"; }<br />
<i style="font-size:50px" class="flaticon-refresh"><i>132"; }<br />
<i style="font-size:50px" class="flaticon-questions-circular-button"><i>133"; }<br />
<i style="font-size:50px" class="flaticon-search-magnifier-interface-symbol"><i>134"; }<br />
<i style="font-size:50px" class="flaticon-search-1"><i>135"; }<br />
<i style="font-size:50px" class="flaticon-more-4"><i>136"; }<br />
<i style="font-size:50px" class="flaticon-attachment"><i>137"; }<br />
<i style="font-size:50px" class="flaticon-speech-bubble-1"><i>138"; }<br />
<i style="font-size:50px" class="flaticon-open-box"><i>139"; }<br />
<i style="font-size:50px" class="flaticon-coins"><i>13a"; }<br />
<i style="font-size:50px" class="flaticon-speech-bubble"><i>13b"; }<br />
<i style="font-size:50px" class="flaticon-squares-3"><i>13c"; }<br />
<i style="font-size:50px" class="flaticon-computer"><i>13d"; }<br />
<i style="font-size:50px" class="flaticon-alert-2"><i>13e"; }<br />
<i style="font-size:50px" class="flaticon-alert-off"><i>13f"; }<br />
<i style="font-size:50px" class="flaticon-map"><i>140"; }<br />
<i style="font-size:50px" class="flaticon-interface-7"><i>141"; }<br />
<i style="font-size:50px" class="flaticon-graphic-1"><i>142"; }<br />
<i style="font-size:50px" class="flaticon-cogwheel"><i>143"; }<br />
<i style="font-size:50px" class="flaticon-alert-1"><i>144"; }<br />
<i style="font-size:50px" class="flaticon-folder-4"><i>145"; }<br />
<i style="font-size:50px" class="flaticon-interface-6"><i>146"; }<br />
<i style="font-size:50px" class="flaticon-interface-5"><i>147"; }<br />
<i style="font-size:50px" class="flaticon-calendar-1"><i>148"; }<br />
<i style="font-size:50px" class="flaticon-time-1"><i>149"; }<br />
<i style="font-size:50px" class="flaticon-signs-2"><i>14a"; }<br />
<i style="font-size:50px" class="flaticon-calendar"><i>14b"; }<br />
<i style="font-size:50px" class="flaticon-search"><i>14c"; }<br />
<i style="font-size:50px" class="flaticon-infinity"><i>14d"; }<br />
<i style="font-size:50px" class="flaticon-list-1"><i>14e"; }<br />
<i style="font-size:50px" class="flaticon-bell"><i>14f"; }<br />
<i style="font-size:50px" class="flaticon-delete"><i>150"; }<br />
<i style="font-size:50px" class="flaticon-squares-2"><i>151"; }<br />
<i style="font-size:50px" class="flaticon-clipboard"><i>152"; }<br />
<i style="font-size:50px" class="flaticon-shapes-1"><i>153"; }<br />
<i style="font-size:50px" class="flaticon-comment"><i>154"; }<br />
<i style="font-size:50px" class="flaticon-squares-1"><i>155"; }<br />
<i style="font-size:50px" class="flaticon-mark"><i>156"; }<br />
<i style="font-size:50px" class="flaticon-signs-1"><i>157"; }<br />
<i style="font-size:50px" class="flaticon-squares"><i>158"; }<br />
<i style="font-size:50px" class="flaticon-business"><i>159"; }<br />
<i style="font-size:50px" class="flaticon-car"><i>15a"; }<br />
<i style="font-size:50px" class="flaticon-light"><i>15b"; }<br />
<i style="font-size:50px" class="flaticon-information"><i>15c"; }<br />
<i style="font-size:50px" class="flaticon-dashboard"><i>15d"; }<br />
<i style="font-size:50px" class="flaticon-edit-1"><i>15e"; }<br />
<i style="font-size:50px" class="flaticon-location"><i>15f"; }<br />
<i style="font-size:50px" class="flaticon-technology"><i>160"; }<br />
<i style="font-size:50px" class="flaticon-exclamation-1"><i>161"; }<br />
<i style="font-size:50px" class="flaticon-tea-cup"><i>162"; }<br />
<i style="font-size:50px" class="flaticon-notes"><i>163"; }<br />
<i style="font-size:50px" class="flaticon-analytics"><i>164"; }<br />
<i style="font-size:50px" class="flaticon-transport"><i>165"; }<br />
<i style="font-size:50px" class="flaticon-truck"><i>166"; }<br />
<i style="font-size:50px" class="flaticon-user-settings"><i>167"; }<br />
<i style="font-size:50px" class="flaticon-user-add"><i>168"; }<br />
<i style="font-size:50px" class="flaticon-user-ok"><i>169"; }<br />
<i style="font-size:50px" class="flaticon-internet"><i>16a"; }<br />
<i style="font-size:50px" class="flaticon-alert"><i>16b"; }<br />
<i style="font-size:50px" class="flaticon-alarm"><i>16c"; }<br />
<i style="font-size:50px" class="flaticon-shapes"><i>16d"; }<br />
<i style="font-size:50px" class="flaticon-up-arrow-1"><i>16e"; }<br />
<i style="font-size:50px" class="flaticon-more-3"><i>16f"; }<br />
<i style="font-size:50px" class="flaticon-lock-1"><i>170"; }<br />
<i style="font-size:50px" class="flaticon-profile"><i>171"; }<br />
<i style="font-size:50px" class="flaticon-map-location"><i>172"; }<br />
<i style="font-size:50px" class="flaticon-placeholder-2"><i>173"; }<br />
<i style="font-size:50px" class="flaticon-route"><i>174"; }<br />
<i style="font-size:50px" class="flaticon-more-2"><i>175"; }<br />
<i style="font-size:50px" class="flaticon-lock"><i>176"; }<br />
<i style="font-size:50px" class="flaticon-multimedia-1"><i>177"; }<br />
<i style="font-size:50px" class="flaticon-add"><i>178"; }<br />
<i style="font-size:50px" class="flaticon-more-1"><i>179"; }<br />
<i style="font-size:50px" class="flaticon-more"><i>17a"; }<br />
<i style="font-size:50px" class="flaticon-menu"><i>17b"; }<br />
<i style="font-size:50px" class="flaticon-suitcase"><i>17c"; }<br />
<i style="font-size:50px" class="flaticon-app"><i>17d"; }<br />
<i style="font-size:50px" class="flaticon-interface-4"><i>17e"; }<br />
<i style="font-size:50px" class="flaticon-time"><i>17f"; }<br />
<i style="font-size:50px" class="flaticon-list"><i>180"; }<br />
<i style="font-size:50px" class="flaticon-music-2"><i>181"; }<br />
<i style="font-size:50px" class="flaticon-tool"><i>182"; }<br />
<i style="font-size:50px" class="flaticon-security"><i>183"; }<br />
<i style="font-size:50px" class="flaticon-interface-3"><i>184"; }<br />
<i style="font-size:50px" class="flaticon-interface-2"><i>185"; }<br />
<i style="font-size:50px" class="flaticon-interface-1"><i>186"; }<br />
<i style="font-size:50px" class="flaticon-layers"><i>187"; }<br />
<i style="font-size:50px" class="flaticon-placeholder-1"><i>188"; }<br />
<i style="font-size:50px" class="flaticon-placeholder"><i>189"; }<br />
<i style="font-size:50px" class="flaticon-web"><i>18a"; }<br />
<i style="font-size:50px" class="flaticon-multimedia"><i>18b"; }<br />
<i style="font-size:50px" class="flaticon-tabs"><i>18c"; }<br />
<i style="font-size:50px" class="flaticon-signs"><i>18d"; }<br />
<i style="font-size:50px" class="flaticon-interface"><i>18e"; }<br />
<i style="font-size:50px" class="flaticon-network"><i>18f"; }<br />
<i style="font-size:50px" class="flaticon-share"><i>190"; }<br />
<i style="font-size:50px" class="flaticon-info"><i>191"; }<br />
<i style="font-size:50px" class="flaticon-exclamation"><i>192"; }<br />
<i style="font-size:50px" class="flaticon-music-1"><i>193"; }<br />
<i style="font-size:50px" class="flaticon-medical"><i>194"; }<br />
<i style="font-size:50px" class="flaticon-imac"><i>195"; }<br />
<i style="font-size:50px" class="flaticon-cart"><i>196"; }<br />
<i style="font-size:50px" class="flaticon-download"><i>197"; }<br />
<i style="font-size:50px" class="flaticon-edit"><i>198"; }<br />
<i style="font-size:50px" class="flaticon-graphic"><i>199"; }<br />
<i style="font-size:50px" class="flaticon-browser"><i>19a"; }<br />
<i style="font-size:50px" class="flaticon-up-arrow"><i>19b"; }<br />
<i style="font-size:50px" class="flaticon-folder-3"><i>19c"; }<br />
<i style="font-size:50px" class="flaticon-folder-2"><i>19d"; }<br />
<i style="font-size:50px" class="flaticon-folder-1"><i>19e"; }<br />
<i style="font-size:50px" class="flaticon-folder"><i>19f"; }<br />
<i style="font-size:50px" class="flaticon-music"><i>1a0"; }<br />
<i style="font-size:50px" class="flaticon-chat"><i>1a1"; }<br />-->
    </section>

</aside>
