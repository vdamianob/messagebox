<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="users form content">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                <?php
                    echo $this->Form->control('email');
                    echo $this->Form->control('role');
                    echo $this->Form->control('status');
                    echo $this->Form->control('username');
                    echo $this->Form->control('avatar_img_path');
                    echo $this->Form->control('note');
                    //echo $this->Form->control('deleted', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary mt-3']) ?>
            <?= $this->Html->link(__('Change Password'), ['action' => 'changePassword', $user->id], ['class' => 'btn btn-secondary mt-3 ms-2']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
