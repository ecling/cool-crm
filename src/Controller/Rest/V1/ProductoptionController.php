<?php
namespace App\Controller\Rest\V1;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
/**
 * @Route("/V1")
 */
class ProductoptionController extends FOSRestController
{
    /**
     * @Route("/productoption/add", name="add_option")
     */
    public function postOptionAction(Request $request)
    {
        $postData = $request->request->all();

        $em = $this->getDoctrine()->getManager();

        $sql = "SELECT * FROM product_option_vale WHERE option_code='".$postData['option_name']."' AND `value`='".$postData['value']."'";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $option_result = $statement->fetch();
        if($option_result){
            $error = array('code'=>'4000','message'=>'属性值已经存在');
            return $error;
        }else{
            $row = [];
            if($postData['option_name']=='size'){
                $row['option_name'] = 'Size';
                $row['option_code'] = 'size';
            }else{
                $row['option_name'] = 'Color';
                $row['option_code'] = 'color';
            }
            $row['value'] = $postData['value'];
            $em->getConnection()->insert('product_option_vale',$row);
        }

        return $postData;
    }

    /**
     * @Route("/productoption/list", name="get_options")
     */
    public function getOptionsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $total_sql = 'SELECT count(value_id) as cnt FROM product_option_vale';
        $statement = $em->getConnection()->prepare($total_sql);
        $statement->execute();
        $total_result = $statement->fetch();

        $page = $request->query->get('page');
        $limit = $request->query->get('limit');
        $sql = "SELECT * FROM product_option_vale order by option_code DESC limit ".($page-1)*$limit.",".$limit;
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $item_result = $statement->fetchAll();

        $result = array(
            'data' => array(
                'items' => $item_result,
                'total' => (int)$total_result['cnt']
            )
        );
        return $result;
    }
}