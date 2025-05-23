<?php
/**
 * Sidebar element for the application
 * 
 * @var \Cake\View\View $this
 */
?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="">
    <div class="position-sticky pt-3">
        <?= $this->fetch('tb_sidebar') ?>
        
        <div class="border-top my-3"></div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link text-danger']) ?>
            </li>
        </ul>
    </div>
</nav>
