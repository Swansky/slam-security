<?php
declare(strict_types=1);

const QUERY_INSERT_IMAGE = "INSERT INTO image (id, imageData) VALUES (NULL, :data) ";
const QUERY_SELECT_IMAGE_BY_ID = "SELECT * FROM image WHERE id = :id LIMIT 1";
const QUERY_DELETE_IMAGE = "DELETE FROM image WHERE id = :id ";

class Image extends Model
{
    private int $id;
    private mixed $imageData;


    public function create(): void
    {
        $stmt1 = $this->pdo->prepare(QUERY_INSERT_IMAGE);
        $stmt1->bindValue(':data', $this->imageData);
        if ($stmt1->execute()) {
            $this->id = (int)$this->pdo->lastInsertId();
        }
    }


    public function findById(): void
    {
        $stmt1 = $this->pdo->prepare(QUERY_SELECT_IMAGE_BY_ID);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
            $this->id = $this->data["id"];
            $this->imageData = $this->data["imageData"];
        }
    }


    public function delete()
    {
        $stmt1 = $this->pdo->prepare(QUERY_DELETE_IMAGE);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getImageData(): mixed
    {
        return $this->imageData;
    }

    /**
     * @param mixed $imageData
     */
    public function setImageData(mixed $imageData): void
    {
        $this->imageData = $imageData;
    }


}




