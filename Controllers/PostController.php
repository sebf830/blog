<?php
namespace App\Controllers;

use App\core\View;
use App\Models\Comment;
use App\Form\CommentForm;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Form\Validator\CommentValidator;
use App\Repository\SocialNetworkRepository;


class PostController{

    public function index($urlParam){

        $socialnetworks = (new SocialNetworkRepository)->findAll();

        $posts = (new PostRepository)->findAll();

        return View::render('post/index.html.php', [
            "socials" => $socialnetworks,
            "posts" => $posts
        ]);
    }

    public function show($slug){

        $_SESSION['id'] = 1;

        $socialnetworks = (new SocialNetworkRepository)->findAll();
        $post = (new PostRepository)->findOneBy(['slug' => $slug])[0];
        $author = (new UserRepository)->findOneBy(['id' => 1])[0];

        $commentForm = (new CommentForm())->build();
        $comments = (new CommentRepository)->getCommentsByPost($author->getId(), $post->getId());

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $validation = CommentValidator::checkForm($commentForm, $_POST);

			// send errors
			if ($validation && count($validation) > 0) {
				return View::render('post/show.html.php', [
                    "socials" => $socialnetworks,
                    "form" => $commentForm,
                    "post" => $post,
                    "author" => $author,
                    "validation" => $validation
                ]);
			}

            $comment = new Comment();
            $comment->setTitle($_POST['title']);
            $comment->setContent($_POST['content']);
            $comment->setCreatedAt((new \Datetime('now'))->format('Y-m-d H:i:s'));
            $comment->setAuthor($_SESSION['id']);
            $comment->setPost($post->getId());

            (new CommentRepository())->persist($comment);

            $_SESSION['flash'] = "votre commentaire est enregistré";

            header("Location:/post/{$post->getSlug()}");
        }


        return View::render('post/show.html.php', [
            "socials" => $socialnetworks,
            "post" => $post,
            "author" => $author,
            "form" => $commentForm,
            "comments" => $comments
        ]);
    }
}