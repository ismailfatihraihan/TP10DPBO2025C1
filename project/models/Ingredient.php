<?php
class Ingredient {
    private $conn;
    private $table_name = "ingredients";

    public $id;
    public $name;
    public $unit;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create ingredient
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, unit) VALUES (:name, :unit)";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->unit = htmlspecialchars(strip_tags($this->unit));

        // Bind parameters
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":unit", $this->unit);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Read all ingredients
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read single ingredient
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->name = $row['name'];
            $this->unit = $row['unit'];
            return true;
        }
        return false;
    }

    // Update ingredient
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, unit = :unit WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->unit = htmlspecialchars(strip_tags($this->unit));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":unit", $this->unit);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete ingredient
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
}
?>