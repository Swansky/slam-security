<?php

class CommentController extends Controller
{
    private const MAX_SIZE_CONTENT = 2000;
    private const MAX_SIZE_USERNAME = 255;

    public function loadView()
    {
        $comment = new Comment();
        $errorMessage = "";
        if (isset($_POST["username"]) && isset($_POST["content"])) {
            $username = ParamUtils::findPOSTParam('username');
            $content = ParamUtils::findPOSTParam('content');
            if (strlen($username) > self::MAX_SIZE_USERNAME || strlen($content) > self::MAX_SIZE_CONTENT) {
                $errorMessage = "invalid size of message or username";
            } else {
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
                "date" => $commentElement->getDate()
            );
            $commentsResult[] = $viewComment;
        }
        ViewManager::view("comment-template", ["comments" => $commentsResult, "errorMessage" => $errorMessage]);
    }


    public function default()
    {
        $this->loadView();
    }

}
