<?php
/**
 * Navbar element for the application
 * 
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;
?>
<header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow">
    <?= $this->Html->link(
        Configure::read('App.title'),
        '/',
        ['class' => 'navbar-brand col-md-3 col-lg-2 me-0 px-3']
    ) ?>
    <button
        class="navbar-toggler position-absolute d-md-none collapsed" type="button"
        data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
</header>
