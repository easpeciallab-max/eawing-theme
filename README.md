# EA WING · ธีม WordPress (eawing.co)

ธีมเว็บ EA WING ผู้ช่วยเทรดอัตโนมัติสำหรับ MetaTrader 5 · ดีไซน์ Glass Sky (`docs/design.md`)
ธีมอยู่ในโฟลเดอร์ `eawing/` · WP Pusher บน eawing.co ตั้ง subdirectory = `eawing`

## Deploy

push ขึ้น `main` แล้วกด หลังบ้าน > WP Pusher > Themes > **Update theme** (หรืออัปเดตเองเมื่อมี webhook ใน GitHub)

ครั้งแรกหลังเปิดใช้ธีม: หลังบ้าน > ลักษณะ > **EA WING Setup** > ตั้งค่าเว็บทั้งหมด (สร้างเพจ เมนู หน้าแรก นำเข้าบทความเป็นฉบับร่าง)

## แก้เนื้อหา

- ข้อความ รูป ลิงก์ทุกส่วน: ลักษณะ > ปรับแต่ง > **EA WING · ตั้งค่าหน้าเว็บ**
- ลิงก์ LINE / OpenChat: ปรับแต่ง > 1) ช่องทางติดต่อ
- เนื้อหายาวของเพจและบทความ: แก้ในหน้าแก้ไขเพจ/โพสต์ของ WordPress ตามปกติ

## พัฒนาในเครื่อง

```bash
php -d extension=mbstring -d extension=gd -S localhost:8765 dev/preview/router.php
```

http://localhost:8765/ · ต้นแบบดีไซน์ http://localhost:8765/mockup/

ตรวจก่อน commit:

```bash
php -d extension=mbstring dev/check-settings.php
```

```bash
php -d extension=mbstring dev/check-content.php
```

```bash
php dev/check-brand.php
```

เอกสารเพิ่มเติม: `CLAUDE.md`, `docs/plan.md`, `dev/content-spec.md`
