<?php

namespace App\Models;

class Todo extends Model
{
    public function getALL()
    /**
     * Récupère toutes les tâches dans la BDD
     */
    {
        //Récupérer les tâches deouis la BDD
        $query = $this -> db->query("SELECT * FROM todos"); //preépre la requête
        return $query->fetchAll(); //retourner le résultat de l'exécution de la requête
    }



    /**
     * Ajout d'une nouvelle tâche
     * @param mixed $task
     * @return bool
     */
    public function create($task)
    {
        //Prépare la requête SQL pour insérer un nouvelle tâche dans la table "todos".
        //Les placeholders `:task` et `done` sont utilisés pour éviter les iinjections SQL.
        //Cela sécurise les données entrés par l'utilisateur
        $stmt = $this -> db->prepare("INSERT INTO todos(task,done) VALUES(:task, :done); "); //prépare la requête
        //Exécute la requête préparée avec les valeurs spécifiques fournies dans un tableau associatif
        // - `:task` contient la description de la tâche saisie par l'user
        // - `:done` est initialisé à 0 (indiquand que la tâche n'est pas encore)
        return $stmt->execute([":task" => $task, ":done" => 0]);
        //exécution de la requête
    }


    /**
     * Summary of toggle
     * @param int $id L'identifiant de la tâche àsupprimer
     * @return void
     */
    public function toggle($id)
    {
        $stmt = $this -> db->prepare("UPDATE todos SET done = NOT done WHERE id = :id");
        $stmt->execute(["id" => (int) $id]);
    }


    /**
     * *Supprime une tâche
     * @param int  $id l'identifiant de la tâche a supprimé
     * @return bool
     */
    public function delete($id)
    {

        $stmt = $this -> db->prepare("DELETE FROM todos WHERE id = :id;");
        return $stmt->execute(["id" => (int) $id]);
    }

    public function update($id, $task){
        $stmt = $this -> db -> prepare("UPDATE todos SET task = :task WHERE id = :id;");
        $stmt -> execute ([":task" => $task,":id"=> (int)$id]);
    }
}
