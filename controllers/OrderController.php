<?php
namespace controllers;

use configs\traits\ViewTrait;
use controllers\traits\RedirectTrait;
use controllers\traits\OrderTrait;

class OrderController
{
    use ViewTrait,RedirectTrait,OrderTrait;

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
        $cookie_code = $this->getOrderCookie();
        //$this->cache->del('cart_'.$cookie_code);
        if(empty($this->getProductsInCart()))
        {
            $this->redirect($this->config['root_url']);
        }
        $data = [
            'root_url' => $this->config['root_url'],
            'orders'=>$this->getProductsDataFromDatabase($this->getProductsInCart()),
        ];
        
        $this->view('orders.php',$data);
    }

    public function store($parameters)
    {
        $this->addProductToCart($parameters);

        // redirect to custom route
        $this->redirect($this->config['root_url']);
    }

    public function destroy($parameters)
    {
        $this->removeProductFromCart($parameters);
        
        // redirect after delete row
        $this->redirect($this->config['root_url'].'orders');
    }

    public function checkout($parameters)
    {
        $productsData = $this->getProductsDataFromDatabase($this->getProductsInCart());
        
        $mobile = $parameters['mobile'];
        // checking whether the user has already bought a discounted product or not
        if($this->checkUserBuyedDiscountProduct($productsData,$mobile))
        {
            return $this->redirect($this->config['root_url']);
        }
        // complete payment
        $this->completePayment($productsData,$mobile);
        // delete cache products
        $this->emptyCart();
        return $this->redirect($this->config['root_url']);
        
    }
}