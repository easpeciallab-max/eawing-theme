# EA WING · ธีม WordPress (eawing.co)

ธีมอยู่ในโฟลเดอร์ `eawing/` · WP Pusher บน eawing.co ตั้ง subdirectory = `eawing`
ตอนนี้มีหน้า `/go` (ลิงก์รวม + 6 ขั้นตอนเริ่มใช้งาน) ต้นแบบจาก https://ea2000.co/go/

## โครงไฟล์

```
eawing/
  style.css            หัวธีม + สไตล์ทั้งหมด (สีและฟอนต์อยู่ใน :root)
  functions.php        ฟอนต์, ช่องตั้งค่าลิงก์, สร้างหน้า /go อัตโนมัติ, noindex
  template-links.php   หน้า /go (Template Name: ลิงก์รวม)
  index.php            หน้าทั่วไป (เรียบ ๆ จนกว่าจะออกแบบหน้าอื่น)
  assets/img/logo-mark.svg  โลโก้สำรองเมื่อยังไม่ตั้ง custom logo
dev/preview.php        ดูหน้า /go ในเครื่องโดยไม่ต้องลง WordPress
```

## Deploy

push ขึ้น `main` แล้ว WP Pusher อัปเดตธีมบน eawing.co ให้เอง (Push-to-Deploy)
ถ้า webhook ไม่ทำงาน: หลังบ้าน > WP Pusher > Themes > Update theme

## ดูในเครื่อง

```bash
php -S 127.0.0.1:8090 dev/preview.php
```

http://127.0.0.1:8090/ (`?nologo` = ดูแบบโลโก้สำรอง)

## แก้ลิงก์และโลโก้โดยไม่แก้โค้ด

- ลักษณะ > ปรับแต่ง > **ลิงก์ติดต่อ EA WING**: LINE OA, OpenChat, Portal โบรกเกอร์
- ลักษณะ > ปรับแต่ง > เอกลักษณ์ของเว็บไซต์ > โลโก้

## พฤติกรรมของธีม

- เปิดใช้ธีมครั้งแรก: สร้างหน้า `/go` ให้เอง (ถ้ายังไม่มี slug `go`)
- เข้าหน้าแรกจะถูกพาไป `/go/` จนกว่าธีมจะมี `front-page.php`
- ลิงก์ท้ายการ์ด (privacy-policy, terms-of-use, risk-warning) แสดงเฉพาะหน้าที่มีอยู่จริง
- ย้อนกลับธีมเดิม: ลักษณะ > ธีม > เปิดใช้ `easpecial`
