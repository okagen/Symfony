<?php

namespace My\ToDoListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * @Route("/todo")
 * @Template()
 */
class ToDoListController extends Controller
{
    /**
     * @Route("/", name="todo_index")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getManager();
        $posts = $em->getRepository('MyToDoListBundle:Post')->findAll();

        return array('posts' => $posts);
    }

    /**
     * @Route("/{id}/detail", name="todo_detail")
     */
    public function detailAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $post = $em->getRepository('MyToDoListBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('The note does not exist');
        }
        return array('post' => $post);
    }
}
