   <?php foreach ($files as $file): ?>
      <?=date('d.m.Y в H:i', strtotime($file['modified']))?> - 
      <a class="b-layout__link b-layout__link_color_000" 
         href="<?=WDCPREFIX.'/'.$file['path'].$file['fname']?>" 
         target="_blank"><?=$file['original_name']?></a>
      <br/>
   <?php endforeach; ?>