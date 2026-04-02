<ul class="menu small">
    <?php foreach($second_menu as $sm): ?>
    <li class="menu-item">
        <a class="menu-item-link text-tooltip-tfr text-tooltip-sidebar-custom" href="<?php echo $sm->url; ?>" data-title="<?php echo $sm->name; ?>"> 
            <svg class="menu-item-link-icon icon-newsfeed">
                <use xlink:href="#svg-newsfeed"></use>
            </svg>
        </a>
    </li>
    <?php endforeach; ?>
</ul>