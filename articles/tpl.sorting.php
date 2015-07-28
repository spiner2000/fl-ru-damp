<?
/*
 * блок сортировки в статьях
 * в этом же блоке находится кнопка ДОБАВИТЬ СТАТЬЮ
 * требует глобальную переменную $ord - ключ к массиву $sorting
 */

$sorting = array(
    'date' => 'по дате добавления',
    'comm' => 'по количеству комментариев',
    'views' => 'по количеству просмотров',
    'rating' => 'по оценке',
);

?>
<div class="ai-sort c">
    <? if(hasPermissions('articles')) { ?>
    <div class="i-add">
        <div>
            <span>
                <b class="b1"></b>
                <b class="b2"></b>
                <span class="i-add-in">
                    <a href="javascript:void(0)" onclick="addArticleForm(0,1)">Добавить статью</a>
                </span>
                <b class="b2"></b>
                <b class="b1"></b>
            </span>
        </div>
    </div>
    <? } ?>
    <noindex>

    <div class="<?=hasPermissions('articles')?"i-sort4":"i-sort3"?>">
        <strong>Сортировать:</strong>
        <ul>
            <? foreach($sorting as $k => $label) { ?>
                <? if($k == $ord) { ?>
                    <li class="active"><?=$label?></li>
                <? } else { ?>
                    <li><a rel="nofollow" href="<?= url('ord,p,page,tag', array('ord' => $k, 'p' => 1), 0, '?') ?>" class="lnk-dot-666"><?=$label?></a></li>
                <? } ?>
            <? } ?>
            <? if(hasPermissions('articles')) { ?>
            <li><a rel="nofollow" href="?page=declined" class="lnk-dot-red">отклонены</a></li>
            <? } ?>        
        </ul>
    </div>
    </noindex>
</div>
