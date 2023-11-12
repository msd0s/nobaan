<?php
namespace controllers;

use configs\traits\ViewTrait;
use controllers\traits\RedirectTrait;

class HomeController
{
    use ViewTrait,RedirectTrait;

    private $connection;
    private $config;
    private $cache;
    
    public function __construct($connection,$config,$cache)
    {
        $this->connection = $connection;
        $this->config = $config;
        $this->cache = $cache;
    }

    public function index($parameters)
    {
        $data = [
            'root_url' => $this->config['root_url'],
            'products'=>$this->connection->select('*')->from('products')->fetchAll()
        ];
        $this->view('index.php',$data);
    }

    public function store($parameters)
    {
        $cookie_code = $this->getOrderCookie();
        $has_discount = '';
        $mobile = '';
        $this->connection->insert('orders')->insertFields(['product_id'=>$parameters['product_id'],'product_title'=>$parameters['product_title'],'count'=>$parameters['count'],'price'=>$parameters['price'],'has_discount'=>$has_discount,'mobile'=>$parameters['mobile'],'cookie_code'=>$cookie_code])->exec();
        
        // redirect to custom route
        $this->redirect($this->config['root_url'].'products');
    }

    public function edit($parameters)
    {
        $data = [
            'root_url' => $this->config['root_url'],
            'product'=>$this->connection->select('*')->from('products')->where(['id'=>$parameters['id']])->fetchOne()
        ];
        $this->view('admin/edit-product.php',$data);
    }

    public function update($parameters)
    {
        if(!empty($parameters['image']) && $parameters['image']['error']==0)
        {
            // get image details
            $imageDetails = $this->getImageDetails($parameters['image']);
            
            // check image type
            if($this->checkImageTypeIsValid($imageDetails['imageType'])==false)
            {
                $this->redirect($this->config['root_url'].'products');
            }

            // save image in uploads folder
            $imageName = $this->saveProductImage($imageDetails['imageName'],$imageDetails['imageTempPath']);

            $parameters['image'] = $imageName;
        }else
        {
            $parameters['image'] = '';
        }
        
        $this->connection->update('products')->updateFields(['title'=>$parameters['title'],'image'=>$parameters['image'],'price'=>$parameters['price'],'stock'=>$parameters['stock'],'discount_percent'=>$parameters['discount_percent'],'status'=>$parameters['status']])->where(['id'=>$parameters['id']])->exec();
        
        // redirect to custom route
        $this->redirect($this->config['root_url'].'products');
    }

    public function destroy($parameters)
    {
        $this->connection->delete()->from('products')->where(['id'=>$parameters['productid']])->exec();
        
        // redirect after delete row
        $this->redirect($this->config['root_url'].'products');
    }
}