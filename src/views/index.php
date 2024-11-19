<?php ob_start() ?>


<h1>Ma Todo List</h1>
<a href="/add">Ajouter une nouvelle tâche</a>
<ul>
    <li>
        <span>Apprendre HTML</span>
        <a href="">✅</a>
        <a href="">❌</a>
    </li>
</ul>

<?php $container = ob_get_clean() ?>

<?php include 'layout.php' ?>