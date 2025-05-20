<?php
class RecipeIngredient {
    private $conn;
    private $table_name = "recipe_ingredients";

    public $id;
    public $recipe_id;
    public $ingredient_id;
    public $quantity;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create recipe ingredient
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (recipe_id, ingredient_id, quantity) VALUES (:recipe_id, :ingredient_id, :quantity)";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));
        $this->ingredient_id = htmlspecialchars(strip_tags($this->ingredient_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        // Bind parameters
        $stmt->bindParam(":recipe_id", $this->recipe_id);
        $stmt->bindParam(":ingredient_id", $this->ingredient_id);
        $stmt->bindParam(":quantity", $this->quantity);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Read all recipe ingredients
    public function readAll() {
        $query = "SELECT ri.id, ri.recipe_id, ri.ingredient_id, ri.quantity, r.name as recipe_name, i.name as ingredient_name, i.unit 
                FROM " . $this->table_name . " ri
                LEFT JOIN recipes r ON ri.recipe_id = r.id
                LEFT JOIN ingredients i ON ri.ingredient_id = i.id
                ORDER BY r.name, i.name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read ingredients for a specific recipe
    public function readByRecipe() {
        $query = "SELECT ri.id, ri.recipe_id, ri.ingredient_id, ri.quantity, i.name as ingredient_name, i.unit 
                FROM " . $this->table_name . " ri
                LEFT JOIN ingredients i ON ri.ingredient_id = i.id
                WHERE ri.recipe_id = :recipe_id
                ORDER BY i.name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":recipe_id", $this->recipe_id);
        $stmt->execute();
        return $stmt;
    }

    // Read single recipe ingredient
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->recipe_id = $row['recipe_id'];
            $this->ingredient_id = $row['ingredient_id'];
            $this->quantity = $row['quantity'];
            return true;
        }
        return false;
    }

    // Update recipe ingredient
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET recipe_id = :recipe_id, ingredient_id = :ingredient_id, quantity = :quantity WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));
        $this->ingredient_id = htmlspecialchars(strip_tags($this->ingredient_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(":recipe_id", $this->recipe_id);
        $stmt->bindParam(":ingredient_id", $this->ingredient_id);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete recipe ingredient
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameter
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete all ingredients for a recipe
    public function deleteByRecipe() {
        $query = "DELETE FROM " . $this->table_name . " WHERE recipe_id = :recipe_id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->recipe_id = htmlspecialchars(strip_tags($this->recipe_id));

        // Bind parameter
        $stmt->bindParam(":recipe_id", $this->recipe_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>