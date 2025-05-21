<!-- in /templates/Users/login.php -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 mt-5">
            <div class="card shadow">
                <div class="card-body">
                    <?= $this->Flash->render() ?>
                    <h3 class="card-title text-center mb-4"><?= __('Login') ?></h3>
                    
                    <?= $this->Form->create(null, ['class' => '']) ?>
                    <fieldset>
                        <legend class="sr-only"><?= __('Please enter your username and password') ?></legend>
                        <?= $this->Form->control('email', [
                            'required' => true,
                            'label' => __('Email'),
                            'type' => 'email',
                            'class' => 'form-control'
                        ]) ?>
                        <?= $this->Form->control('password', [
                            'required' => true,
                            'label' => __('Password'),
                            'class' => 'form-control'
                        ]) ?>
                    </fieldset>
                    <div class="d-grid gap-2 mt-3">
                        <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?= $this->Form->end() ?>

                    <div class="mt-3 text-center">
                        <?= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-link']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
