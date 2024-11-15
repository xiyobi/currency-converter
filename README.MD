# Currency Converter & Weather App

## 📋 Loyihaning tavsifi
Ushbu loyiha PHP, Bootstrap va OpenWeatherMap hamda Markaziy Bankning API-laridan foydalangan holda yaratilgan oddiy **Valyuta Konvertori** va **Ob-havo ma'lumotlari** ilovasidir.

- **Currency Converter (Valyuta Konvertori)**: Valyutalarni bir-biriga tezda konvertatsiya qilish imkoniyatini beradi.
- **Weather App (Ob-havo Ilovasi)**: Toshkent shahrining joriy ob-havo ma'lumotlarini ko'rsatadi.

## 📂 Loyiha tuzilishi

## ⚙️ Talablar
Loyihani ishlatish uchun quyidagi dasturlar kerak:
- **XAMPP** (PHP va MySQL server uchun)
- **Neovim** (yoki boshqa kod muharriri)
- **Ubuntu 24.04** operatsion tizimi

## 🔧 O'rnatish va Ishga tushirish
1. **XAMPP**'ni ishga tushiring.
2. Loyihani `htdocs` papkasiga joylashtiring.
3. `localhost/currency-converter/index.php` manzili orqali **valyuta konvertori** sahifasini oching.
4. `localhost/currency-converter/weather.php` manzili orqali **ob-havo ilovasi** sahifasini oching.

## 📜 Foydalanilgan texnologiyalar
- **PHP** - Backend logikasi uchun
- **cURL** - API'larga murojaat qilish uchun
- **Bootstrap 5.3** - Foydalanuvchi interfeysi uchun
- **HTML/CSS** - Sahifalarni tartibga keltirish uchun

## 🌐 API-lar
Loyihada ikkita API ishlatiladi:

1. **Markaziy Bank API** (valyuta kurslari uchun):
    - URL: `https://cbu.uz/uz/arkhiv-kursov-valyut/json/`

2. **OpenWeatherMap API** (ob-havo ma'lumotlari uchun):
    - URL: `https://api.openweathermap.org/data/2.5/weather`
    - API kaliti (misol): `1f2c4527291b18aaab758440a1f8e071`

## 💻 Foydalanish
### 1. **Valyuta Konvertori:**
- **Step 1**: Miqdorni kiriting.
- **Step 2**: "From Currency" va "To Currency" maydonlaridan kerakli valyutani tanlang.
- **Step 3**: "Convert" tugmasini bosing va natijani oling.

### 2. **Ob-havo Ilovasi:**
- Sahifa ochilganda Toshkent shahrining joriy ob-havo ma'lumotlari avtomatik ravishda yuklanadi.
- Ob-havo belgisi, harorat, namlik, bosim va shamol tezligi kabi ma'lumotlar aks etadi.

## 📷 UI Ko'rinishi
**Valyuta Konvertori**

## 🛠️ Muammolarni hal qilish
Agar muammo yuzaga kelsa:
- XAMPP serveringiz to'g'ri ishlayotganini tekshiring.
- API kalitlari to'g'ri kiritilganiga ishonch hosil qiling.
- `curl` kengaytmasi faollashtirilganini tekshiring (`php.ini` faylida `extension=curl` qatorini o'chirib tashlang).

## 📞 Qo'llab-quvvatlash
Agar savollaringiz yoki muammolaringiz bo'lsa, iltimos, murojat qiling: `your-email@example.com`

---

**Muallif**: Shehroz  
**Litsenziya**: MIT


***Code Colne***:
```git clone https://github.com/shehroz/currency-weather-app.git```
