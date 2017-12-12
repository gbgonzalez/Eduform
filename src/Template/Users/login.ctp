<!-- File: src/Template/Users/login.ctp -->


<h1> Alumno pw:Alumno </h1>
<h1> Gestor de contenidos pw:Gestor de contenidos </h1>
<h1> Administrator pw:Administrator </h1>

<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your dni and password') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>