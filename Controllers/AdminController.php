<?php
namespace App\Controllers;

use Exception;
use App\core\View;
use App\Models\Tag;
use App\Models\Post;
use App\core\Session;
use App\Form\PostForm;
use App\Form\LoginForm;
use App\Helpers\Slugger;
use App\Models\PostsTags;
use App\Helpers\StringHelper;
use App\Repository\TagRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Form\Validator\PostValidator;
use App\Repository\CommentRepository;
use App\Repository\PostsTagsRepository;
use App\Repository\SocialNetworkRepository;

class AdminController{

    private $postRepository;
    private $userRepository;
    private $tagRepository;

    public function __construct(){
        $this->postRepository = new PostRepository;
        $this->userRepository = new UserRepository;
        $this->tagRepository = new TagRepository;
    }
    
    public function connexion($urlParam){
        
        $socialnetworks = (new SocialNetworkRepository)->findAll();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $validation = [];
            
            $user = isset($this->userRepository->findOneBy(['email' => $_POST['email']])[0]) ? 
            $this->userRepository->findOneBy(['email' => $_POST['email']])[0] : null;
            
            
            if(!password_verify($_POST['password'], $user->getPassword())){

                $validation[] = "identifiants non reconnus";

                return View::render('admin/login.html.php', [
                    "form" => (new LoginForm)->build(),
                    "validation" => $validation,
                    "socials" => $socialnetworks
                ]);
            }

            if($user->getRole() != 'admin'){
                $validation[] = "Vous ne disposez pas des droits pour acceder à cet espace";

                return View::render('admin/login.html.php', [
                    "form" => (new LoginForm)->build(),
                    "validation" => $validation,
                    "socials" => $socialnetworks
                ]);
            }

            $session = new Session();
            $session->set('firstname', $user->getFirstname());
            $session->set('lastname', $user->getLastname());
            $session->set('email', $user->getEmail());
            $session->set('role', $user->getRole());
            $session->set('id', $user->getId());
            $session->set('admin', true);

            header('Location:/dashboard');
        }

        return View::render('admin/login.html.php', [
            "form" => (new LoginForm)->build(),
            "socials" => $socialnetworks
        ]);
    }

    public function dashboard(){

        $users = $this->userRepository->findAll();
        $posts = $this->postRepository->findAll();

        $countComments = 0;
        foreach($posts as $post){
            $comments = count((new CommentRepository)->findBy(['post' => $post->getId()]));
            $countComments += $comments;
        }

        return View::render('admin/dashboard.html.php', [
            'users' => $users,
            'countComments' => $countComments,
            'countPosts' => count($posts)
        ]);
    }


    public function createPost(){

        $_SESSION['id'] = 1;
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
            $post->setTitle(StringHelper::sanitize($_POST['title']));
            $post->setChapo(StringHelper::sanitize($_POST['chapo']));
            $post->setContent(StringHelper::sanitize($_POST['content']));
            $post->setAuthor($_SESSION['id']);
            $post->setSlug(StringHelper::sanitize($_POST['title']));
            $post->setCreatedAt((new \Datetime('now'))->format('Y-m-d H:i:s'));
            
            // if a title already exists in database
            if($this->postRepository->findOneBy(['title' => StringHelper::sanitize($_POST['title'])])){
                return View::render('admin/create.html.php', [
                    "form" => $postForm,
                    "validation" => ['Un  article avec le meme titre existe déja, veuillez modifier votre titre']
                ]);
            }

            $this->postRepository->persist($post);
            $post = $this->postRepository->findOneBy(['slug' => $post->getSlug()])[0];

            // create an array of tags
            $tags = explode('#', str_replace(' ', '',  StringHelper::sanitize($_POST['tags'])));
            foreach($tags as $tag){
                // check if tag exists
                $tagEntry = !empty($tag) ? $this->tagRepository->findOneBy(['title' => $tag]) : null;

                // if tag exists
                if($tagEntry != null){
                    // add tag to the new post
                    $postTag = new PostsTags();
                    $postTag->setPost($post->getId());
                    $postTag->setTag($tagEntry[0]->getId());
                    (new PostsTagsRepository)->persist($postTag);
                    
                }else{
                    // create a new tag
                    $tagEntity = new Tag();
                    $tagEntity->setTitle(strtoupper($tag));
                    $this->tagRepository->persist($tagEntity);

                    $tEntity = $this->tagRepository->findOneBy(['title' => $tagEntity->getTitle()])[0];

                    // add the new tag to the post list
                    $postTag = new PostsTags();
                    $postTag->setPost($post->getId());
                    $postTag->setTag($tEntity->getId());
                    (new PostsTagsRepository)->persist($postTag);
                }
            }
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

    public function showPosts(){

        $posts = $this->postRepository->findAll();
        
        return View::render('admin/showPosts.html.php', [
            "posts" => $posts
        ]);
    }

    public function updatePost($slug){

        $post = $this->postRepository->findOneBy(['slug' => $slug])[0];
        $tagList = [];

        foreach($post->getTags() as $tagPost){
            $tagList[] = (new TagRepository)->findOneBy(['id' => $tagPost->getTag()])[0]->getTitle();
        }

        $updateForm = (new PostForm)->build([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'chapo' => $post->getChapo(),
            'tags' => implode('#', $tagList)
        ]);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $validation = PostValidator::checkForm($updateForm, $_POST);
			if ($validation && count($validation) > 0) {
				return View::render('home.html.php', [
                    'post' => $post,
                    'form' => $updateForm,
                    "validation" => $validation
                ]);
			}
            $slug = StringHelper::sanitize(Slugger::sluggify($_POST['title']));

            $post->setTitle(StringHelper::sanitize($_POST['title']));
            $post->setSlug($slug);
            $post->setChapo(StringHelper::sanitize($_POST['chapo']));
            $post->setContent(StringHelper::sanitize($_POST['title']));

            $this->postRepository->persist($post);


            (new PostsTagsRepository)->deleteByPost($post->getId());

            // create an array of tags
            $tags = explode('#', str_replace(' ', '',  $_POST['tags']));
            
            foreach($tags as $tag){
                // check if tag exists
                $tagEntry = $this->tagRepository->findOneBy(['title' => $tag]);
                
                // if tag exists
                if($tagEntry != null){
                    // add tag to the new post
                    $postTag = new PostsTags();
                    $postTag->setPost($post->getId());
                    $postTag->setTag($tagEntry[0]->getId());
                    (new PostsTagsRepository)->persist($postTag);
                }else{
                    // create a new tag
                    $tagEntity = new Tag();
                    $tagEntity->setTitle(strtoupper($tag));
                    $this->tagRepository->persist($tagEntity);

                    $tEntity = $this->tagRepository->findOneBy(['title' => $tagEntity->getTitle()]);

                    // add the new tag to the post list
                    $postTag = new PostsTags();
                    $postTag->setPost($post->getId());
                    $postTag->setTag($tEntity[0]->getId());
                    (new PostsTagsRepository)->persist($postTag);
                }
            }
            $_SESSION['flash'] = "Le post est modifié";

            header("Location:/modifier/post/{$slug}");
        }

        return View::render('admin/updatePost.html.php', [
            'post' => $post,
            'form' => $updateForm
        ]);
    }

    public function deletePost($slug)
    {
        $post = $this->postRepository->findOneBy(['slug' => $slug])[0];

        // delete all relation post/tag relations
        (new PostsTagsRepository)->deleteByPost($post->getId());

        $this->postRepository->delete($post->getId());

        header('Location:/modifier-un-post');
    }
}