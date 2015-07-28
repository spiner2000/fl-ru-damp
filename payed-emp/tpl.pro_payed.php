<div class="b-layout b-layout__page b-promo"> 
    <table class="b-layout__table b-layout__table_width_full" cellpadding="0" cellspacing="0" border="0">
        <tr class="b-layout__tr">
            <td class="b-layout__left b-layout__left_center b-layout__left_padtop_80 ">
                <img class="b-promo__pic" src="/images/promo-icons/big/5.png" alt="" />
            </td>
            <td class="b-layout__right b-layout__right_width_72ps">
                <div class="b-menu b-menu_crumbs">
                <ul class="b-menu__list">
                    <li class="b-menu__item"><a href="/service/" class="b-menu__link">Услуги сайта</a>&nbsp;&rarr;&nbsp;</li>
                    <li class="b-menu__item"><a href="/payed-emp/" class="b-menu__link">Аккаунт PRO</a>&nbsp;&rarr;&nbsp;</li>
                </ul>
                </div>                        

                <h1 class="b-page__title">Аккаунт PRO куплен</h1>

                <div class="b-fon b-fon_padbot_30">
                <div class="b-fon__body b-fon__body_pad_10 b-fon__body_padleft_30 b-fon__body_fontsize_13 b-fon__body_bg_f0ffdf">
                    <div class="b-fon__txt b-fon__txt_padbot_5"><span class="b-icon b-icon_sbr_gok b-icon_margleft_-25"></span>Вы успешно приобрели аккаунт PRO.</div>
                    <div class="b-fon__txt">Если у вас возникнут вопросы, обращайтесь в <a class="b-fon__link" href="https://feedback.fl.ru/">службу поддержки.</div>
                </div>
                </div>                          

                <div class="b-layout__txt b-layout__txt_padbot_5">Аккаунт PRO на <span class="b-layout__txt b-layout__txt_bold"><?= $period ?></span> стоил <span class="b-layout__txt b-layout__txt_bold b-layout__txt_color_fd6c30"><?= $cost; ?> рублей</span></div>


                <?
                $teasersExclude = array('public');
                include($abs_path . '/teasers/include-teaser.php');
                ?>

            </td>							
        </tr>
    </table>
</div>