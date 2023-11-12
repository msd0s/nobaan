<!doctype html>
<html lang="fa">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>محصولات فروشگاه</title>
    <link href="<?php echo $parameters['root_url']; ?>views/css/bootstrap.rtl.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
      *{direction:rtl;}
    </style>
  </head>
  <body>
    <div class="container">
        <?php include_once "views/navbar.php"; ?>
      <div class="row row-cols-1 row-cols-md-3 g-4 my-1">
        <?php 
          foreach($parameters['products'] as $product)
          {
        ?>
            <div class="col">
              <div class="card">
                <img src="<?php echo $parameters['root_url']; ?>uploads/products/<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['title']; ?>">
                <div class="card-body text-center">
                  <h5 class="card-title"><?php echo $product['title']; ?></h5>
                  <p class="card-text"><?php echo number_format($product['price'],0,'',','); ?> ریال</p>
                  <form action="<?php echo $parameters['root_url']; ?>orders/store" method="post">
                    <input type="number" name="count" value="1"/>
                    <input type="hidden" value="<?php echo $product['id']; ?>" name="product_id"/>
                    <button class="btn btn-success my-2" type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 510 510" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M153 408c-28.05 0-51 22.95-51 51s22.95 51 51 51 51-22.95 51-51-22.95-51-51-51zM0 0v51h51l91.8 193.8-35.7 61.2c-2.55 7.65-5.1 17.85-5.1 25.5 0 28.05 22.95 51 51 51h306v-51H163.2c-2.55 0-5.1-2.55-5.1-5.1v-2.551l22.95-43.35h188.7c20.4 0 35.7-10.2 43.35-25.5L504.9 89.25c5.1-5.1 5.1-7.65 5.1-12.75 0-15.3-10.2-25.5-25.5-25.5H107.1L84.15 0H0zm408 408c-28.05 0-51 22.95-51 51s22.95 51 51 51 51-22.95 51-51-22.95-51-51-51z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                      افزودن به سبد
                    </button>
                  </form>
                </div>
              </div>
            </div>
        <?php
          }
        ?>
      </div>

    </div>
    <script src="<?php echo $parameters['root_url']; ?>views/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>