<?php $content = ob_start(); 
    $id = $_GET["id"];
?>


<h1>Modifier la nouvelle tâche</h1>

<form action="/update?id=<?=$id ?>" method="POST">
    <input type="text" name="task" placeholder="Modifier la tâche">
    
    <button type="submit">Modifier</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php include 'layout.php' ?>