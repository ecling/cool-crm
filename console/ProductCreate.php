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
class ProductCreate extends ContainerAwareCommand{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('product:create');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine');

        //查询待上传产品
        $sql = "SELECT p.product_id,w.* FROM product_website AS p
LEFT JOIN website AS w ON p.website_id=w.website_id
WHERE p.online_status=3 limit 1";
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

            $categorys = array_merge(explode(',',$product['category_ids']),explode(',',$product['category2_ids']));
            $categorys = array(49,53,62,80,81);

            $client = new \SoapClient('http://test.bellecat.com/index.php/api/soap/?wsdl');
            $session = $client->login('admin', 'admin123');

            //产品基础资料上传
            $result = $client->call($session, 'catalog_product.create', array('simple', 4, 'test004', array(
                'categories' => $categorys,
                'websites' => array(1),
                'name' => $product['name'],
                'description' => $product['description'],
                'weight' => $product['weight'],
                'status' => '1',
                'visibility' => '4',
                'price' => $product['purchase_price'],
                'purchase_price'=> $product['purchase_price'],
                'shipping_cost' => $product['shipping_cost'],
                'tax_class_id' => 1,
                'options_container' => 'container1',
                'stock_data' => array('qty'=>$product['qty'],'is_in_stock'=>1,'manage_stock'=>1,'use_config_manage_stock '=>1)
            )));
            $online_product_id = $result;

            //options 上傳
            $customDropdownOption = array(
                "title" => "Custom Dropdown Option Title",
                "type" => "drop_down",
                "is_require" => 1,
                "sort_order" => 10,
                "additional_fields" => array(
                    array(
                        "title" => "Dropdown row #1",
                        "price" => 10.00,
                        "price_type" => "fixed",
                        "sku" => "custom_select_option_sku_1",
                        "sort_order" => 0
                    ),
                    array(
                        "title" => "Dropdown row #2",
                        "price" => 10.00,
                        "price_type" => "fixed",
                        "sku" => "custom_select_option_sku_2",
                        "sort_order" => 5
                    )
                )
            );
            $resultCustomDropdownOptionAdd = $client->call(
                $session,
                "product_custom_option.add",
                array(
                    $online_product_id,
                    $customDropdownOption
                )
            );

            //圖片上傳,base_64 encoded
            $file = array(
                'content' => '/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAIBAQIBAQICAgICAgICAwUDAwMDAwYEBAMFBwYHBwcGBwcICQsJCAgKCAcHCg0KCgsMDAwMBwkODw0MDgsMDAz/2wBDAQICAgMDAwYDAwYMCAcIDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAz/wAARCAAXABcDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwDLooor8XP4DCiiigAooooAKKKKAP/Z',
                'mime' => 'image/jpeg'
            );

            $result = $client->call(
                $session,
                'catalog_product_attribute_media.create',
                array(
                    197,
                    array('file'=>$file, 'label'=>'Label', 'position'=>'100', 'types'=>array('thumbnail','image','small_image'), 'exclude'=>0)
                )
            );
        }
    }
}