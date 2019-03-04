<?php
namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 *
 *
 *
 */
class ProductUpdate extends ContainerAwareCommand{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('product:update');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine');

        //查询待上传产品，站点状态为3，产品状态为1
        $sql = "SELECT pw.*,w.* FROM `product_website` AS pw
LEFT JOIN `product` AS p ON pw.`product_id`=p.`product_id`
LEFT JOIN `website` AS w ON w.`website_id`= pw.`website_id`
WHERE pw.`online_status`=6 AND p.`status`=1
LIMIT 1";
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $product_website = $statement->fetch();

        if($product_website){
            $product_id = $product_website['product_id'];
            $product_sql = "SELECT * FROM product AS p
LEFT JOIN product_lang AS l ON p.product_id=l.product_id
WHERE p.product_id=$product_id
LIMIT 1;";
            $statement = $em->getConnection()->prepare($product_sql);
            $statement->execute();
            $product = $statement->fetch();

            if(empty($product['category_ids'])){
                $category_ids = [];
            }else{
                $category_ids = explode(',',$product['category_ids']);
            }
            if(empty($product['category2_ids'])){
                $category2_ids = [];
            }else{
                $category2_ids = explode(',',$product['category2_ids']);
            }
            $categorys = array_merge($category_ids,$category2_ids);
            //网站根目录
            $categorys[] = 2;

            $client = new \SoapClient($product_website['api_url']);
            $session = $client->login($product_website['api_user'], $product_website['api_key']);

            try{
                //如果查询状态是6，则查询产品是否存在
                $result = $client->call($session, 'catalog_product.info', $product['sku']);
                $online_product_id = $result['product_id'];
            }catch (\Exception $e) {
                $fail_message = $e->getMessage();
                $update_row = array(
                    'fail_message' => $fail_message,
                    'online_status' => 3
                );
                $em->getConnection()->update('product_website', $update_row, array('website_id' => $product_website['website_id'], 'product_id' => $product_id));
            }

            try {
                //产品基础资料更新
                /*
                $result = $client->call($session, 'catalog_product.create', array('simple', 4, $product['sku'], array(
                    'categories' => $categorys,
                    'websites' => array(1),
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'weight' => $product['weight'],
                    'status' => '1',
                    'visibility' => '4',
                    'price' => $product['purchase_price'],
                    'purchase_price' => $product['purchase_price'],
                    'shipping_cost' => $product['shipping_cost'],
                    'tax_class_id' => 1,
                    'options_container' => 'container1',
                    'stock_data' => array('qty' => $product['qty'], 'is_in_stock' => 1, 'manage_stock' => 1, 'use_config_manage_stock ' => 1)
                )));
                */


                if(isset($online_product_id)) {
                    //options 上傳
                    if ($product['color'] != $product_website['online_color'] || $product['size'] != $product_website['online_size']) {
                        $result = $client->call($session, 'product_custom_option.list', $online_product_id);
                        if (is_array($result)) {
                            foreach ($result as $_option) {
                                $result = $client->call($session, "product_custom_option.remove", array($_option['option_id']));
                            }
                        }


                        $option_sql = "SELECT * FROM `product_option_vale`";
                        $statement = $em->getConnection()->prepare($option_sql);
                        $statement->execute();
                        $product_options = $statement->fetchAll();
                        $options = [];
                        foreach ($product_options as $_option) {
                            $options[$_option['value_id']] = $_option;
                        }
                        //颜色
                        if (!empty($product['color'])) {
                            $color_arr = explode(',', $product['color']);
                            $color_values = [];
                            foreach ($color_arr as $key => $_color) {
                                $color_values[] = array(
                                    "title" => $options[$_color]['value'],
                                    "price_type" => "fixed",
                                    "sort_order" => $key
                                );
                            }

                            if (!empty($color_values)) {
                                $customColorDropdownOption = array(
                                    "title" => "Color",
                                    "type" => "drop_down",
                                    "is_require" => 1,
                                    "sort_order" => 10,
                                    "additional_fields" => $color_values
                                );
                                $resultCustomDropdownOptionAdd = $client->call(
                                    $session,
                                    "product_custom_option.add",
                                    array(
                                        $online_product_id,
                                        $customColorDropdownOption
                                    )
                                );
                            }
                            $online_color = $product['color'];
                        }

                        //尺码
                        if (!empty($product['size'])) {
                            $size_arr = explode(',', $product['size']);
                            $size_values = [];
                            foreach ($size_arr as $key => $_size) {
                                $size_values[] = array(
                                    "title" => $options[$_size]['value'],
                                    "price_type" => "fixed",
                                    "sort_order" => $key
                                );
                            }
                            if (!empty($size_values)) {
                                $customSizeDropdownOption = array(
                                    "title" => "Size",
                                    "type" => "drop_down",
                                    "is_require" => 1,
                                    "sort_order" => 20,
                                    "additional_fields" => $size_values
                                );
                                $resultCustomDropdownOptionAdd = $client->call(
                                    $session,
                                    "product_custom_option.add",
                                    array(
                                        $online_product_id,
                                        $customSizeDropdownOption
                                    )
                                );
                            }
                            $online_size = $product['size'];
                        }
                    }


                    //圖片上傳,base_64 encoded
                    if (!empty($product['main_image'])) {
                        $main_image = explode(',', $product['main_image']);
                    } else {
                        $main_image = [];
                    }
                    if (!empty($product['addition_images'])) {
                        $addition_images = explode(',', $product['addition_images']);
                    } else {
                        $addition_images = [];
                    }

                    if ($product_website['image_type'] == 1) {
                        $product_images = array_merge($main_image, $addition_images);
                    } else {
                        $product_images = $addition_images;
                    }

                    $online_images = json_decode($product_website['online_images'],true);
                    if(empty($online_images)){
                        $online_images = array();
                        $result = $client->call($session, 'catalog_product_attribute_media.list', $online_product_id);
                        if(is_array($result)){
                            foreach($result as $_img) {
                                $client->call(
                                    $session,
                                    'catalog_product_attribute_media.remove',
                                    array('product' => $online_product_id, 'file' => $_img['file'])
                                );
                            }
                        }
                    }
                    foreach ($online_images as $key => $_img) {
                        if ($position = array_search($_img['sys_image'], $product_images)) {
                            if ($position != $_img['position']) {
                                if ($position == 0) {
                                    $types = array('thumbnail', 'image', 'small_image');
                                } else {
                                    $types = array();
                                }
                                $result = $client->call(
                                    $session,
                                    'catalog_product_attribute_media.update',
                                    array(
                                        $online_product_id,
                                        $_img['online_image'],
                                        array('position' => $position, 'types' => $types)
                                    )
                                );
                                $online_images[$key]['position'] = $position;
                            }
                        } else {
                            $result = $client->call(
                                $session,
                                'catalog_product_attribute_media.remove',
                                array('product' => $online_product_id, 'file' => $_img['online_image'])
                            );
                            unset($online_images[$key]);
                        }
                    }

                    foreach ($product_images as $key => $_image) {
                        $is_new = true;
                        foreach ($online_images as $_img) {
                            if ($_img['sys_image'] == $_image) {
                                $is_new = false;
                                break;
                            }
                        }

                        if (!$is_new) {
                            continue;
                        }

                        $file = $this->base64EncodeImage($_image);

                        if ($key == 0) {
                            $types = array('thumbnail', 'image', 'small_image');
                        } else {
                            $types = array();
                        }

                        $result = $client->call(
                            $session,
                            'catalog_product_attribute_media.create',
                            array(
                                $online_product_id,
                                array('file' => $file, 'label' => 'Label', 'position' => $key, 'types' => $types, 'exclude' => 0)
                            )
                        );
                        $online_images[] = array(
                            'position' => $key,
                            'sys_image' => $_image,
                            'online_image' => $result
                        );
                    }

                    //更新站点产品状态
                    $update_row = array(
                        'online_id' => $online_product_id,
                        'online_status' => 1,
                        'fail_message' => null,
                    );
                    if(isset($online_color)){
                        $update_row['online_color'] = $online_color;
                    }
                    if(isset($online_size)){
                        $update_row['online_size'] = $online_size;
                    }
                    if(isset($online_images)){
                        $update_row['online_images'] = json_encode($online_images);
                    }
                    $em->getConnection()->update('product_website', $update_row, array('website_id' => $product_website['website_id'], 'product_id' => $product_id));
                }
            }catch (\Exception $e) {
                $fail_message = $e->getMessage();
                $update_row = array(
                    'online_id' => $online_product_id,
                    'fail_message' => $fail_message,
                    'online_status' => 6
                );
                if(isset($online_color)){
                    $update_row['online_color'] = $online_color;
                }
                if(isset($online_size)){
                    $update_row['online_size'] = $online_size;
                }
                if(isset($online_images)){
                    $update_row['online_images'] = json_encode($online_images);
                }
                $em->getConnection()->update('product_website', $update_row, array('website_id' => $product_website['website_id'], 'product_id' => $product_id));
            }
        }
    }

    /**
     * @param $image
     * @return array
     * 产品图片转换成base_64 encoded
     */
    protected function base64EncodeImage($image){
        $image_file = $this->getContainer()->getParameter('kernel.project_dir').'/public/media/catalog/product/'.$image;
        $image_info = getimagesize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image = chunk_split(base64_encode($image_data));
        $result = array('content'=>$base64_image,'mime'=>$image_info['mime']);
        return $result;
    }
}