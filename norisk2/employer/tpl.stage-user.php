<? $pfx = 'frl_'; ?>
Исполнитель&nbsp;&nbsp;

<a href="/users/<?=$sbr->data[$pfx.'login']?>/" class="freelancer-name"><?=($sbr->data[$pfx.'uname'].' '.$sbr->data[$pfx.'usurname'].' ['.$sbr->data[$pfx.'login'].']')?></a>
<? if($sbr->isAdmin()) { ?> <a href="mailto:<?=$sbr->data[$pfx.'email']?>" class="freelancer-name"><?=$sbr->data[$pfx.'email']?></a><? } ?>
<? if($arb_user_id == $sbr->data['frl_id']) { ?>&nbsp;(инициатор)<? } ?>
<? if (hasPermissions('sbr')) {
    $user = new users();
    $user_banned = ($user->GetField($sbr->data[$pfx.'id'], $ban_error, "is_banned", false) > 0) ? true : false;
    if ($user_banned) { ?>
        <span style="color:#000" ><b>Пользователь заблокирован.</b></span>
    <? }
} ?>
<?=view_mark_user($sbr->data, $pfx)?>&nbsp;<?=$session->view_online_status($sbr->data[$pfx.'login'], false, '&nbsp;', $activity)?>