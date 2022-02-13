<?php

class CommentController extends Controller
{
    private const MAX_SIZE_CONTENT = 2000;
    private const MAX_SIZE_USERNAME = 255;
    private const MAX_SIZE_KO_IMAGE = 9_000_000;

    public function loadView()
    {
        $comment = new Comment();
        $errorMessage = "";
        if (isset($_POST["username"]) && isset($_POST["content"]) && isset($_FILES["image"])) {
            $username = ParamUtils::findPOSTParam('username');
            $content = ParamUtils::findPOSTParam('content');
            if (strlen($username) > self::MAX_SIZE_USERNAME || strlen($content) > self::MAX_SIZE_CONTENT ||
                strlen($username) == 0 || strlen($content) == 0 || $_FILES["image"]["size"] > self::MAX_SIZE_KO_IMAGE) {
                $errorMessage = "invalid size of message or username";
            } else {
                if ($_FILES["image"]["size"] > 0) {
                    $MY_FILE = $_FILES['image']['tmp_name'];
                    $file = fopen($MY_FILE, 'r');
                    $file_contents = fread($file, filesize($MY_FILE));
                    fclose($file);
                    $image = new Image();
                    $image->setImageType($_FILES["image"]["type"]);
                    $image->setImageData($file_contents);
                    $image->create();
                    $comment->setImageId($image->getId());
                }
                $comment->setUsername($username);
                $comment->setContent($content);
                $comment->setDate(new DateTime());
                $comment->create();
            }
        }


        $commentsResult = array();
        foreach ($comment->read() as $commentElement) {
            $viewComment = array(
                "username" => $commentElement->getUsername(),
                "content" => $commentElement->getContent(),
                "date" => $commentElement->getDate(),
                "image" => $this->generateImageTag($commentElement)
            );
            $commentsResult[] = $viewComment;
        }
        ViewManager::view("comment-template", ["comments" => $commentsResult, "errorMessage" => $errorMessage]);
    }


    public function default()
    {
        $this->loadView();
    }

    private function generateImageTag(Comment $commentElement): string
    {
        if ($commentElement->getImageId() !== null) {
            $image = new Image();
            $image->setId($commentElement->getImageId());
            $image->findById();
            return '<img src="data:' . $image->getImageType() . ';base64,' . base64_encode($image->getImageData()) . '"/>';
        }
        return "";
    }

}
