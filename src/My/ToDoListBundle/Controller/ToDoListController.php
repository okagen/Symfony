<?php

namespace My\ToDoListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use My\ToDoListBundle\Entity\Post;

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

    /**
     * @Route("/new", name="todo_new")
     */
    public function newAction(Request $request)
    {
        $post = $post = new Post();
        
        //フォームを作るメソッド createFormBuilder
        $form = $this->createFormBuilder($post)
            ->add('title')
            ->add('note')
            ->add('deadline')
            ->getForm();

        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            // バリデーション
            if ($form->isValid()) {
                $post = $form->getData();
                $post->setCreatedAt(new \DateTime());
                $post->setUpdatedAt(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('todo_index'));
            }
        }

        return array(
            'post' => $post,
            'form' => $form->createView(),
         );
    }

    /**
      * @Route("/{id}/delete", name="todo_delete")
      */
     function deleteAction($id)
     {
         $em = $this->getDoctrine()->getEntityManager();
         $post = $em->getRepository('MyToDoListBundle:Post')->find($id);
         if (!$post) {
             throw $this->createNotFoundException('The item does not exist');
         }
         // 削除
         $em->remove($post);
         $em->flush();

         return $this->redirect($this->generateUrl('todo_index'));
      }

    /**
    * @Route("/{id}/edit", name="todo_edit")
    */
    public function editAction(Request $request, $id)
    {
    // DBから取得
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('MyToDoListBundle:Post')->find($id);
        if (!$post) {
            throw $this->createNotFoundException('The item does not exist');
        }
        // フォームの組立
        $form = $this->createFormBuilder($post)
        ->add('title')
        ->add('note')
        ->add('deadline')
        ->getForm();

        // バリデーション
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            if ($form->isValid()) {
            // 更新されたエンティティをデータベースに保存
                $post = $form->getData();
                $post->setUpdatedAt(new \DateTime());
                $em->flush();
                return $this->redirect($this->generateUrl('todo_index'));
            }
        }
        return array(
            'post' => $post,
            'form' => $form->createView(),
            );
    }

}
