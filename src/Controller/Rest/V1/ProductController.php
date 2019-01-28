<?php
namespace App\Controller\Rest\V1;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Entity\Product;
/**
 * @Route("/V1")
 */
class ProductController extends FOSRestController
{
    protected $_domain = 'http://localhost:8001/media/catalog/product/';
    /**
     * @Route("/product/add", name="add_product")
     */
    public function postProductAction(Request $request)
    {
        $postData = $request->request->all();

        $em = $this->getDoctrine()->getManager();

        $main_image = [];
        if(isset($postData['main_image'])){
            foreach ($postData['main_image'] as $img){
                if(isset($img['response'])) {
                    $main_image[] = $img['response']['name'];
                }else{
                    $main_image[] = $img['name'];
                }
            }
        }

        $addition_images = [];
        if(isset($postData['addition_images'])){
            foreach ($postData['addition_images'] as $img){

                if(isset($img['response'])) {
                    $addition_images[] = $img['response']['name'];
                }else{
                    $addition_images[] = $img['name'];
                }
            }
        }

        $product = new Product();
        $product->setSku($postData['sku']);
        $product->setPurchasePrice($postData['purchase_price']);
        $product->setShippingCost($postData['shipping_cost']);
        $product->setWeight($postData['weight']);
        $product->setQty($postData['qty']);
        $product->setName($postData['name']);
        $product->setDescription($postData['description']);
        $product->setColor($postData['color']);
        $product->setSize($postData['size']);
        $product->setMainImage([]);
        $product->setAdditionImages($addition_images);
        $product->setCategoryIds($postData['category_ids']);
        $product->setCategory2Ids($postData['category2_ids']);
        $product->setWebsiteIds($postData['website_ids']);
        $product->setStatus(1);
        $product->setCreatedAt(date('Y-m-d H:i:s',time()));
        $em->persist($product);
        $em->flush();

        return $product;
        //return $request;
    }

    /**
     * @Route("/product/update", name="update_product")
     */
    public function updateProductAction(Request $request){
        $postData = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($postData['product_id']);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$postData['product_id']
            );
        }

        $main_image = [];
        if(isset($postData['main_image'])){
            foreach ($postData['main_image'] as $img){
                if(isset($img['response'])) {
                    $main_image[] = $img['response']['name'];
                }else{
                    $main_image[] = $img['name'];
                }
            }
        }

        $addition_images = [];
        if(isset($postData['addition_images'])){
            foreach ($postData['addition_images'] as $img){

                if(isset($img['response'])) {
                    $addition_images[] = $img['response']['name'];
                }else{
                    $addition_images[] = $img['name'];
                }
            }
        }

        $product->setSku($postData['sku']);
        $product->setPurchasePrice($postData['purchase_price']);
        $product->setShippingCost($postData['shipping_cost']);
        $product->setWeight($postData['weight']);
        $product->setQty($postData['qty']);
        $product->setName($postData['name']);
        $product->setDescription($postData['description']);
        $product->setColor($postData['color']);
        $product->setSize($postData['size']);
        $product->setMainImage($main_image);
        $product->setAdditionImages($addition_images);
        $product->setCategoryIds($postData['category_ids']);
        $product->setCategory2Ids($postData['category2_ids']);
        $product->setWebsiteIds($postData['website_ids']);
        $product->setStatus(1);

        $em->flush();

        //return $request->request->all();
        return $postData['addition_images'];
        //return $product;
    }

    /**
     * @Route("/product/list", name="get_products")
     */
    public function getProductsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $total_sql = 'SELECT count(product_id) as cnt FROM product where `status`!=0';
        $statement = $em->getConnection()->prepare($total_sql);
        $statement->execute();
        $total_result = $statement->fetch();

        $page = $request->query->get('page');
        $limit = $request->query->get('limit');
        $sql = "SELECT * FROM product where `status`!=0 limit ".($page-1)*$limit.",".$limit;
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $item_result = $statement->fetchAll();

        foreach ($item_result as $key=>$_item){

            if(!empty($_item['size'])){
                $_item['size'] = explode(',',$_item['size']);
            }else{
                $_item['size'] = [];
            }
            if(!empty($_item['color'])){
                $_item['color'] = explode(',',$_item['color']);
            }else{
                $_item['color'] = [];
            }
            if(!empty($_item['category_ids'])){
                $_item['category_ids'] = explode(',',$_item['category_ids']);
            }else{
                $_item['category_ids'] = [];
            }
            if(!empty($_item['category2_ids'])){
                $_item['category2_ids'] = explode(',',$_item['category2_ids']);
            }else{
                $_item['category2_ids'] = [];
            }
            if(!empty($_item['website_ids'])){
                $_item['website_ids'] = explode(',',$_item['website_ids']);
            }else{
                $_item['website_ids'] = [];
            }
            if(!empty($_item['main_image'])){
                $_item['main_image'] = explode(',',$_item['main_image']);
                $_tempimg = [];
                foreach ($_item['main_image'] as $_img) {
                    $_tempimg[] = array('name'=>$_img,'url'=>$this->_domain.$_img);
                }
                $_item['main_image'] = $_tempimg;
            }else{
                $_item['main_image'] = [];
            }
            if(!empty($_item['addition_images'])){
                $_item['addition_images'] = explode(',',$_item['addition_images']);
                $_tempimg = [];
                foreach ($_item['addition_images'] as $_img) {
                    $_tempimg[] = array('name'=>$_img,'url'=>$this->_domain.$_img);
                }
                $_item['addition_images'] = $_tempimg;
            }else{
                $_item['addition_images'] = [];
            }
            $item_result[$key] = $_item;
        }

        $result = array(
            'data' => array(
                'items' => $item_result,
                'total' => $total_result['cnt']
            )
        );

        return $result;
    }

    /**
     * @Route("/product/image", name="post_product_image")
     */
    public function postProductImage()
    {
        if($_FILES['file']['type']=='image/jpeg'){
            //图片小于10M
            if($_FILES['file']['size']<100000){
                if ($_FILES["file"]["error"] > 0){

                }else{
                    $time = time();
                    $file_name = uniqid().'.jpg';
                    $dir = date('Y',$time).'/'.date('m',$time).'/'.date('d');
                    $file_dir = getcwd().'/media/catalog/product/'.$dir;
                    if (!file_exists($file_dir)){
                        mkdir($file_dir,0777,true);
                    }
                    move_uploaded_file($_FILES["file"]["tmp_name"],$file_dir.'/'.$file_name);
                }
            }
        }

        if(isset($file_name)){
            $result = array('name'=>$dir.'/'.$file_name,'url'=>$this->_domain.$dir.'/'.$file_name);
            return $result;
        }else{
            throw $this->createNotFoundException(
                'image upload fail'
            );
        }
        //$test = $_FILES['file'];
        //return $test;
    }

    /**
     * @Route("/product/options", name="get_product_options")
     */
    public function getProductOptions()
    {
        $em = $this->getDoctrine()->getManager();

        $sql = "SELECT * FROM `product_option_vale`";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $item_result = $statement->fetchAll();
        $options = [];
        foreach ($item_result as $_option){
            $options[$_option['option_code']][] = array('id'=>$_option['value_id'],'name'=>$_option['value']);
        }
        return $options;
    }

    /**
     * @Route("/product/categorys", name="get_product_categorys")
     */
    public function getCategorys()
    {
        $em = $this->getDoctrine()->getManager();

        $sql = "SELECT * FROM `sys_category` WHERE `status`=1";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $item_result = $statement->fetchAll();

        return $this->getTree(3,$item_result);
    }

    protected function getTree($parent_id,$items)
    {
        $tree = array();
        foreach ($items as $_item) {
            $tem_arr = array();
            if($_item['parent_id']==$parent_id){
                $tem_arr = array(
                    'value' => $_item['category_id'],
                    'label' => $_item['name'],
                );
                if($children = $this->getTree($_item['category_id'],$items)){
                    $tem_arr['children'] = $children;
                }
                $tree[] = $tem_arr;
            }
        }
        return $tree;
    }

    /**
     * @Route("/product/website", name="get_product_website")
     */
    public function getWebsite()
    {
        $em = $this->getDoctrine()->getManager();

        $sql = "SELECT website_id,website_name FROM `website`";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $item_result = $statement->fetchAll();
        return $item_result;
    }

    /**
     * @Route("/product/{id}", name="get_product")
     */
    public function getProductAction()
    {

    }
}