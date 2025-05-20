<?php
// Include database configuration
require_once 'config/database.php';

// Include models
require_once 'models/Recipe.php';
require_once 'models/Ingredient.php';
require_once 'models/RecipeIngredient.php';

// Include viewmodels
require_once 'viewmodels/RecipeViewModel.php';
require_once 'viewmodels/IngredientViewModel.php';
require_once 'viewmodels/RecipeIngredientViewModel.php';

// Initialize database
$database = new Database();
$db = $database->getConnection();

// Create tables if they don't exist
$database->createTables();

// Get view and action from URL
$view = isset($_GET['view']) ? $_GET['view'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Initialize viewModel based on view
$viewModel = null;
switch ($view) {
    case 'recipes':
        $viewModel = new RecipeViewModel($db);
        break;
    case 'ingredients':
        $viewModel = new IngredientViewModel($db);
        break;
    case 'recipe_ingredients':
        $viewModel = new RecipeIngredientViewModel($db);
        break;
    default:
        // For home page, use RecipeViewModel as default
        $viewModel = new RecipeViewModel($db);
        break;
}

// Process form submissions and actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($view) {
        case 'recipes':
            if ($action === 'create') {
                $viewModel->createRecipe($_POST);
                header('Location: index.php?view=recipes');
                exit;
            } elseif ($action === 'edit') {
                $viewModel->updateRecipe($_POST);
                header('Location: index.php?view=recipes');
                exit;
            }
            break;
        case 'ingredients':
            if ($action === 'create') {
                $viewModel->createIngredient($_POST);
                header('Location: index.php?view=ingredients');
                exit;
            } elseif ($action === 'edit') {
                $viewModel->updateIngredient($_POST);
                header('Location: index.php?view=ingredients');
                exit;
            }
            break;
        case 'recipe_ingredients':
            // Fixed code
            if ($action === 'create') {
                $viewModel->createRecipeIngredient($_POST);
                if (isset($_POST['recipe_id'])) {
                    header('Location: index.php?view=recipes&action=view&id=' . $_POST['recipe_id']);
                } else {
                    header('Location: index.php?view=recipe_ingredients');
                }
                exit;
            } elseif ($action === 'edit') {
                $viewModel->updateRecipeIngredient($_POST);
                header('Location: index.php?view=recipe_ingredients');
                exit;
            }
            break;
    }
}

// Handle GET actions
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($view) {
        case 'recipes':
            if ($action === 'delete' && isset($_GET['id'])) {
                $viewModel->deleteRecipe($_GET['id']);
                header('Location: index.php?view=recipes');
                exit;
            } elseif ($action === 'edit' && isset($_GET['id'])) {
                $viewModel->getRecipe($_GET['id']);
            } elseif ($action === 'view' && isset($_GET['id'])) {
                $viewModel->getRecipe($_GET['id']);
                // Get recipe ingredients for the view page
                $recipeIngredientViewModel = new RecipeIngredientViewModel($db);
                $recipeIngredientViewModel->setRecipeId($_GET['id']);
                // $recipeIngredientViewModel->model->recipe_id = $_GET['id'];
                $recipeIngredients = $recipeIngredientViewModel->getRecipeIngredientsByRecipe($_GET['id']);
            }
            break;
        case 'ingredients':
            if ($action === 'delete' && isset($_GET['id'])) {
                $viewModel->deleteIngredient($_GET['id']);
                header('Location: index.php?view=ingredients');
                exit;
            } elseif ($action === 'edit' && isset($_GET['id'])) {
                $viewModel->getIngredient($_GET['id']);
            }
            break;
        case 'recipe_ingredients':
            if ($action === 'delete' && isset($_GET['id'])) {
                $viewModel->deleteRecipeIngredient($_GET['id']);
                if (isset($_GET['redirect']) && $_GET['redirect'] === 'recipe' && isset($_GET['recipe_id'])) {
                    header('Location: index.php?view=recipes&action=view&id=' . $_GET['recipe_id']);
                } else {
                    header('Location: index.php?view=recipe_ingredients');
                }
                exit;
            } elseif ($action === 'edit' && isset($_GET['id'])) {
                $viewModel->getRecipeIngredient($_GET['id']);
                $viewModel->getAllRecipes();
                $viewModel->getAllIngredients();
            } elseif ($action === 'create') {
                $viewModel->getAllRecipes();
                $viewModel->getAllIngredients();
            }
            break;
    }
}

// Load data for index views
if ($action === 'index') {
    switch ($view) {
        case 'recipes':
            $viewModel->getAllRecipes();
            break;
        case 'ingredients':
            $viewModel->getAllIngredients();
            break;
        case 'recipe_ingredients':
            $viewModel->getAllRecipeIngredients();
            break;
    }
}

// Determine which view file to include
$content = '';
switch ($view) {
    case 'recipes':
        switch ($action) {
            case 'create':
                $content = 'views/recipes/create.php';
                break;
            case 'edit':
                $content = 'views/recipes/edit.php';
                break;
            case 'view':
                $content = 'views/recipes/view.php';
                break;
            default:
                $content = 'views/recipes/index.php';
                break;
        }
        break;
    case 'ingredients':
        switch ($action) {
            case 'create':
                $content = 'views/ingredients/create.php';
                break;
            case 'edit':
                $content = 'views/ingredients/edit.php';
                break;
            default:
                $content = 'views/ingredients/index.php';
                break;
        }
        break;
    case 'recipe_ingredients':
        switch ($action) {
            case 'create':
                $content = 'views/recipe_ingredients/create.php';
                break;
            case 'edit':
                $content = 'views/recipe_ingredients/edit.php';
                break;
            default:
                $content = 'views/recipe_ingredients/index.php';
                break;
        }
        break;
    default:
        $content = 'views/home.php';
        break;
}

// Include the layout with the content
include 'views/layout.php';
?>