<div class="chart_title">
    <?php
    $weekarray = array("日", "一", "二", "三", "四", "五", "六");
    $strDate = date('Y') . '年' . date('n') . "月" . date('j') . "日 " . "( 周" . $weekarray[date('w')] . " ) ";
    echo $strDate;
    ?>四院<span>预约量</span></div>
<div class="main">
    <ul class="leftLogo">
        <li style="background:url(images/logo_yd.jpg) 0 10px no-repeat">远<br />大</li>
        <li style="background:url(images/logo_dd.jpg) 0 10px no-repeat">东<br />大</li>
        <!--<li style="background:url(images/logo_ma.jpg) 0 10px no-repeat">民<br />安</li>-->
        <li style="background:url(images/logo_zj.jpg) 0 10px no-repeat">湛<br />江</li>

    </ul>
    <div class="table">
        <div class="yd">
            <div>
                <div class="yd_1_span">全天：0</div>
                <div class="yd_1"></div>
                <div class="yd_3"><span>目标：30</span></div>                        
            </div>
            <div style="clear: both;"></div>
            <div>
                <div class="yd_2_span"></div>
                <div class="yd_2"></div>
            </div>

        </div>
        <div class="dd">
            <div>
                <div class="dd_1_span">全天：0</div>    
                <div class="dd_1"></div>
                <div class="dd_3"><span>目标：30</span></div>
            </div>
            <div style="clear: both;"></div>
            <div>
                <div class="dd_2_span"></div>
                <div class="dd_2"></div>
            </div>
        </div>
<!--        <div class="ma">
            <div>
                <div class="ma_1_span">全天：0</div>    
                <div class="ma_1"></div>
                <div class="ma_3"><span>目标：30</span></div>
            </div>
            <div style="clear: both;"></div>
            <div>
                <div class="ma_2_span"></div>
                <div class="ma_2"></div>
            </div>
        </div>-->
        <div class="zj">
            <div>
                <div class="zj_1_span">全天：0</div>
                <div class="zj_1"></div>
                <div class="zj_3"><span>目标：30</span></div>                  
            </div>
            <div style="clear: both;"></div>
            <div>
                <div class="zj_2_span"></div>
                <div class="zj_2"></div>
            </div>
        </div>
    </div>
    <ul class="bottomNum">  
    </ul>
</div>
