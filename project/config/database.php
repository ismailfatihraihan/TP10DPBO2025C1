<?php
class Database {
    private $host = "localhost";
    private $db_name = "recipe_management";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }

    public function createTables() {
        $connection = $this->getConnection();
        
        // Create recipes table
        $recipeTable = "CREATE TABLE IF NOT EXISTS recipes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            instructions TEXT
        )";
        
        // Create ingredients table
        $ingredientTable = "CREATE TABLE IF NOT EXISTS ingredients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            unit VARCHAR(50)
        )";
        
        // Create recipe_ingredients table
        $recipeIngredientTable = "CREATE TABLE IF NOT EXISTS recipe_ingredients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            recipe_id INT,
            ingredient_id INT,
            quantity DECIMAL(10,2) NOT NULL,
            FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE,
            FOREIGN KEY (ingredient_id) REFERENCES ingredients(id) ON DELETE CASCADE
        )";
        
        try {
            $connection->exec($recipeTable);
            $connection->exec($ingredientTable);
            $connection->exec($recipeIngredientTable);
            return true;
        } catch(PDOException $e) {
            echo "Table creation error: " . $e->getMessage();
            return false;
        }
    }
}
?>