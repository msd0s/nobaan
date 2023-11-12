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

        <div class="row mt-3">
        <div class="col-12">
          <table class="table table-striped">
            <tr>
                  <td>
                    تصویر
                  </td>
                  <td>
                    نام محصول
                  </td>
                  <td>
                    تعداد
                  </td>
                  <td>
                    قیمت
                  </td>
                  <td>
                    #
                  </td>
            </tr>
            <?php 
            if(!empty($parameters['orders']))
            {
              foreach($parameters['orders'] as $product)
              {
            ?>
                <tr>
                  <td>
                    <img width="100" height="100" src="<?php echo $parameters['root_url']; ?>uploads/products/<?php echo $product['image']; ?>" />
                  </td>
                  <td>
                    <?php echo $product['title']; ?>
                  </td>
                  <td>
                    <?php 
                        echo $product['count']; 
                    ?>
                  </td>
                  <td>
                    <?php echo number_format($product['price']*$product['count'],0,'',','); ?> ریال
                  </td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <form action="<?php echo $parameters['root_url']; ?>orders/delete" method="post">
                          <input type="hidden" value="<?php echo $product['id']; ?>" name="product_id"/>
                          <button class="btn btn-danger" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 510 510" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M118.832 467.243A44.892 44.892 0 0 0 163.776 510h182.447a44.89 44.89 0 0 0 44.944-42.757L417.447 165H92.552zM300 240h30v165h-30zm-60 0h30v165h-30zm-60 0h30v165h-30zM330 75V45c0-24.812-20.186-45-45-45h-60c-24.812 0-45 20.188-45 45v30H60v60h390V75zm-120 0V45c0-8.271 6.73-15 15-15h60c8.272 0 15 6.729 15 15v30z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                          </button>
                        </form>
                      </div>
                      
                    </div>
                    
                  </td>

                </tr>
            <?php
              }
            }
            ?>
          </table>
          <form action="<?php echo $parameters['root_url']; ?>checkout" method="post">
            <div class="row">
              <div class="col-6 mb-3">
                <label for="mobile" class="form-label">تلفن همراه</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="تلفن همراه">
              </div>
            </div>
            <button type='submit' class="btn btn-success">تکمیل خرید</button>
          </form>
        </div>
      </div>
      
    </div>
    <script src="<?php echo $parameters['root_url']; ?>views/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>