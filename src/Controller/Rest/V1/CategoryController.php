<?php
namespace App\Controller\Rest\V1;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Entity\Book;
use App\Form\BookType;
/**
 * @Route("/V1")
 */
class CategoryController extends FOSRestController
{
    /**
     * @Route("/category/add", name="add_category")
     */
    public function postCategoryAction(Request $request)
    {
        //$test = array('taobao'=>10,'jd'=>30);
        //$test = 10;
        //return $test;
        //return $request->request->all();
        //return $request;
    }

    /**
     * @Route("/category/tree", name="get_category_tree")
     */
    public function getTreeAction()
    {

    }

    /**
     * @Route("/category/webtree", name="get_web_category_tree")
     */
    public function getWebCateTreeAction(){

    }

    /**
     * @Route("/category/systree", name="get_sys_category_tree")
     */
    public function getSysCateTreeAction(){

    }

    /**
     * @Route("/category/{id}", name="get_category")
     */
    public function getCategoryAction()
    {

    }
}
