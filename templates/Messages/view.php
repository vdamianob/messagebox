<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Message'), ['action' => 'edit', $message->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete Message'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Messages'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('New Message'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Messages'), ['controller' => 'Messages', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Message'), ['controller' => 'Messages', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="messages view large-9 medium-8 columns content">
    <h3><?= h($message->title) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('User') ?></th>
                <td><?= $message->has('user') ? $this->Html->link($message->user->email, ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Message') ?></th>
                <td><?= $message->has('message') ? $this->Html->link($message->message->title, ['controller' => 'Messages', 'action' => 'view', $message->message->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Status') ?></th>
                <td><?= h($message->status) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($message->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($message->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sender Id') ?></th>
                <td><?= $this->Number->format($message->sender_id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($message->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Deleted') ?></th>
                <td><?= h($message->deleted) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Read') ?></th>
                <td><?= $message->read ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
    </div>
    <div class="text">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($message->body)); ?>
    </div>
</div>
