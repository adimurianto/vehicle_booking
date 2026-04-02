<table id="tbl-menu-akses" class="table table-striped table-hover">
    <thead>
        <tr>
            <th colspan="3">Menu</th>
            <th style="width: 30px" class="center">
              <!-- view                   <div class="checkbox-wrap">
                                        <label for="delete_all" style="width:22px; padding:0px;">
                                          <input type="checkbox" id="allView" class="chk-parentview">
                                          <div class="checkbox-box" style="position:relative !important">
                                              <svg class="icon-cross">
                                                <use xurl:href="#svg-cross"></use>
                                              </svg>
                                          </div>
                                        </label>                          
                                    </div> -->
              view <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                    <input type="checkbox" class="chk-parentview" id="allView"><span></span>
                  </label> 
            </th>
            <th style="width: 30px" class="center">
              add <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                    <input type="checkbox" class="chk-parentadd" id="allAdd" ><span></span>
                  </label> 
            </th>
            <th style="width: 30px" class="center">
              edit <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                    <input type="checkbox" class="chk-parentedit" id="allEdit" ><span></span>
                  </label> 
            </th>
            <th style="width: 30px" class="center">
              delete <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                    <input type="checkbox" class="chk-parentdelete" id="allDelete" ><span></span>
                  </label> 
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($main_menu as $mm): ?>
            <?php if ($mm->url == '#'): ?>
                <tr class="table-primary">
                    <td colspan="3"><?= $mm->name ?></td>
                    <td style="width: 30px" class="center">
                      <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                        <input name="chkMenuID[]" type="checkbox" value="<?= $mm->id?>" <?= (in_array($mm->id, $getArray)? 'checked':'')?> class="chk-childview <?php echo $mm->id ?>" data-add="parentadd<?php echo $mm->id ?>" data-update="parentedit<?php echo $mm->id ?>" 
                      data-delete="parentdelete<?php echo $mm->id ?>" data-id="<?php echo $mm->id ?>" id="parentview<?php echo $mm->id ?>"><span></span>
                      </label>
                    </td>

                    <td style="width: 30px" class="center">
                      <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                        <input name="chkAddBtn[]" type="checkbox" value="<?= $mm->id ?>" <?= (in_array($mm->id, $addBtn)? 'checked':'')?> class="chk-childadd" data-view="parentview<?php echo $mm->id ?>" data-id="<?php echo $mm->id ?>" id="parentadd<?php echo $mm->id ?>"><span></span>
                      </label>
                    </td>

                    <td style="width: 30px" class="center">
                      <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                        <input name="chkEditBtn[]" type="checkbox" value="<?= $mm->id?>" <?= (in_array($mm->id, $editBtn)? 'checked':'')?>
                      class="chk-childedit" data-view="parentview<?php echo $mm->id ?>" data-id="<?php echo $mm->id ?>" id="parentedit<?php echo $mm->id ?>"><span></span>
                      </label>
                    </td>

                    <td style="width: 30px" class="center">
                      <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                        <input name="chkDeleteBtn[]" type="checkbox" value="<?= $mm->id?>" <?= (in_array($mm->id, $deleteBtn) ? 'checked':'')?>
                      class="chk-childdelete" data-view="parentview<?php echo $mm->id ?>" data-id="<?php echo $mm->id ?>" id="parentdelete<?php echo $mm->id ?>"><span></span>
                      </label>
                    </td>
                </tr>
                <?php foreach ($second_menu as $sm): ?>
                    <?php if ($sm->parent == $mm->id): ?>
                            <tr>
                                <td style="width: 30px" class="center"></td>
                                <td colspan="2"><?= $sm->name ?></td>
                                <td style="width: 30px" class="center">
                                  <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                                    <input name="chkMenuID[]" type="checkbox" value="<?= $sm->id?>" <?= (in_array($sm->id, $getArray)? 'checked':'')?>
                                  class="chk-childview <?php echo $mm->id ?>" data-add="childadd<?php echo $sm->id; ?>" data-update="childedit<?php echo $sm->id; ?>" 
                                  data-delete="childdelete<?php echo $sm->id; ?>" data-id="<?php echo $mm->id ?>" id="childview<?php echo $sm->id; ?>"><span></span>
                                  </label>
                                </td>

                                <td style="width: 30px" class="center">
                                  <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                                    <input name="chkAddBtn[]" type="checkbox" value="<?= $sm->id?>" <?= (in_array($sm->id, $addBtn)? 'checked':'')?>
                                  class="chk-childadd" data-view="childview<?php echo $sm->id ?>" data-id="<?php echo $mm->id ?>" id="childadd<?php echo $sm->id; ?>"><span></span>
                                  </label>
                                </td>

                                <td style="width: 30px" class="center">
                                  <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                                    <input name="chkEditBtn[]" type="checkbox" value="<?= $sm->id?>" <?= (in_array($sm->id, $editBtn)? 'checked':'')?>
                                  class="chk-childedit" data-view="childview<?php echo $sm->id ?>" data-id="<?php echo $mm->id ?>" id="childedit<?php echo $sm->id; ?>"><span></span>
                                  </label>
                                </td>

                                <td style="width: 30px" class="center">
                                  <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                                    <input name="chkDeleteBtn[]" type="checkbox" value="<?= $sm->id?>" <?= (in_array($sm->id, $deleteBtn)? 'checked':'')?>
                                  class="chk-childdelete" data-view="childview<?php echo $sm->id ?>" data-id="<?php echo $mm->id ?>" id="childdelete<?php echo $sm->id; ?>"><span></span>
                                  </label>
                                </td>
                            </tr>
                        <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="table-primary">
                    <td colspan="3"><?= $mm->name ?></td>
                    
                    <td style="width: 30px" class="center">
                      <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                        <input name="chkMenuID[]" type="checkbox" value="<?= $mm->id?>" <?= (in_array($mm->id, $getArray)? 'checked':'')?>
                      class="chk-childview <?php echo $mm->id ?>" data-add="thirdadd<?php echo $mm->id; ?>" data-update="thirdedit<?php echo $mm->id ?>" 
                      data-delete="thirddelete<?php echo $mm->id; ?>" data-id="<?php echo $mm->id ?>" data-id="<?php echo $mm->id ?>" id="thirdview<?php echo $mm->id; ?>" /><span></span>
                      </label>
                    </td>
                    
                    <td style="width: 30px" class="center">
                      <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                        <input name="chkAddBtn[]" type="checkbox" value="<?= $mm->id?>" <?= (in_array($mm->id, $addBtn)? 'checked':'')?>
                      class="chk-childadd" data-view="thirdview<?php echo $mm->id; ?>" data-id="<?php echo $mm->id ?>" id="thirdadd<?php echo $mm->id; ?>" /><span></span>
                      </label>
                    </td>

                    <td style="width: 30px" class="center">
                      <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                        <input name="chkEditBtn[]" type="checkbox" value="<?= $mm->id?>" <?= (in_array($mm->id, $editBtn)? 'checked':'')?>
                      class="chk-childedit" data-view="thirdview<?php echo $mm->id; ?>" data-id="<?php echo $mm->id ?>" id="thirdedit<?php echo $mm->id; ?>" /><span></span>
                      </label>
                    </td>

                    <td style="width: 30px" class="center">
                      <label class="ckbox ckbox-pink" style="margin-bottom:0px;">
                        <input name="chkDeleteBtn[]" type="checkbox" value="<?= $mm->id?>" <?= (in_array($mm->id, $deleteBtn) ? 'checked':'')?>
                      class="chk-childdelete" data-view="thirdview<?php echo $mm->id; ?>" data-id="<?php echo $mm->id ?>" id="thirddelete<?php echo $mm->id; ?>" /><span></span>
                      </label>
                    </td>
                </tr>

            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
$('#tbl-menu-akses').ready( function (){
  countviewbox();
  countaddbox();
  countupdatebox();
  countdeletebox();

  $('.chk-parentview').click(function (){
      var th_checked = this.checked;
      if(th_checked){ $('.chk-childview').prop('checked', true);}
      else{ $('.chk-childview').click();}
  });
  
  $('.chk-childview').click(function (){
      var id = $(this).attr('data-id');
      var check_add = $(this).attr('data-add');
      var check_update = $(this).attr('data-update');
      var check_delete = $(this).attr('data-delete');
      var get = document.getElementsByClassName('chk-childview');
      var con = 0;
      for (i=0;i<get.length;i++){
          con += get[i].checked;
      }
      if($(this).prop('checked')){
        $('#parentview'+id).prop('checked',true);
      }else{
        // if(con == 1){
        //   $('#parentview'+id).prop('checked',false);
        // }else{
        //   $('#parentview'+id).prop('checked',true);
        // }
        $('#parentview'+id).prop('checked',false);

        if($('#'+check_add).prop('checked')){
          $('#'+check_add).click();
        }
        if($('#'+check_update).prop('checked')){
          $('#'+check_update).click();
        }
        if($('#'+check_delete).prop('checked')){
          $('#'+check_delete).click();
        }
      }
      if(con === get.length){
        $('.chk-parentview').prop('checked', true);
      }else{
        $('.chk-parentview').prop('checked', false);
      }
  });

  $('.chk-parentadd').click(function (){
      var th_checked = this.checked;
      if(th_checked){ $('.chk-childadd').prop('checked', true);}
      else{ $('.chk-childadd').prop('checked', false);}
  });

  $('.chk-childadd').click(function (){
      var get = document.getElementsByClassName('chk-childadd');
      var view = $(this).attr('data-view');      
      var con = 0;
      for (i=0;i<get.length;i++){
          con += get[i].checked;
      }

      if($(this).prop('checked')){ //check if this checked
        if(!$('#'+view).prop('checked')){
          $('#'+view).click();
        }
      }

      if(con === get.length){ //check if checkbox add all checked
        $('.chk-parentadd').prop('checked', true);
      }
      else{ 
        $('.chk-parentadd').prop('checked', false);
      }
  });

  $('.chk-parentedit').click(function (){
      var th_checked = this.checked;
      if(th_checked){ $('.chk-childedit').prop('checked', true);}
      else{ $('.chk-childedit').prop('checked', false);}
  });

  $('.chk-childedit').click(function (){
      var get = document.getElementsByClassName('chk-childedit');
      var view = $(this).attr('data-view');      
      var con = 0;
      for (i=0;i<get.length;i++){
          con += get[i].checked;
      }

      if($(this).prop('checked')){ //check if this checked
        if(!$('#'+view).prop('checked')){
          $('#'+view).click();
        }
      }

      if(con === get.length){ //check if checkbox update all checked
        $('.chk-parentedit').prop('checked', true);
      }else{ 
        $('.chk-parentedit').prop('checked', false);
      }
  });

  $('.chk-parentdelete').click(function (){
      var th_checked = this.checked;
      if(th_checked){ $('.chk-childdelete').prop('checked', true);}
      else{ $('.chk-childdelete').prop('checked', false);}
  });

  $('.chk-childdelete').click(function (){
      var get = document.getElementsByClassName('chk-childdelete');
      var view = $(this).attr('data-view');      
      var con = 0;
      for (i=0;i<get.length;i++){
          con += get[i].checked;
      }

      if($(this).prop('checked')){ //check if this checked
        if(!$('#'+view).prop('checked')){
          $('#'+view).click();
        }
      }
      
      if(con === get.length){ //check if checkbox delete all checked
        $('.chk-parentdelete').prop('checked', true);
      }else{ 
        $('.chk-parentdelete').prop('checked', false);
      }
  });

  function countviewbox(){
    var viewbox = $('.chk-childview');
    var con = 0;
    for (i=0;i<viewbox.length;i++){
      con += viewbox[i].checked;
    }
    if(con === viewbox.length){
      $('.chk-parentview').prop('checked', true);
    }else{
      $('.chk-parentview').prop('checked', false);
    }
  }

  function countaddbox(){
    var addbox = $('.chk-childadd');
    var con = 0;
    for (i=0;i<addbox.length;i++){
      con += addbox[i].checked;
    }
    if(con === addbox.length){
      $('.chk-parentadd').prop('checked', true);
    }else{
      $('.chk-parentadd').prop('checked', false);
    }
  }

  function countupdatebox(){
    var updatebox = $('.chk-childedit');
    var con = 0;
    for (i=0;i<updatebox.length;i++){
      con += updatebox[i].checked;
    }
    if(con === updatebox.length){
      $('.chk-parentedit').prop('checked', true);
    }else{
      $('.chk-parentedit').prop('checked', false);
    }
  }

  function countdeletebox(){
    var deletebox = $('.chk-childdelete');
    var con = 0;
    for (i=0;i<deletebox.length;i++){
      con += deletebox[i].checked;
    }
    if(con === deletebox.length){
      $('.chk-parentdelete').prop('checked', true);
    }else{
      $('.chk-parentdelete').prop('checked', false);
    }
  }
});

</script>
