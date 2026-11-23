# Sanat Akımları Kataloğu (PHP & SQLite)

Bu proje, PHP ve SQLite kullanılarak geliştirilmiş web tabanlı bir sanat eserleri kataloglama ve yönetim uygulamasıdır. Uygulama; sanat tarihindeki altı temel akıma ait seçkin eserlerin dönemlerine göre sınıflandırılmasını, görüntülenmesini ve veritabanı üzerinden yönetilmesini sağlar.

## Projenin Amacı ve Kapsamı

Uygulama, kullanıcıların farklı sanat akımlarına ait eserleri düzenli bir arayüz üzerinden inceleyebilmesi ve temel veritabanı işlemlerini (**CRUD** — Ekleme, Listeleme, Güncelleme, Silme) gerçekleştirebilmesi amacıyla hazırlanmıştır.

Veritabanında **6 sanat akımı** altında her birinden **20 farklı sanatçıya ait eser** olmak üzere toplam **120 başlangıç eseri** yer almaktadır:
* **Rönesans** (1400 – 1600)
* **Barok** (1600 – 1750)
* **Romantizm** (1780 – 1850)
* **Empresyonizm** (1860 – 1890)
* **Post-Empresyonizm** (1886 – 1905)
* **Sürrealizm** (1920 – 1960)

## Temel Özellikler

* **Akım Bazlı Filtreleme:** Kullanıcı seçtiği sanat akımına tıklayarak yalnızca ilgili döneme ait eserleri, dönem aralığı ve akım açıklamasıyla birlikte görüntüleyebilir.
* **Eser Ekleme ve Kayıt Kontrolü:** Form aracılığıyla koleksiyona yeni eser eklenebilir. Sistem, büyük/küçük harf duyarlılığı olmaksızın aynı akım, ressam, orijinal eser adı ve yıl bilgisine sahip kayıtların tekrar eklenmesini engeller.
* **Güncelleme ve Silme:** Mevcut eserlerin bilgileri düzenlenebilir veya onay mekanizmasıyla veritabanından silinebilir.
* **Otomatik Veritabanı Kurulumu:** Veritabanı dosyası veya tablo mevcut değilse ilk çalıştırmada otomatik olarak oluşturulur ve örnek veriler yüklenir.

## Kullanılan Teknolojiler

* **Backend:** PHP 8+ (PDO SQLite sürücüsü)
* **Veritabanı:** SQLite (`sanat_akimlari.db`)
* **Frontend:** HTML5, CSS3 (Responsive Grid ve Tablo Tasarımı)

## Dosya Yapısı

```text
├── .gitignore          # Git takibi dışında bırakılacak geçici dosya kuralları
├── baglanti.php        # SQLite veritabanı bağlantısını (PDO) sağlayan dosya
├── index.php           # Arayüz, filtreleme ve CRUD işlemlerini yürüten ana dosya
├── sanat_akimlari.db   # Eser kayıtlarının tutulduğu SQLite veritabanı dosyası
└── README.md           # Proje dokümantasyonu
