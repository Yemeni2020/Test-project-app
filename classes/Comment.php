<?php
class Comment {
    private $conn;
    private $table_name = "comments";

    public $id;
    public $user_id;
    public $content_id;
    public $comment;
    public $timestamp;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, content_id=:content_id, comment=:comment, timestamp=:timestamp";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":content_id", $this->content_id);
        $stmt->bindParam(":comment", $this->comment);
        $stmt->bindParam(":timestamp", $this->timestamp);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET comment = :comment WHERE id = :id AND user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":comment", $this->comment);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);

        return $stmt->execute();
    }

    public function fetchComments($content_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE content_id = :content_id ORDER BY timestamp DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":content_id", $content_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>