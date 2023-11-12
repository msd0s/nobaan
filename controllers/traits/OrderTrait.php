<?php
namespace controllers\traits;

trait OrderTrait
{
    private function getOrderCookie()
    {
        if (isset($_COOKIE['cookie_order'])) {
            return $_COOKIE['cookie_order'];
        }else
        {
            return $this->createOrderCookie();
        }
    }
    
    private function createOrderCookie()
    {
        $cookie_code = uniqid();
        setcookie('cookie_order', $cookie_code, time() + (3600 * 24), '/');
        return $cookie_code;
    }

    public function addProductToCart($parameters)
    {
        // دریافت کلید سبد خرید
        $cartKey = 'cart_'.$this->getOrderCookie();

        // بررسی اینکه محصول قبلاً در سبد خرید وجود دارد یا خیر
        $productInCart = $this->cache->hexists($cartKey, $parameters['product_id']);
        
        if ($productInCart) {
            // اگر محصول قبلاً در سبد خرید وجود دارد، مقدار آن را افزایش می دهیم
            $this->cache->hincrby($cartKey, $parameters['product_id'], $parameters['count']);
        } else {
            // اگر محصول قبلاً در سبد خرید وجود ندارد، آن را اضافه می کنیم
            $this->cache->hset($cartKey, $parameters['product_id'], $parameters['count']);
            //$this->cache->hmset($cartKey, ['product_id'=>$parameters['product_id'], 'count'=>$parameters['count'],'title'=>$parameters['title']]);
        }
    }

    public function getProductsInCart()
    {
        // دریافت کلید سبد خرید
        $cartKey = 'cart_'.$this->getOrderCookie();

        // دریافت محصولات موجود در سبد خرید
        $products = $this->cache->hgetall($cartKey);
        // تبدیل محصولات به آرایه
        $productsArray = [];
        foreach ($products as $key => $value) {
            $productsArray[] = [
                "id" => $key,
                "count" => $value,
            ];
        }

        return $productsArray;
    }

    // حذف محصول از سبد خرید
    public function removeProductFromCart($parameters)
    {
        // دریافت کلید سبد خرید
        $cartKey = 'cart_'.$this->getOrderCookie();

        // حذف محصول از سبد خرید
        $this->cache->hdel($cartKey, $parameters['product_id']);
    }

    // خالی کردن سبد خرید
    public function emptyCart()
    {
        // دریافت کلید سبد خرید
        $cartKey = 'cart_'.$this->getOrderCookie();

        // خالی کردن سبد خرید
        $this->cache->del($cartKey);
    }

    public function getProductsDataFromDatabase($products)
    {
        if(!isset($products) || count($products)==0)
        {
            return false;
        }
        foreach($products as $product)
        {
            $data['orders'][$product['id']] = $this->connection->select('*')->from('products')->where(['id'=>$product['id']])->fetchOne();
            $data['orders'][$product['id']]['count'] = $product['count'];
        }
        return $data['orders'];
    }

    public function completePayment($productsData,$mobile)
    {
        
        foreach($productsData as $product)
        {
            if($product['discount_percent']==null || !is_numeric($product['discount_percent']))
            {
                $has_discount = '0';
            }else
            {
                $has_discount = '1';
            }
            $this->connection->insert('orders')->insertFields(['product_id'=>$product['id'],'product_title'=>$product['title'],'count'=>$product['count'],'price'=>$product['price'],'has_discount'=>$has_discount,'mobile'=>$mobile])->exec();
            
        }
    }

    public function checkUserBuyedDiscountProduct($productsData,$mobile)
    {
        $has_discount = false;
        foreach($productsData as $data)
        {
            if($data['discount_percent']!=null)
            {
                $has_discount = true;
                break;
            }
        }
        $findHasDiscountOrders = $this->connection->select('*')->from('orders')->where(['mobile'=>$mobile,'has_discount'=>'1'])->fetchAll();
        if(isset($findHasDiscountOrders) && count($findHasDiscountOrders)>0 && $has_discount == true)
        {
            return true;
        }
        return false;
    }
}