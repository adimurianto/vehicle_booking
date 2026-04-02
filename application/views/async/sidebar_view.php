<ul class="nav-main">
  <?php foreach ($main_menu as $mm) :
        if ($mm->url == "#") :
  ?>
    <li class="nav-main-heading">
      <i class="<?php echo $mm->icon; ?>"></i> 
      <span class="sidebar-mini-visible">
        <?php echo $mm->name; ?>
      </span>
      <span class="sidebar-mini-hidden">
        <?php echo $mm->name; ?>
      </span>
    </li>

    <?php foreach($second_menu as $sm): ?>
    <?php if($sm->parent == $mm->id): ?>
      <?php 
        $menu_link = explode("/",$sm->url); 
        $menu_name = (count($menu_link) >= 1) ? $menu_link[0] : "";
      ?>
    <li class="menu-item <?php echo ($menu_name == $current_menu) ? 'active' : ''; ?>">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="<?php echo site_url($sm->url); ?>">
          <!-- MENU ITEM LINK ICON -->
          <i class="menu-item-link-icon <?php echo $sm->icon; ?>"></i>
          <!-- /MENU ITEM LINK ICON -->
          <span class="sidebar-mini-hide">
            <?php echo $sm->name; ?>
          </span>
        </a>
        <!-- /MENU ITEM LINK -->
    </li>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php else: ?>
      <?php 
        $menu_link = explode("/",$mm->url); 
        $menu_name = (count($menu_link) >= 1) ? $menu_link[0] : "";
      ?>
      <li class="menu-item <?php echo ($menu_name == $current_menu) ? 'active' : ''; ?>">
        <!-- MENU ITEM LINK -->
        <a class="menu-item-link" href="<?php echo site_url($mm->url); ?>">
          <!-- MENU ITEM LINK ICON -->
          <i class="menu-item-link-icon <?php echo $mm->icon; ?>"></i>
          <!-- /MENU ITEM LINK ICON -->
          <span class="sidebar-mini-hide">
            <?php echo $mm->name; ?>
          </span>
        </a>
        <!-- /MENU ITEM LINK -->
      </li>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>