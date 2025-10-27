<?php
// app/models/Medicine.php
require_once __DIR__ . '/../config/database.php';

class Medicine {
    private $conn;
    public function __construct(){
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll(){
        $sql = "SELECT MedicineID, MedicineCode, MedicineName, StockQuantity, UnitPrice, ExpiryDate FROM dbo.Medicine ORDER BY MedicineName";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id){
        $sql = "SELECT * FROM dbo.Medicine WHERE MedicineID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function decreaseStock($id, $qty){
        $sql = "UPDATE dbo.Medicine SET StockQuantity = StockQuantity - :qty WHERE MedicineID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['qty' => $qty, 'id' => $id]);
    }
}
?>