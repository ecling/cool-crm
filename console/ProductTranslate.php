<?php
namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
/**
 *
 *
 */
class ProductTranslate extends ContainerAwareCommand{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('product:translate');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$output->writeln("<comment>test</comment>");
        //获取待翻译产品
        $sql = "SELECT product_id,`name`,description FROM product WHERE `status`=3 limit 1";
        $em = $this->getContainer()->get('doctrine');
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $product = $statement->fetch();

        if(!$product){
            exit();
        }

        $product_id = $product['product_id'];
        $product_name = $product['name'];
        $product_description = $product['description'];
        $stores = ['it','nl','pt','au','de','es','fr'];
        foreach($stores as $_store){
            //翻译标题
            $handle = curl_init('https://www.googleapis.com/language/translate/v2?key=AIzaSyAYNByJiGLfhiF3HujNKcHkm_KVazOCFkw&q='.$product_name.'&source=en&target='.$_store);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, '0');
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, '0');
            $response = curl_exec($handle);
            $responseDecoded = json_decode($response, true);
            curl_close($handle);

            $new_name = '';
            foreach($responseDecoded['data']['translations'] as $name_tran) {
                $new_name .= $name_tran['translatedText'].' ';
            }
            $title = 'name_'.$_store;
            ${$title} = $new_name;

            //翻译描述
            //切分描述
            $orig_description_row = preg_split("/(<[^>]+?>)/si",$product_description, -1,PREG_SPLIT_NO_EMPTY| PREG_SPLIT_DELIM_CAPTURE);
            $des_tran_index = array();
            $des_query = '';
            $index = 0;
            for($i=0;$i<count($orig_description_row);$i++){
                if(preg_match("/(<[^>]+?>)/si",$orig_description_row[$i])||preg_match("/^[\s]*?[\s]$/si",$orig_description_row[$i])||(trim($orig_description_row[$i])=='&nbsp;')){

                }else{
                    $des_query .= '&q='.urlencode($orig_description_row[$i]);
                    $des_tran_index[$i] = $index;
                    $index++;
                    //$des_tran_text[] = $orig_description_row[$i];
                    //$orig_description_row[$i] = $this->google_trans($orig_description_row[$i],$orig_lan);
                }
            }

            //google 翻译
            $handle = curl_init('https://www.googleapis.com/language/translate/v2?key=AIzaSyAYNByJiGLfhiF3HujNKcHkm_KVazOCFkw'.$des_query.'&source=en&target='.$orig_lan);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, '0');
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, '0');
            $response = curl_exec($handle);
            $responseDecoded = json_decode($response, true);
            curl_close($handle);

            //重新组合描述
            $new_description = '';
            foreach ($orig_description_row as $key=>$row){
                if(preg_match("/(<[^>]+?>)/si",$row)||preg_match("/^[\s]*?[\s]$/si",$row)||(trim($row)=='&nbsp;')){
                    $new_description .= $row;
                }else{
                    if(isset($des_tran_index[$key])){
                        $index = $des_tran_index[$key];
                        $new_description .= $responseDecoded['data']['translations'][$index]['translatedText'];
                    }else{
                        $new_description .= $row;
                    }
                }
            }

            $description = 'description_'.$_store;
            ${$description} = $new_description;
        }

        //更新或者插入翻译的标题和描述
        $sql = 'select * from product_lang where product_id='.$product['product_id'];
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $lan = $statement->fetch();
        if($lan){
            //更新
            $row = array(
                'name_it'=>$name_it,
                'name_nl'=>$name_nl,
                'name_pt'=>$name_pt,
                'name_au'=>$name_au,
                'name_de'=>$name_de,
                'name_es'=>$name_es,
                'name_fr'=>$name_fr,
                'description_it'=>$description_it,
                'description_nl'=>$description_nl,
                'description_pt'=>$description_pt,
                'description_au'=>$description_au,
                'description_de'=>$description_de,
                'description_es'=>$description_es,
                'description_fr'=>$description_fr
            );
            $em->getConnection()->update('product_lang',$row,array('product_id'=>$product_id));
            //$sql = "update product_lang set";
            //$statement = $em->getConnection()->prepare($sql);
            //$statement->execute();
        }else{
            //插入
            $em->getConnection()->insert('product_lang',
                array('product_id'=>$product_id,
                    'name_it'=>$name_it,
                    'name_nl'=>$name_nl,
                    'name_pt'=>$name_pt,
                    'name_au'=>$name_au,
                    'name_de'=>$name_de,
                    'name_es'=>$name_es,
                    'name_fr'=>$name_fr,
                    'description_it'=>$description_it,
                    'description_nl'=>$description_nl,
                    'description_pt'=>$description_pt,
                    'description_au'=>$description_au,
                    'description_de'=>$description_de,
                    'description_es'=>$description_es,
                    'description_fr'=>$description_fr
                )
            );
            //$sql = "insert into product_lang VALUES(?)";
            //$statement = $em->getConnection()->prepare($sql);
            //$statement->bindValue(1,array($product_id,$name_it,$name_nl,$name_pt,$name_au,$name_de,$name_es,$name_fr,$description_it,$description_nl,$description_pt,$description_au,$description_de,$description_es,$description_fr));
            //$statement->execute();
        }

        //更新产品状态
        $em->getConnection()->update('product',array('status'=>1),array('product_id'=>$product_id));
    }

    public function getDoctrine(){
        $this->getContainer->get('doctrine');
    }
}