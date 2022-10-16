<?php
namespace App\Controllers;

use App\core\View;
use App\Models\Post;
use App\core\Session;
use App\Helpers\Mail;
use App\Form\PostForm;
use App\Form\LoginForm;
use App\Form\ContactForm;
use App\Repository\UserRepository;
use App\Form\Validator\PostValidator;
use App\Form\Validator\ContactValidator;
use App\Repository\PostRepository;
use App\Repository\SocialNetworkRepository;


class AdminController{

    public function connexion($urlParam){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$validation = [];

            $user = isset((new UserRepository)->findOneBy(['email' => $_POST['email']])[0]) ? 
                (new UserRepository)->findOneBy(['email' => $_POST['email']])[0] : null;

            if(!password_verify($_POST['password'], $user->getPassword())){

                $validation[] = "identifiants non reconnus";

                return View::render('admin/login.html.php', [
                    "form" => (new LoginForm)->build(),
                    "validation" => $validation
                ]);
            }

            if($user->getRole() != 'admin'){
                $validation[] = "Vous ne disposez pas des droits pour acceder à cet espace";

                return View::render('admin/login.html.php', [
                    "form" => (new LoginForm)->build(),
                    "validation" => $validation
                ]);
            }

            $session = new Session();
            $session->set('firstname',$_POST['firstname']);
            $session->set('lastname', $_POST['firstname']);
            $session->set('email', $_POST['email']);
            $session->set('role', $user->getRole());

            header('Location:/dashboard');
        }

        return View::render('admin/login.html.php', [
            "form" => (new LoginForm)->build()
        ]);
    }

    public function dashboard(){

        return View::render('admin/dashboard.html.php', []);
    }

    public function createPost(){

        $postForm = (new PostForm)->build();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$validation = PostValidator::checkForm($postForm, $_POST);

			if ($validation && count($validation) > 0) {
				return View::render('admin/create.html.php', [
                    "form" => $postForm,
                    "validation" => $validation
                ]);
			}

            $post = new Post();
            $post->setTitle($_POST['title']);
            $post->setChapo($_POST['chapo']);
            $post->setContent($_POST['content']);
            $post->setAuthor($_SESSION['id']);
            $post->setSlug($_POST['title']);
            $post->setCreatedAt((new \Datetime('now'))->format('Y-m-d H:i:s'));

            (new PostRepository)->persist($post);

            $success = "Post crée avec succès";

            return View::render('admin/create.html.php', [
                "form" => $postForm,
                "success" => $success
            ]);
        }

        return View::render('admin/create.html.php', [
            "form" => $postForm
        ]);
    }
}