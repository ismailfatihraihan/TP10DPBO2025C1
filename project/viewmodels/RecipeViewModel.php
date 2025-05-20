<?php
require_once 'models/Recipe.php';

class RecipeViewModel {
    private $model;
    public $id;
    public $name;
    public $description;
    public $instructions;
    public $recipes = [];
    public $error = "";
    public $success = "";

    public function __construct($db) {
        $this->model = new Recipe($db);
    }

    public function getAllRecipes() {
        $stmt = $this->model->readAll();
        $this->recipes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->recipes[] = $row;
        }
        
        return $this->recipes;
    }

    public function getRecipe($id) {
        $this->model->id = $id;
        if ($this->model->readOne()) {
            $this->id = $id;
            $this->name = $this->model->name;
            $this->description = $this->model->description;
            $this->instructions = $this->model->instructions;
            return true;
        }
        return false;
    }

    public function createRecipe($data) {
        if (empty($data['name'])) {
            $this->error = "Recipe name is required";
            return false;
        }

        $this->model->name = $data['name'];
        $this->model->description = $data['description'] ?? '';
        $this->model->instructions = $data['instructions'] ?? '';

        if ($this->model->create()) {
            $this->success = "Recipe created successfully";
            return true;
        } else {
            $this->error = "Unable to create recipe";
            return false;
        }
    }

    public function updateRecipe($data) {
        if (empty($data['id']) || empty($data['name'])) {
            $this->error = "Recipe ID and name are required";
            return false;
        }

        $this->model->id = $data['id'];
        $this->model->name = $data['name'];
        $this->model->description = $data['description'] ?? '';
        $this->model->instructions = $data['instructions'] ?? '';

        if ($this->model->update()) {
            $this->success = "Recipe updated successfully";
            return true;
        } else {
            $this->error = "Unable to update recipe";
            return false;
        }
    }

    public function deleteRecipe($id) {
        $this->model->id = $id;
        
        if ($this->model->delete()) {
            $this->success = "Recipe deleted successfully";
            return true;
        } else {
            $this->error = "Unable to delete recipe";
            return false;
        }
    }
}
?>