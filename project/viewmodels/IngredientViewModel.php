<?php
require_once 'models/Ingredient.php';

class IngredientViewModel {
    private $model;
    public $id;
    public $name;
    public $unit;
    public $ingredients = [];
    public $error = "";
    public $success = "";

    public function __construct($db) {
        $this->model = new Ingredient($db);
    }

    public function getAllIngredients() {
        $stmt = $this->model->readAll();
        $this->ingredients = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->ingredients[] = $row;
        }
        
        return $this->ingredients;
    }

    public function getIngredient($id) {
        $this->model->id = $id;
        if ($this->model->readOne()) {
            $this->id = $id;
            $this->name = $this->model->name;
            $this->unit = $this->model->unit;
            return true;
        }
        return false;
    }

    public function createIngredient($data) {
        if (empty($data['name'])) {
            $this->error = "Ingredient name is required";
            return false;
        }

        $this->model->name = $data['name'];
        $this->model->unit = $data['unit'] ?? '';

        if ($this->model->create()) {
            $this->success = "Ingredient created successfully";
            return true;
        } else {
            $this->error = "Unable to create ingredient";
            return false;
        }
    }

    public function updateIngredient($data) {
        if (empty($data['id']) || empty($data['name'])) {
            $this->error = "Ingredient ID and name are required";
            return false;
        }

        $this->model->id = $data['id'];
        $this->model->name = $data['name'];
        $this->model->unit = $data['unit'] ?? '';

        if ($this->model->update()) {
            $this->success = "Ingredient updated successfully";
            return true;
        } else {
            $this->error = "Unable to update ingredient";
            return false;
        }
    }

    public function deleteIngredient($id) {
        $this->model->id = $id;
        
        if ($this->model->delete()) {
            $this->success = "Ingredient deleted successfully";
            return true;
        } else {
            $this->error = "Unable to delete ingredient";
            return false;
        }
    }
}
?>