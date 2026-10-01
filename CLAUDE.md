# CLAUDE.md · EA WING (eawing.co)

## โปรเจกต์
- แบรนด์ **EA WING** · https://eawing.co/ · ภาษาไทย · เว็บขาย EA บน MT5 ให้คนทัก LINE
- ต้นแบบหน้าตาและโครง: ea2000.co (ธีม `ea2000` ของเจ้าของเอง) · เริ่มจากหน้า `/go` ก่อน หน้าอื่นค่อยทำทีหลัง
- eawing.co เดิมรันธีม `easpecial` ("EA Special") · เจ้าของสั่งให้ทับทั้งเว็บ ออกแบบใหม่ทั้งหมด
- GitHub: `easpeciallab-max/eawing-theme` (public) · ธีมอยู่ใน `eawing/` · WP Pusher subdirectory `eawing`
- **ห้ามแตะ** repo/เว็บของแบรนด์อื่น (ea2000, fenix-pro, falcon-pro, easpecial)

## วิธีทำงานกับเจ้าของ
- ตัดสินใจเรื่องดีไซน์/สี/ฟอนต์/ข้อความเองแล้วลงมือ ไม่ต้องถามทีละข้อ · หยุดถามเฉพาะสิ่งที่ทำแทนไม่ได้ (ล็อกอิน, รหัส)
- Claude ไม่พิมพ์รหัสผ่านให้ · เจ้าของล็อกอิน wp-admin เอง

## แบรนด์ (ดึงค่าจากภาพโฆษณาชุดแรก 20 รูป)
- น้ำเงินปีก `#0B5CAD` · กรมท่า `#0A2E66` · กรมท่าเข้ม `#011D3B` · ทอง `#F6D57A` `#EFC25A` `#D9A12E` `#BB831F` · ทองตัวอักษร `#8F620C` · ฟ้า `#D4E6FB` `#E6F1FD` `#F3F8FE`
- ปุ่มหลักสีทอง ตัวอักษรกรมท่า · ปุ่มรองน้ำเงินไล่เฉด · พื้นฟ้าไล่ลงขาว
- ฟอนต์: Kanit (หัวข้อ) + Noto Sans Thai (เนื้อความ)
- โลโก้จริงอยู่ใน media ของ eawing.co (`EA-WING-ORIGINAL-LOGO.png` แนวนอน พื้นโปร่ง) ธีมใช้ custom logo
- LINE OA / OpenChat / Zaurix: เจ้าของสั่งใช้ชุดเดียวกับ EA2000 (`lin.ee/ye11pwm6`) · หัวเว็บเดิมของ eawing.co ใช้ `@fenixpro`

## ก่อน commit
- `php -l` ทุกไฟล์ PHP ที่แก้
- ดูหน้า /go ผ่าน `dev/preview.php` (launch config `eawing-go-preview`) ทั้งจอมือถือและจอคอม
- ห้ามใช้ em dash / en dash ใช้ `·` หรือ `:` แทน
- Escape ทุก output (`esc_html` / `esc_url` / `esc_attr`)
- `git remote -v` ต้องเป็น `eawing-theme` ก่อน push
