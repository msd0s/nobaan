<?php
namespace controllers;

use configs\traits\ViewTrait;
use controllers\traits\ProductControllerTrait;
use controllers\traits\RedirectTrait;

class ProductController
{
    use ViewTrait,ProductControllerTrait,RedirectTrait;

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
        $this->view('admin/products.php',$data);
    }

    public function create($parameters)
    {
        $data = [
            'root_url' => $this->config['root_url'],
        ];
        $this->view('admin/create-product.php',$data);
    }

    public function store($parameters)
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
        
        $this->connection->insert('products')->insertFields(['title'=>$parameters['title'],'image'=>$parameters['image'],'price'=>$parameters['price'],'stock'=>$parameters['stock'],'discount_percent'=>$parameters['discount_percent'],'status'=>$parameters['status']])->exec();
        
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