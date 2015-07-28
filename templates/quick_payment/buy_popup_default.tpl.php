<?php
/**
 * Шаблон поумолчанию popup-окна "быстрой" оплаты
 */
?>
<div id="<?=@$popup_id?>" data-quick-payment="<?=$unic_name?>" class="b-shadow b-shadow_block b-shadow_center b-shadow_width_520 <?=(!@$is_show)?'b-shadow_hide':'' ?> b-shadow__quick">
    <div class="b-shadow__body b-shadow__body_pad_15_20">
        
        <div class="b-fon <?=@$popup_title_class_bg?>">
            <div class="b-layout__title b-layout__title_padbot_5">
                <span class="b-icon b-page__desktop b-page__ipad b-icon_float_left b-icon_top_4 <?=@$popup_title_class_icon?>"></span>
                <?=@$popup_title?>
                <div class="b-layout__txt b-layout__txt_fontsize_11 b-layout__txt_lineheight_1 b-page__destop b-page__ipad">
                    <?=@$popup_subtitle?>
                </div>
            </div>
        </div>

        <div class="b-layout <?php //b-layout_waiting ?>">
            <div class="b-layout__txt b-layout__txt_padbot_15 b-layout__txt_fontsize_15">
                <?=@$items_title?>
            </div>  
<?php 
            if(!empty($items)): 
?>
            <form>
            <div class="b-radio b-radio_padleft_20">
                <?php foreach($items as $key => $item):
                        $input_id = "{$item['name']}_{$key}";
                ?>
                <div class="b-radio__item b-radio__item_padbot_10 b-radio__item_inline-block b-radio__item_width_200">
                    <input<?=(@$item['checked'])?' checked':''?><?=(@$item['disabled'])?' disabled':''?> type="radio" onclick="" id="<?=$input_id?>" name="<?=@$item['name']?>" value="<?=@$item['value']?>" class="b-radio__input" />
                    <?php if(@$item['disabled'] && @$item['checked']): ?>
                    <input type="hidden" name="<?=@$item['name']?>" value="<?=@$item['value']?>" />
                    <?php endif; ?>
                    <label class="b-radio__label b-radio__label_fontsize_13 b-radio__label_margtop_-2<?=(@$item['checked'])?' b-radio__label_color_6db335':''?>" for="<?=$input_id?>">
                        <span id="" class="b-layout__bold">
                            <?=@$item['title']?>
                        </span>
                        <div class="b-layout__txt b-layout__txt_fontsize_11 b-layout__txt_inline_iphone<?=(@$item['checked'])?' b-layout__txt_color_6db335':''?>">
                            <?=@$item['subtitle']?>&nbsp;
                        </div>
                    </label>
                </div>
                <?php endforeach; ?>
            </div>
            </form>
<?php
            endif;
?>
            <div class="b-layout__txt b-layout__txt_padtb_10 b-layout__txt_fontsize_15">
                <?=@$payments_title ?>
            </div>
            
            <div data-quick-payment-error-screen="true" class="b-fon b-fon_margbot_20 b-fon_marglr_20 b-layout_hide">
                <div class="b-fon__body b-fon__body_pad_10 b-fon__body_padleft_30 b-fon__body_fontsize_13 b-fon__body_bg_ffeeee"> 
                    <span class="b-icon b-icon_sbr_rattent b-icon_margleft_-20"></span>
                    <span data-quick-payment-error-msg="true"></span>
                </div>
            </div>
            
            <div class="b-layout__txt b-layout__txt_padleft_20 b-layout__txt_fontsize_11">
                Сумма к оплате: <span><?=@$reserve_price?></span>.<br/>
            </div>
            <div class="b-layout__txt b-layout__txt_padbot_20 b-layout__txt_padleft_20 b-layout__txt_fontsize_11">
                Ее вы можете оплатить одним из способов:
            </div>
<?php
            if(!empty($payments)):
?>
            <div>
                <div class="b-buttons b-buttons_padleft_20 b-buttons_padbot_10"> 
                    <?php foreach($payments as $key => $payment): ?>
                    <a class="b-button b-button_margbot_5 b-button__pm <?=@$payment['class']?>" 
                       href="javascript:void(0);" 
                       <?=(isset($payment['wait']))?'data-quick-payment-wait="'.$payment['wait'].'"':''?> 
                       data-quick-payment-type="<?=$key?>"><span class="b-button__txt"><?=@$payment['title']?></span></a> 
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div data-quick-payment-wait-screen="true" class="b-layout__wait b-layout__txt_fontsize_15 b-layout__txt_color_6db335 b-layout_hide">
                <span data-quick-payment-wait-msg="true"></span>
                <div class="b-layout__txt b-layout__txt_center b-layout__txt_padtb_10">
                    <img width="80" height="20" src="/images/Green_timer.gif">
                </div>
            </div>
            
            <div data-quick-payment-success-screen="true" class="b-layout__success b-layout__txt_fontsize_15 b-layout__txt_color_323232 b-layout_hide">
                <span data-quick-payment-success-msg="true"></span>
                <div class="b-buttons b-buttons_center b-button_margtop_15">
                    <a data-quick-payment-close="true" href="javascript:void(0);" class="b-button b-button_flat b-button_flat_green">Закрыть</a>
                </div>
            </div>
            
            <div class="__quick_payment_form b-layout_hide"></div>
<?php
            endif;
?>
            
        </div>
    </div>
    <span class="b-shadow__icon b-shadow__icon_close"></span>
</div>