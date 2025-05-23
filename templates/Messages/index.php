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

<?php $this->start('tb_actions_header'); ?>
<div class="btn-group">
    <?= $this->Html->link(
        '<i class="fas fa-plus"></i> ' . __('Add'),
        ['action' => 'add'],
        ['class' => 'btn btn-success', 'escape' => false]
    ) ?>
</div>
<?php $this->end(); ?>

<div class="mb-4">
    <div class="card">
        <div class="card-body">
            <?php echo $this->Form->create(null, ['type' => 'get', 'valueSources' => 'query']); ?>
            <div class="row">
                <div class="col-md-9 mb-3">
                    <?php echo $this->Form->control('cercatesto', [
                        'label' => 'Search',
                        'class' => 'form-control',
                        'placeholder' => 'Search in title or body'
                    ]); ?>
                    
                    <div class="mt-2">
                        <label class="d-block">Filter by</label>
                        <div class="d-flex align-items-center">
                            <?php
                            echo $this->Form->radio('filtratipo', 
                                [
                                    'all' => 'All',
                                    'inbox' => 'Inbox',
                                    'sent' => 'Sent'
                                ], 
                                [
                                    'value' => $radiochoise ?? 'all',
                                    'hiddenField' => false,
                                    'label' => true,
                                    'class' => 'me-1 mx-1',
                                    'templates' => [
                                        'radioWrapper' => '<div class="form-check form-check-inline">{{input}}{{label}}</div>',
                                        'label' => '<label class="form-check-label" {{attrs}}>{{text}}</label>',
                                        'input' => '<input type="radio" class="form-check-input" {{attrs}}/>',
                                    ]
                                ]
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end justify-content-start">
                    <?php echo $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-sm btn-primary me-2']); ?>
                    <?php echo $this->Html->link('Reset', ['action' => 'index'], ['class' => 'btn btn-sm btn-outline-secondary']); ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('title') ?></th>
        <th scope="col"><?= $this->Paginator->sort('sender_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('receiver_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('sent') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message) : ?>
        <tr>
            <td>
                <?= $this->Html->link(h($message->title), ['action' => 'view', $message->id], ['class' => 'link-dark']) ?>
                <?php if (!$message->read && $message->receiver_id === $this->request->getAttribute('identity')->id): ?>
                    <?php 
                        echo $this->Html->badge('NEW!', [
                            'class' => 'rounded-pill bg-primary',
                        ]);
                    ?>
                <?php endif; ?>
            </td>
            <td><?= $this->Html->link(h($message->sender->username), ['controller' => 'Users', 'action' => 'view', $message->sender_id], ['class' => 'link-dark']) ?></td>
            <td><?= $this->Html->link(h($message->receiver->username), ['controller' => 'Users', 'action' => 'view', $message->receiver_id], ['class' => 'link-dark']) ?></td>
            <td><?= h($message->created) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $message->id], ['title' => __('View'), 'class' => 'btn btn-sm btn-secondary my-1']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $message->id], ['title' => __('Edit'), 'class' => 'btn btn-sm btn-secondary my-1']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id), 'title' => __('Delete'), 'class' => 'btn btn-sm btn-danger my-1']) ?>
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
