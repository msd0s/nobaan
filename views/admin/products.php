<!doctype html>
<html lang="fa">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لیست محصولات</title>
    <link href="<?php echo $parameters['root_url']; ?>views/css/bootstrap.rtl.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
      *{direction:rtl;}
    </style>
  </head>
  <body>
    <div class="container">
    <?php include_once "views/navbar.php"; ?>
    
      <div class="row">
        <div class="col-12">
          <a class="btn btn-success link-light" href="<?php echo $parameters['root_url']; ?>products/create">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="m21.94 2.76-.71-.71a2.758 2.758 0 0 0-3.89 0L7.03 12.38c-.29.29-.47.67-.51 1.08l-.27 2.93c-.03.37.1.73.36 1 .24.24.55.37.88.37h.11l2.93-.27c.41-.04.79-.22 1.08-.51L21.93 6.66a2.732 2.732 0 0 0 0-3.88zM10.56 15.91s-.1.07-.15.07l-2.63.24.24-2.63c0-.06.03-.11.07-.16l8.38-8.38 2.47 2.47-8.38 8.38zM20.88 5.59l-.88.88L17.53 4l.88-.88c.24-.24.56-.37.88-.37s.64.12.88.37l.71.71a1.234 1.234 0 0 1 0 1.76zm-.13 7.6V19c0 2.07-1.68 3.75-3.75 3.75H5c-2.07 0-3.75-1.68-3.75-3.75V7c0-2.07 1.68-3.75 3.75-3.75h5.81c.41 0 .75.34.75.75s-.34.75-.75.75H5C3.76 4.75 2.75 5.76 2.75 7v12c0 1.24 1.01 2.25 2.25 2.25h12c1.24 0 2.25-1.01 2.25-2.25v-5.81c0-.41.34-.75.75-.75s.75.34.75.75z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
            ایجاد محصول جدید
          </a>
        </div>
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
                    موجودی
                  </td>
                  <td>
                    قیمت
                  </td>
                  <td>
                    #
                  </td>
            </tr>
            <?php 
              foreach($parameters['products'] as $product)
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
                    <?php echo $product['stock']; ?>
                  </td>
                  <td>
                    <?php echo number_format($product['price'],0,'',','); ?> ریال
                  </td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <form action="<?php echo $parameters['root_url']; ?>products/delete" method="post">
                          <input type="hidden" value="<?php echo $product['id']; ?>" name="productid"/>
                          <button class="btn btn-danger" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 510 510" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M118.832 467.243A44.892 44.892 0 0 0 163.776 510h182.447a44.89 44.89 0 0 0 44.944-42.757L417.447 165H92.552zM300 240h30v165h-30zm-60 0h30v165h-30zm-60 0h30v165h-30zM330 75V45c0-24.812-20.186-45-45-45h-60c-24.812 0-45 20.188-45 45v30H60v60h390V75zm-120 0V45c0-8.271 6.73-15 15-15h60c8.272 0 15 6.729 15 15v30z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                          </button>
                        </form>
                      </div>
                      
                      <div class="col-6">
                        <a class="btn btn-success link-light" href="<?php echo $parameters['root_url']; ?>products/edit?id=<?php echo $product['id']; ?>">
                          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 512 511" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M405.332 256.484c-11.797 0-21.332 9.559-21.332 21.332v170.668c0 11.754-9.559 21.332-21.332 21.332H64c-11.777 0-21.332-9.578-21.332-21.332V149.816c0-11.754 9.555-21.332 21.332-21.332h170.668c11.797 0 21.332-9.558 21.332-21.332 0-11.777-9.535-21.336-21.332-21.336H64c-35.285 0-64 28.715-64 64v298.668c0 35.286 28.715 64 64 64h298.668c35.285 0 64-28.714 64-64V277.816c0-11.796-9.54-21.332-21.336-21.332zm0 0" fill="#ffffff" opacity="1" data-original="#000000" class=""></path><path d="M200.02 237.05a10.793 10.793 0 0 0-2.922 5.438l-15.082 75.438c-.703 3.496.406 7.101 2.922 9.64a10.673 10.673 0 0 0 7.554 3.114c.68 0 1.387-.063 2.09-.211l75.414-15.082c2.09-.43 3.988-1.43 5.461-2.926l168.79-168.79-75.415-75.41zM496.383 16.102c-20.797-20.801-54.633-20.801-75.414 0l-29.524 29.523 75.414 75.414 29.524-29.527C506.453 81.465 512 68.066 512 53.816s-5.547-27.648-15.617-37.714zm0 0" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                        </a>
                      </div>
                      
                    </div>
                    
                  </td>

                </tr>
            <?php
              }
            ?>
          </table>
        </div>
      </div>
    </div>
    <script src="<?php echo $parameters['root_url']; ?>views/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>