<!doctype html>
<html lang="fa">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ویرایش محصول</title>
    <link href="<?php echo $parameters['root_url']; ?>views/css/bootstrap.rtl.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
      *{direction:rtl;}
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <a class="btn btn-success link-light" href="<?php echo $parameters['root_url']; ?>products">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="m21.94 2.76-.71-.71a2.758 2.758 0 0 0-3.89 0L7.03 12.38c-.29.29-.47.67-.51 1.08l-.27 2.93c-.03.37.1.73.36 1 .24.24.55.37.88.37h.11l2.93-.27c.41-.04.79-.22 1.08-.51L21.93 6.66a2.732 2.732 0 0 0 0-3.88zM10.56 15.91s-.1.07-.15.07l-2.63.24.24-2.63c0-.06.03-.11.07-.16l8.38-8.38 2.47 2.47-8.38 8.38zM20.88 5.59l-.88.88L17.53 4l.88-.88c.24-.24.56-.37.88-.37s.64.12.88.37l.71.71a1.234 1.234 0 0 1 0 1.76zm-.13 7.6V19c0 2.07-1.68 3.75-3.75 3.75H5c-2.07 0-3.75-1.68-3.75-3.75V7c0-2.07 1.68-3.75 3.75-3.75h5.81c.41 0 .75.34.75.75s-.34.75-.75.75H5C3.76 4.75 2.75 5.76 2.75 7v12c0 1.24 1.01 2.25 2.25 2.25h12c1.24 0 2.25-1.01 2.25-2.25v-5.81c0-.41.34-.75.75-.75s.75.34.75.75z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
            نمایش لیست محصولات
          </a>
        </div>
        <div class="col-12">
          <form class="row" action="<?php echo $parameters['root_url']; ?>products/update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $parameters['product']['id']; ?>">
            <div class="col-6 mb-3">
                <label for="title" class="form-label">عنوان محصول</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $parameters['product']['title']; ?>" placeholder="عنوان محصول">
            </div>
            <div class="col-6 mb-3">
                <label for="image" class="form-label">تصویر</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="col-6 mb-3">
                <label for="price" class="form-label">قیمت (ریال)</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $parameters['product']['price']; ?>" placeholder="قیمت (ریال)">
            </div>
            <div class="col-6 mb-3">
                <label for="stock" class="form-label">موجودی</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $parameters['product']['stock']; ?>" placeholder="موجودی">
            </div>
            <div class="col-6 mb-3">
                <label for="discount_percent" class="form-label">درصد تخفیف</label>
                <input type="number" class="form-control" id="discount_percent" name="discount_percent" value="<?php echo $parameters['product']['discount_percent']; ?>" placeholder="درصد تخفیف" min="0" max="100">
            </div>
            <div class="col-6 mb-3">
                <label for="status" class="form-label">فعال؟</label>
                <select class="form-control" id="status" name="status">
                    <option <?php $parameters['product']['status']=='1' ? 'selected' : ''; ?> value="1">بله</option>
                    <option <?php $parameters['product']['status']=='0' ? 'selected' : ''; ?> value="0">خیر</option>
                </select>
            </div>
            <div class="col-auto">
              <button class="btn btn-success" type="submit">
                  ویرایش محصول
              </button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
    <script src="<?php echo $parameters['root_url']; ?>views/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>