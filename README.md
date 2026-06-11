# 🎁 giftShop - متجر الهدايا الإلكتروني

مشروع ويب متكامل لبناء متجر إلكتروني لبيع الهدايا وتسهيل عملية الشراء عبر الإنترنت، مبني باستخدام إطار العمل **Laravel** ومدمج ببوابة الدفع العالمية **Stripe** لإتمام المعاملات المالية بشكل آمن وتجريبي.

رابط مباشر للموقع (https://giftshop-y10y.onrender.com/)
---

## ✨ المميزات الرئيسية (Features)
- **نظام إدارة المنتجات:** تصفح واستعراض الهدايا حسب التصنيفات.
- **عربة التسوق (Cart):** إضافة وتعديل وحذف المنتجات بسهولة قبل الشراء.
- **بوابة دفع آمنة:** تكامل كامل مع **Stripe Payment Gateway** لمعالجة بطاقات الائتمان.
- **لوحة تحكم مرنة:** إدارة الطلبات، والمدفوعات، وحالة الشحن.
- **البيئة السحابية:** مهيأ للرفع والتشغيل مباشرة على منصات الاستضافة مثل **Render**.

---

## 🛠️ التقنيات المستخدمة (Tech Stack)
- **Backend:** PHP / Laravel Framework
- **Frontend:** Blade Templates / JavaScript / CSS
- **Database:** MySQL
- **Payment Gateway:** Stripe API
- **Deployment:** Render Cloud Platform

---

## 🚀 طريقة التشغيل محلياً (Installation Guide)

لتشغيل المشروع على جهازك الشخصي، اتبع الخطوات التالية:

### 1. تحميل المشروع
```bash
git clone https://github.com
cd giftShop
```

### 2. تثبيت الحزم والمكتبات
```bash
composer install
npm install && npm run dev
```

### 3. إعداد ملف البيئة (.env)
قم بنسخ ملف `.env.example` إلى ملف جديد باسم `.env` وتحديث بيانات قاعدة البيانات ومفاتيح Stripe:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gift_shop_db
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=pk_test_your_stripe_public_key
STRIPE_SECRET=sk_test_your_stripe_secret_key
```

### 4. توليد مفتاح التشفير وتهيئة قاعدة البيانات
```bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### 5. تشغيل السيرفر المحلي
```bash
php artisan serve
```
افتح الرابط التالي في متصفحك: `http://127.0.0.1:8000`

---

## 💳 بيانات بطاقة الاختبار (Testing Payment)
عند الوصول لصفحة الدفع في وضع التجربة، يمكنك إتمام العملية بقيمة **$405.00 USD** باستخدام بيانات بطاقة Stripe الوهمية:
- **رقم البطاقة:** `4242 4242 4242 4242`
- **تاريخ الانتهاء:** أي تاريخ مستقبلي (مثال: `12/29`)
- **رمز الأمان (CVC):** `123`

---

## 📄 الترخيص (License)
المشروع مفتوح المصدر ومتاح تحت رخصة **[MIT License](https://opensource.org)**.
