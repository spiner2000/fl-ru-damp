<?
if ($uid) {
    $calcHref = "/bezopasnaya-sdelka/?site=calc";
} else {
    $calcHref = "/login/?ref_uri=" . urlencode("/bezopasnaya-sdelka/?site=calc");
}
?>
<table class="b-layout__table b-layout__table_width_full" cellpadding="0" cellspacing="0" border="0">
    <tr class="b-layout__tr">
        <td class="b-layout__left b-layout__left_center b-layout__left_padtop_80 ">
            <img class="b-promo__pic" src="/images/promo-icons/big/11.png" alt="" width="82" height="90" />
        </td>
        <td class="b-layout__right b-layout__right_padbot_15 b-layout__right_width_72ps">
            <div class="b-menu b-menu_crumbs">
            <ul class="b-menu__list">
                <li class="b-menu__item"><a class="b-menu__link" href="/service/">Все услуги сайта</a>&#160;&rarr;&#160;</li>
            </ul>
            </div>			
            <h1 class="b-page__title">Безопасная Сделка</h1>
            <div class="b-layout__txt b-layout__txt_fontsize_15">Мы рекомендуем осуществлять взаимодействие с фрилансерами  через &laquo;Безопасную Сделку&raquo; &mdash; сервис, гарантирующий надежное сотрудничество. &laquo;Безопасная Сделка&raquo; защищает  работодателя от срыва сроков проекта, недобросовестных исполнителей и невыполнения обязательств с их стороны.</div>
        </td>							
    </tr>
</table>
<table class="b-layout__table b-layout__table_width_full" cellpadding="0" cellspacing="0" border="0">
    <tr class="b-layout__tr">
        <td class="b-layout__left b-layout__left_center b-layout__left_padtop_30">
            <a class="b-layout__link" href="<?= $calcHref ?>"><img class="b-promo__pic" src="/images/promo-icons/small/10.png" alt="" width="41" height="45" /></a>
            <div class="b-layout__txt b-layout__txt_padbot_10"><a class="b-layout__link" href="<?= $calcHref ?>">Калькулятор<br>«Безопасной Сделки»</a></div>
            <div class="b-layout__txt b-layout__txt_fontsize_11">Рассчитайте точную<br />стоимость заключения<br />сделки</div>
        </td>
        <td class="b-layout__right b-layout__right_width_72ps">
            <div class="b-layout__txt b-layout__txt_padtop_30 b-layout__txt_padbot_60 b-layout__txt_fontsize_22">Стоимость услуги &laquo;Безопасная Сделка&raquo; &mdash; 7% от бюджета проекта</div>
            <div class="b-layout__txt b-promo__txt_padbot_10 b-layout__txt_fontsize_22">Вы платите фрилансеру только за выполненную работу</div>
            <div class="b-promo__txt b-promo__txt_padbot_40 b-promo__txt_fontsize_15 b-promo__txt_lineheight_20">Сначала вам нужно зарезервировать деньги для сделки. Принцип работы сервиса таков, что исполнитель не получит гонорар до тех пор, пока вы не примете готовый проект.</div>
        </td>							
    </tr>
</table>
<table class="b-layout__table b-layout__table_width_full b-layout__table_margbot_20" cellpadding="0" cellspacing="0" border="0">
    <tr class="b-layout__tr">
        <td class="b-layout__left b-layout__left_center b-layout__left_padtop_30">&#160;</td>							
        <td class="b-layout__right b-layout__right_width_72ps">
            <div class="b-layout__txt b-layout__txt_padbot_10 b-layout__txt_fontsize_22">Мы защищаем ваши интересы</div>
            <div class="b-promo__txt b-promo__txt_padbot_5 b-promo__txt_fontsize_15 b-promo__txt_lineheight_20">При возникновении любой спорной ситуации вы всегда можете рассчитывать на нашу помощь. Арбитраж поможет разобраться в произошедшем и урегулировать финансовые вопросы между работодателем и фрилансером.	<? /*=  ( get_uid() ? "вами и исполнителем" : "сотрудничающими сторонами" ); */?></div>
            <div class="b-promo__txt b-promo__txt_padbot_5 b-promo__txt_fontsize_15 b-promo__txt_lineheight_20">Если же фрилансер не справился с задачей, мы вернем вам зарезервированный бюджет сделки.</div>
            <div class="b-promo__txt b-promo__txt_padbot_5 b-promo__txt_fontsize_15 b-promo__txt_lineheight_20">Если же Арбитраж выносит решение в пользу фрилансера, ему перечисляется весь бюджет сделки.</div>
            <div class="b-promo__txt b-promo__txt_padbot_5 b-promo__txt_fontsize_15 b-promo__txt_lineheight_20">В более сложных случаях Арбитраж помогает оценить объем работы, которая была проделана фрилансером, и вернуть часть суммы заказчику, а также передать оставшуюся часть исполнителю в качестве вознаграждения за выполненный проект.</div>
            <div class="b-promo__txt b-promo__txt_padbot_30 b-promo__txt_fontsize_15 b-promo__txt_lineheight_20">Арбитраж выносит решение не позднее, чем через 10 рабочих дней после обращения.</div>
            <img class="b-promo__pic b-promo__pic_margbot_30" src="/images/promo-pic/5.png" alt="" />
            <div class="b-promo__txt b-promo__txt_fontsize_11 b-promo__txt_lineheight_20">Арбитраж &mdash; это независимая комиссия, в состав которой входят исключительно профессионалы в своей области.</div>
            <div class="b-promo__txt b-promo__txt_padtop_5 b-promo__txt_fontsize_11 b-promo__txt_lineheight_20">Когда исполнитель и заказчик не могут самостоятельно прийти к соглашению, перед Арбитражем стоит задача провести анализ работы и сделать вывод, была ли она предоставлена в срок и в какой степени соответствует согласованному сторонами техническому заданию.</div>
            <div class="b-promo__txt b-promo__txt_padtop_5 b-promo__txt_fontsize_11 b-promo__txt_lineheight_20">В случае, когда для анализа проделанной фрилансером работы квалификации штатных специалистов Арбитража недостаточно, привлекаются внешние эксперты.</div>
            <div class="b-layout__txt b-layout__txt_padtop_30 b-layout__txt_padbot_15 b-layout__txt_fontsize_22">Удобное взаимодействие без бумажной волокиты</div>
            <div class="b-promo__txt b-promo__txt_padbot_10 b-promo__txt_fontsize_15 b-promo__txt_lineheight_20">Сотрудничая через &laquo;Безопасную Сделку&raquo;, вы сможете оперативно реагировать на любые изменения в проекте.</div>
            <ul class="b-promo__list b-promo__list_padbot_20">
            <li class="b-promo__item b-promo__item_fontsize_15 b-promo__item_margbot_5 b-promo__item_lineheight_18"><span class="b-promo__item-number b-promo__item-plus"></span>Вы будете получать мгновенные уведомления о новых событиях.</li>
            <li class="b-promo__item b-promo__item_fontsize_15 b-promo__item_margbot_5 b-promo__item_lineheight_18"><span class="b-promo__item-number b-promo__item-plus"></span>Вам всегда доступна вся история сделки.</li>
            <li class="b-promo__item b-promo__item_fontsize_15 b-promo__item_lineheight_18"><span class="b-promo__item-number b-promo__item-plus"></span>Работа по договору аккредитива &mdash; все документы в электронной форме.</li>
            </ul>
            <div class="b-layout__txt b-layout__txt_padtop_30 b-layout__txt_padbot_15 b-layout__txt_fontsize_22">Как найти исполнителя, используя &laquo;Безопасную Сделку&raquo;:</div>
            <ul class="b-promo__list b-promo__list_padbot_20">
            <li class="b-promo__item b-promo__item_fontsize_15 b-promo__item_margbot_5 b-promo__item_lineheight_18"><span class="b-promo__item-number b-promo__item-number_1"></span>Опубликуйте проект или конкурс и получите предложения от фрилансеров.</li>
            <li class="b-promo__item b-promo__item_fontsize_15 b-promo__item_lineheight_18"><span class="b-promo__item-number b-promo__item-number_2"></span>Зарезервируйте бюджет проекта/конкурса и оплачивайте услуги фрилансеров только после выполнения работы.</li>
            </ul>
            <div class="b-buttons b-buttons_padbot_40">
            <a href="/public/?step=1&kind=1" class="b-button b-button_round_green">
                <span class="b-button__b1">
                    <span class="b-button__b2">
                        <span class="b-button__txt">Разместить проект</span>
                    </span>
                </span>
            </a>                          
            <a href="/public/?step=1&kind=7" class="b-button b-button_round_green">
                <span class="b-button__b1">
                    <span class="b-button__b2">
                        <span class="b-button__txt">Опубликовать конкурс</span>
                    </span>
                </span>
            </a>                          
            <a href="/bezopasnaya-sdelka/?site=new" class="b-button b-button_round_green">
                <span class="b-button__b1">
                    <span class="b-button__b2">
                        <span class="b-button__txt">Начать Безопасную Сделку</span>
                    </span>
                </span>
            </a>                          
            </div>
            
<div class="b-promo__txt b-promo__txt_padbot_40 b-promo__txt_fontsize_15 b-promo__txt_lineheight_20">Вы можете зарезервировать деньги для &laquo;Безопасной Сделки&raquo; удобным для вас способом <img width="85" height="20" usemap="#payvariants" alt="" src="/images/promo-pic/8.png" class="b-layout__pic b-layout__pic_valign_top">
            <map name="payvariants">
            <area coords="0, 0, 25, 20" shape="rect" title="WebMoney">
            <area coords="27, 0, 50, 20" shape="rect" title="Яндекс.Деньги">
            <area coords="52, 0, 80, 20" shape="rect" title="Банковский счёт">
            </map>
            </div>
                        
        </td>							
    </tr>
</table>

<? if (!(bool)$_COOKIE['sbr-help-block-closed']) { ?>
<script type="text/javascript">
 	// действия при закрытии оранжевой плашки с кнопками помощи внизу страницы
 	(function(){
 	    window.addEvent('domready', function(){
 	        var closeBtn = $('close-sbr-help-block');
 	        if (closeBtn) {
 	            closeBtn.addEvent('click', function(){
 	                var helpBlock = $('sbr-help-block');
 	                if (helpBlock) {
 	                    helpBlock.dispose();
 	                    Cookie.write('sbr-help-block-closed', 1, {path:'/promo/sbr/',duration:365});
 	                }
 	            })
 	        }
 	    })
 	})();
</script>
<div id="sbr-help-block" class="b-fon b-fon_padbot_10">
        <div class="b-fon__body b-fon__body_pad_10 b-fon__body_fontsize_13 b-fon__body_bg_ffebbf b-layout">

                <table border="0" cellspacing="0" cellpadding="0" class="b-layout__table b-layout__table_width_full">
                        <tbody><tr class="b-layout__tr">
                                <td class="b-layout__one b-icon_help_ask">
                                        <div class="b-layout__txt">Помощь по «Безопасной Сделке»<br />удобным для вас способом:</div>
                                </td>
                                <td class="b-layout__one b-layout__one_padright_25 b-icon_help_letter">
                                        <div class="b-layout__txt b-layout__txt_nowrap">Напишите в<br /><a class="b-layout__link" href="/about/feedback/">службу поддержки</a></div>
                                </td>
                                <td class="b-layout__one b-icon_help_article">
                                        <div class="b-layout__txt b-layout__txt_nowrap">Прочтите статью в<br /><a class="b-layout__link" href="https://feedback.free-lance.ru/" target="_blank">разделе «Помощь»</a></div>
                                </td>
                        </tr>
                </tbody></table>
        </div>
        <span id="close-sbr-help-block" class="b-fon__close b-fon__close_top_5 b-fon__close_right_5"></span>
</div>
<? } ?>