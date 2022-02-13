<?php
declare(strict_types=1);

const QUERY_INSERT_IMAGE = "INSERT INTO image (id,imageType, imageData) VALUES (NULL,:type, :data) ";
const QUERY_SELECT_IMAGE_BY_ID = "SELECT * FROM image WHERE id = :id LIMIT 1";
const QUERY_DELETE_IMAGE = "DELETE FROM image WHERE id = :id ";

class Image extends Model
{
    private int $id;
    private mixed $imageData;
    private string $imageType;


    public function create(): void
    {
        $stmt1 = $this->pdo->prepare(QUERY_INSERT_IMAGE);
        $stmt1->bindValue(':data', $this->imageData);
        $stmt1->bindValue(':type', $this->imageType);
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
            $this->imageType = $this->data["imageType"];
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

    /**
     * @return string
     */
    public function getImageType(): string
    {
        return $this->imageType;
    }

    /**
     * @param string $imageType
     */
    public function setImageType(string $imageType): void
    {
        $this->imageType = $imageType;
    }


}




