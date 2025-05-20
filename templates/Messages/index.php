<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message[]|\Cake\Collection\CollectionInterface $messages
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('New Message'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('sender_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('receiver_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('reply_to_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
        <th scope="col"><?= $this->Paginator->sort('read') ?></th>
        <th scope="col"><?= $this->Paginator->sort('title') ?></th>
        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message) : ?>
        <tr>
            <td><?= $this->Number->format($message->id) ?></td>
            <td><?= $this->Number->format($message->sender_id) ?></td>
            <td><?= $message->has('user') ? $this->Html->link($message->user->email, ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' ?></td>
            <td><?= $message->has('message') ? $this->Html->link($message->message->title, ['controller' => 'Messages', 'action' => 'view', $message->message->id]) : '' ?></td>
            <td><?= h($message->status) ?></td>
            <td><?= h($message->read) ?></td>
            <td><?= h($message->title) ?></td>
            <td><?= h($message->created) ?></td>
            <td><?= h($message->deleted) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $message->id], ['title' => __('View'), 'class' => 'btn-sm btn-secondary']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $message->id], ['title' => __('Edit'), 'class' => 'btn-sm btn-secondary']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id), 'title' => __('Delete'), 'class' => 'btn-sm btn-danger']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
        <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
        <?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>
