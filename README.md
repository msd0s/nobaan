  <h3 align="center">فروشگاه لوازم پزشکی (تست)</h3>


### نحوه نصب و راه اندازی

_Below is an example of how you can instruct your audience on installing and setting up your app. This template doesn't rely on any external dependencies or services._

1. ابتدا پروژه را روی سیستم خود Clone کنید
   ```sh
   git clone https://github.com/msd0s/nobaan.git
   ```
2. فایل config.php موجود در ریشه سایت را باز کرده و مقدار root_path را برابر با نام پوشه root سایت خود قرار دهید.
   به عنوان مثال اگر مسیر دسترسی شما به آدرس سایت http://localhost/nooban/ باشد، مقدار root_path باید برابر با /nooban/ قرار بگیرد.
3. راه اندازی این پروژه نیاز به فعال سازی سیستم caching دارد و برای استفاده از سیستم حداقل باید Redis و یا memcache بر روی سرور شما نصب و فعال باشد. بعد از نصب و فعال سازی حداقل یکی از این موارد، در داخل فایل config.php اطلاعات ارتباط با این سیستم ها را در قسمت مناسب خود ذخیره کرده و بسته به نوع cache، اطلاعات cache_type را روی redis و یا memcached قرار دهید.
4. در دیتابیس mysql، یک جدول ایجاد کنید و بخش های db_name، db_username، db_password و db_host را در فایل config.php بر اساس اطلاعات دیتابیس خود کامل کنید.
5. در مسیر اصلی پروژه پوشه ای به نام sql قرار دارد که در داخل این پوشه فایلی با نام nooban.sql قرار داده شده است. این فایل باید در جدولی که در مرحله قبل ایجاد گردید import گردد.
6. کار نصب سیستم به اتمام رسیده و اکنون می توانید از سیستم استفاده کنید.