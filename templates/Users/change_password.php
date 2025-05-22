<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h3 class="card-title mb-0"><?= __('Change Password') ?></h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($user, ['class' => 'form']) ?>
                
                <div class="mb-3">
                    <?= $this->Form->control('old_password', [
                        'type' => 'password',
                        'label' => 'Current Password',
                        'class' => 'form-control ',
                        'required' => true,
                        'disabled' => $this->Identity->isAdmin() && !$this->Identity->isMe($user)
                    ]) ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('old_password_repeated', [
                        'type' => 'password',
                        'label' => 'Repeat Password',
                        'class' => 'form-control',
                        'required' => true,
                        'disabled' => $this->Identity->isAdmin() && !$this->Identity->isMe($user)
                    ]) ?>
                </div>
                
                <div class="mb-3">
                    <?= $this->Form->control('new_password', [
                        'type' => 'password',
                        'label' => 'New Password',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>
                
                <div class="d-grid gap-2">
                    <?= $this->Form->button(__('Update Password'), [
                        'class' => 'btn btn-primary btn-lg'
                    ]) ?>
                </div>
                
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>