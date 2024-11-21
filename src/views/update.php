<?php $content = ob_start(); ?>


<h1>Modifier la nouvelle tâche</h1>

<form action="/update" method="POST">
    <input type="text" name="task" placeholder="Modifier la tâche">
    <button type="submit">Modifier</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php include 'layout.php' ?>