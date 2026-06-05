# NoteApp Güvenlik Raporu

## Proje Hakkında
Bu proje basit bir not uygulamasıdır. Sistem üzerinde bazı güvenlik açıkları bulunmuştur ve bunlar incelenmiştir.

---

## Bulunan Güvenlik Açıkları

### 1. Parola Güvenliği Zayıf
Parolalar ilk 5 karaktere indirgenip hashleniyor. Bu durum parolaların kolay kırılmasına neden olur.

**Çözüm:** password_hash ve password_verify kullanılmalı.

---

### 2. Cookie ile Giriş Kontrolü
Kullanıcı bilgisi doğrudan cookie üzerinden alınıyor. Bu yüzden kolayca değiştirilebilir.

**Çözüm:** Session kullanılmalı.

---

### 3. Logout Güvenliği
Çıkış işlemi GET isteği ile yapılıyor ve ekstra kontrol yok. Bu durum kötüye kullanılabilir.

**Çözüm:** POST ve token doğrulaması kullanılmalı.

---

### 4. Not Erişim Sorunu
Notlar sadece ID ile çekiliyor. Kullanıcının kendi notu olup olmadığı kontrol edilmiyor.

**Çözüm:** user_id kontrolü eklenmeli.

---

### 5. Login Bilgileri GET ile Gönderiliyor
Kullanıcı adı ve şifre URL üzerinden gönderiliyor. Bu güvenli değildir.

**Çözüm:** POST metodu kullanılmalı.

---

## Sonuç
Projede temel seviyede birkaç güvenlik açığı tespit edilmiştir. Bunlar düzeltilirse sistem daha güvenli hale gelir.
