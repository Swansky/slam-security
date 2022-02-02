<?php
declare(strict_types=1);

const QUERY_INSERT = "INSERT INTO comment (id, username, comment,date) VALUES (NULL, :username, :comment,:date) ";
const QUERY_DELETE = "DELETE FROM comment WHERE id = :id ";
const QUERY_INDEX = "SELECT * FROM comment";

class Comment extends Model
{
    private int $id;
    private string $username;
    private string $content;
    private DateTime $date;


    public function create(): void
    {
        $stmt1 = $this->pdo->prepare(QUERY_INSERT);
        $stmt1->bindValue(':username', $this->username);
        $stmt1->bindValue(':comment', $this->content);
        $stmt1->bindValue(':date', $this->date->format( 'Y-m-d H:i:s'),PDO::PARAM_STR);
        if ($stmt1->execute()) {
            $this->id = (int)$this->pdo->lastInsertId();
        }
    }


    public function read(): array
    {
        $comments = array();
        $stmt1 = $this->pdo->prepare(QUERY_INDEX);
        if ($stmt1->execute()) {
            $rows = $stmt1->fetchAll();
            foreach ($rows as $row) {
                $comment = new Comment();
                $comment->setId($row["id"]);
                $comment->setUsername($row["username"]);
                $comment->setContent($row["comment"]);
                $comment->setDate(DateTime::createFromFormat('Y-m-d H:i:s',$row["date"]));
                array_push($comments,$comment);
            }
        }
        return $comments;
    }

    public function delete()
    {
        $stmt1 = $this->pdo->prepare(QUERY_DELETE);
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
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }


}




