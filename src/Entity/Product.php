<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $product_id;

    /**
     * @ORM\Column(type="string")
     */
    private $sku;

    /**
     * @ORM\Column(type="decimal")
     */
    private $purchase_price;

    /**
     * @ORM\Column(type="decimal")
     */
    private $shipping_cost;

    /**
     * @ORM\Column(type="decimal")
     */
    private $weight;

    /**
     * @ORM\Column(type="decimal")
     */
    private $qty;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $color;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $size;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $main_image;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $addition_images;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $category_ids;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $category2_ids;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $website_ids;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $update_fields;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string")
     */
    private $created_at;

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setPurchasePrice($purchase_price){
        $this->purchase_price = $purchase_price;
    }

    public function getPurchasePrice(){
        return $this->purchase_price;
    }

    public function setShippingCost($shipping_cost)
    {
        $this->shipping_cost = $shipping_cost;
    }

    public function getShippingCost()
    {
        return $this->shipping_cost;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setMainImage($main_image)
    {
        $this->main_image = $main_image;
    }

    public function getMainImage()
    {
        return $this->main_image;
    }

    public function setAdditionImages($addition_images)
    {
        $this->addition_images = $addition_images;
    }

    public function getAdditionImages()
    {
        return $this->addition_images;
    }

    public function setCategoryIds($category_ids)
    {
        $this->category_ids = $category_ids;
    }

    public function getCategoryIds()
    {
        return $this->category_ids;
    }

    public function setCategory2Ids($category2_ids)
    {
        $this->category2_ids = $category2_ids;
    }

    public function getCategory2Ids()
    {
        return $this->category2_ids;
    }

    public function setWebsiteIds($website_ids)
    {
        $this->website_ids = $website_ids;
    }

    public function getWebsiteIds()
    {
        return $this->website_ids;
    }

    public function setUpdateFields($update_fields)
    {
        $this->update_fields = $update_fields;
    }

    public function getUpdateFields()
    {
        return $this->update_fields;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
