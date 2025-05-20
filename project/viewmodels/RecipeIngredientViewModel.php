<?php
require_once 'models/RecipeIngredient.php';
require_once 'models/Recipe.php';
require_once 'models/Ingredient.php';

class RecipeIngredientViewModel {
    private $model;
    private $recipeModel;
    private $ingredientModel;
    
    public $id;
    public $recipe_id;
    public $ingredient_id;
    public $quantity;
    public $recipe_ingredients = [];
    public $recipes = [];
    public $ingredients = [];
    public $error = "";
    public $success = "";

    public function __construct($db) {
        $this->model = new RecipeIngredient($db);
        $this->recipeModel = new Recipe($db);
        $this->ingredientModel = new Ingredient($db);
    }

    public function getAllRecipeIngredients() {
        $stmt = $this->model->readAll();
        $this->recipe_ingredients = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->recipe_ingredients[] = $row;
        }
        
        return $this->recipe_ingredients;
    }

    public function getRecipeIngredientsByRecipe($recipe_id) {
        $this->model->recipe_id = $recipe_id;
        $stmt = $this->model->readByRecipe();
        $this->recipe_ingredients = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->recipe_ingredients[] = $row;
        }
        
        return $this->recipe_ingredients;
    }

    public function setRecipeId($recipe_id) {
        $this->model->recipe_id = $recipe_id;
    }


    public function getRecipeIngredient($id) {
        $this->model->id = $id;
        if ($this->model->readOne()) {
            $this->id = $id;
            $this->recipe_id = $this->model->recipe_id;
            $this->ingredient_id = $this->model->ingredient_id;
            $this->quantity = $this->model->quantity;
            return true;
        }
        return false;
    }

    public function getAllRecipes() {
        $stmt = $this->recipeModel->readAll();
        $this->recipes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->recipes[] = $row;
        }
        
        return $this->recipes;
    }

    public function getAllIngredients() {
        $stmt = $this->ingredientModel->readAll();
        $this->ingredients = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->ingredients[] = $row;
        }
        
        return $this->ingredients;
    }

    public function createRecipeIngredient($data) {
        if (empty($data['recipe_id']) || empty($data['ingredient_id']) || !isset($data['quantity'])) {
            $this->error = "Recipe ID, Ingredient ID, and Quantity are required";
            return false;
        }

        $this->model->recipe_id = $data['recipe_id'];
        $this->model->ingredient_id = $data['ingredient_id'];
        $this->model->quantity = $data['quantity'];

        if ($this->model->create()) {
            $this->success = "Recipe ingredient added successfully";
            return true;
        } else {
            $this->error = "Unable to add recipe ingredient";
            return false;
        }
    }

    public function updateRecipeIngredient($data) {
        if (empty($data['id']) || empty($data['recipe_id']) || empty($data['ingredient_id']) || !isset($data['quantity'])) {
            $this->error = "ID, Recipe ID, Ingredient ID, and Quantity are required";
            return false;
        }

        $this->model->id = $data['id'];
        $this->model->recipe_id = $data['recipe_id'];
        $this->model->ingredient_id = $data['ingredient_id'];
        $this->model->quantity = $data['quantity'];

        if ($this->model->update()) {
            $this->success = "Recipe ingredient updated successfully";
            return true;
        } else {
            $this->error = "Unable to update recipe ingredient";
            return false;
        }
    }

    public function deleteRecipeIngredient($id) {
        $this->model->id = $id;
        
        if ($this->model->delete()) {
            $this->success = "Recipe ingredient deleted successfully";
            return true;
        } else {
            $this->error = "Unable to delete recipe ingredient";
            return false;
        }
    }
}
?>