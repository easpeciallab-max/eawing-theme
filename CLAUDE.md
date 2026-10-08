# CLAUDE.md · EA WING (eawing.co)

## โปรเจกต์
- แบรนด์ **EA WING** · https://eawing.co/ · ภาษาไทย · เว็บขาย EA บน MT5 ปิดการขายทาง LINE
- โครงหน้าและระบบเท่า ea2000.co · **หน้าตาเป็นของตัวเอง (Glass Sky)** · **ข้อความเขียนใหม่ทั้งหมด** ห้ามคัดลอกจาก ea2000 / FALCON / FENIX (duplicate content ข้ามโดเมนของเจ้าของเดียวกัน)
- โค้ด fork จากธีม FALCON PRO v3 (โมดูล) เมื่อ 1 ต.ค. 2026 แล้วเปลี่ยนชื่อทั้งหมด: prefix ภายใน `eaw_` / `eaw-` / `eawCamel` · text domain `eawing` · REST `eawing/v1` · shortcode `[eawing_*]` · cookie `eaw_consent`
- GitHub `easpeciallab-max/eawing-theme` (public) · ธีมอยู่ใน `eawing/` · WP Pusher บน eawing.co: branch `main`, subdirectory `eawing`, Push-to-Deploy เปิด + webhook ใน GitHub (ตั้ง 2 ต.ค. 2026)
- **Deploy: `bash dev/deploy.sh`** (push → รอ 20 วิ → ส่ง webhook ซ้ำ เพราะ zip ของ GitHub ช้ากว่า webhook → เทียบไฟล์บนเว็บ) · สำรอง: WP Pusher > Themes > Update theme
- repo นี้ตั้ง credential helper ระดับ repo เป็น `gh auth git-credential` (บัญชี `easpeciallab-max`) เพราะ git ของเครื่องเป็น `easpecial-th` ที่ไม่มีสิทธิ์ push
- **ห้ามแตะ** repo/เว็บของแบรนด์อื่น (ea2000-repo, fenix-pro-repo, falcon-pro-repo, easpecial-repo) · อ่านอ้างอิงได้

## วิธีทำงานกับเจ้าของ
- ตัดสินใจเรื่องดีไซน์ สี ฟอนต์ ข้อความเองแล้วลงมือ ไม่ต้องถามทีละข้อ · หยุดเฉพาะสิ่งที่ทำแทนไม่ได้ (ล็อกอิน รหัส ข้อมูลจริงของธุรกิจ)
- Claude ไม่พิมพ์รหัสผ่าน และไม่คัดลอก token/secret ไปวางที่ไหน · เจ้าของล็อกอิน wp-admin ในแท็บเบราว์เซอร์ของ Claude เอง

## เอกสาร
- `docs/plan.md` แผนทั้งเว็บ: เพจ, SEO รายหน้า, กฎลิงก์ภายใน/ภายนอก, บทความรอบแรก, เก็บกวาด eawing.co, ลำดับงาน
- `docs/content-plan.md` แผนบทความ 8 กลุ่ม (เสาหลัก + บทความเสริม) 123 บทใหม่ ลงวันละบท 08:00 น. 15 ต.ค. 2026 ถึง 14 ก.พ. 2027 · กฎลิงก์ใน/นอก ตารางสะพานข้ามกลุ่ม ปฏิทินทั้งหมด
- `docs/design.md` ระบบดีไซน์ Glass Sky · ต้นแบบ `dev/mockup/` (เปิดที่ `/mockup/` ใน preview)
- `dev/content-spec.md` กติกาเขียนเนื้อหาเพจ/บทความ · `dev/image-shot-list.md` ภาพหน้าจอคู่มือที่เจ้าของต้องถ่าย

## หลักที่ห้ามผิด
1. **Customizer-driven**: ข้อความ/รูป/ลิงก์ทุกจุดเป็น setting (`eaw_defaults()` + ฟิลเตอร์ `eaw_defaults` ของแต่ละโมดูล, ช่องใน `eaw_customizer_sections`) · เพิ่ม/ลบ setting ต้องทำทั้ง default และ control · เนื้อหายาวอยู่ใน `inc/content/pages|articles/*.html` นำเข้าด้วยหน้า EA WING Setup
2. ห้ามแต่งรีวิว · ห้ามตัวเลขผลเทรดสมมติ · ห้ามบอกว่า EA ใช้ martingale/grid/SL/TP/news filter หรือไม่ · ห้ามระบุสินทรัพย์ที่เทรด ทุนขั้นต่ำ เวลาทำการ เงื่อนไขคืนเงิน ที่ยังไม่ได้จากเจ้าของ · ภาพที่มีตัวเลขต้องมีคำบรรยาย "ภาพประกอบ ไม่ใช่ผลการเทรดจริง"
   - 8 ต.ค. 2026 เจ้าของอนุมัติให้ใช้ภาพแดชบอร์ดจริงจากคู่มือ PDF ได้ทั้งหมด (เบลอเฉพาะข้อมูลส่วนตัว · ภาพมีตัวเลขต้องมีคำบรรยายว่าเป็นตัวอย่าง) · ข้อความยังไม่อธิบายกลไกฝั่งขวาของแดชบอร์ด (ข้อ 9 ถึง 13) อ้างคู่มือ PDF แทน
   - ข้อเท็จจริงด้านติดตั้งจากชุดส่งลูกค้าของเจ้าของ (`assets/downloads/EA_WING_V4.2.zip`: วิธีติดตั้ง.txt + คู่มือ PDF) ใช้ได้แล้ว: ไฟล์ .ex5 ไฟล์เดียว (Lite/Full ในตัว ไม่ใช้ .set) · ต้องติ๊ก Allow DLL imports (**แท็บ Dependencies** ของ EA + Tools → Options แท็บ Expert Advisors · แท็บ Common = Allow Algo Trading · ยืนยันกับคู่มือ MT5 และเจ้าของเลือก 8 ต.ค. 2026 · ภาพขั้น 5 = common-tab-v2 ไม่มีช่อง DLL) · เปิดสิทธิ์บนบัญชีเดโมได้ (ติดต่อทีมงาน) · กราฟ XAUUSD M1 · ระบบสิทธิ์ (ล็อกอินผ่านทุกกรณี, ส่งเลขบัญชี+เซิร์ฟเวอร์ทาง LINE, ทำงานใน 5 นาที, ผ่อนผัน 72 ชม.) · backtest ช่วง 2026.01.01 ถึง 2026.08.31 · **ส่วนผลทดสอบ ทุนแนะนำ และกลไกเทรด (ไม้แก้ ทบไม้ ข่าว) ในไฟล์นั้น ยังห้ามลงเว็บ**
3. ห้ามลบหรือลด disclaimer / risk warning (ยกเว้นกล่องท้ายเว็บ: เจ้าของขอให้สั้น 1-2 บรรทัด ใช้ `footer_risk_short` + ลิงก์ไป /risk-disclosure/ · ฉบับเต็มยังอยู่หน้าแรก /go บทความ) · ระบุความเป็นพันธมิตรกับ Zaurix ตรงที่กล่าวถึงครั้งแรก · ลิงก์สมัครโบรกเกอร์ = ลิงก์พาร์ตเนอร์ `broker_signup_url` (https://portal.zaurix.com?ref=236954 · เจ้าของให้ 6 ต.ค. 2026) ใช้ผ่าน `[eawing_broker field="url"]` หรือปุ่มขั้นที่ 1 ของ /go เท่านั้น · ติด rel="sponsored" เสมอ · หน้า /go ไม่ใส่ข้อความเปิดเผยค่าตอบแทนใต้ปุ่ม (เจ้าของสั่งเอาออก 6 ต.ค. 2026) ส่วนเพจ open-mt5-account และข้อกำหนดยังมี
4. Escape ทุก output · ห้าม em dash / en dash (ใช้ `·` หรือ `:`)
5. ไม่มี build step · WP 6.0+ · PHP 7.4+

## แบรนด์
- สี: น้ำเงินปีก `#0B5CAD` · กรมท่า `#0A2E66` · กรมท่าเข้ม `#011D3B` · ทอง `#F6D57A` `#EFC25A` `#D9A12E` `#BB831F` · ทองตัวอักษร `#8F620C` · ฟ้า `#F7FAFE` `#EEF4FC` `#E2EDFB`
- ปุ่มหลักทอง **แบบแฟลทสีเดียว `#EFC25A`** ชี้แล้ว `#E3B03C` ตัวกรมท่า (`.btn-fire` · style.css ส่วน 49 · ห้ามไล่สีทอง เจ้าของว่าดูโบราณ 8 ต.ค. 2026 · `--grad-fire`/`--grad-gold` เป็นสีเดียวแล้ว) · ปุ่มรองกรมท่า (`.btn-dark`) · ปุ่มเส้น `.btn-ghost` = พื้นใส ขอบกรมท่า (style.css ส่วน 46 · ห้ามปุ่มพื้นขาวบนพื้นสีอ่อน) · ปุ่มที่ลิงก์ LINE OA เป็นสีเขียวเสมอ · กระเบื้องไอคอน `.tile--sky|gold|blue|navy`
- หน้า /go (`assets/css/go.css`): พื้นกรมท่าเข้มมีแสงฟ้า/ทอง + ลายจุด + ตารางเอียง + เส้นปีก · การ์ดใบเดียวแบบกระจกเบลอ (glassmorphism, backdrop-filter · ไม่มี = กรมท่าทึบ) (เจ้าของขอ 8 ต.ค. 2026) · ปุ่ม: ทอง ตัวกรมท่า = ลงมือทำ (สมัคร Portal ดาวน์โหลด) · เส้นขาวพื้นใส = คู่มือ/หน้าในเว็บ · เขียว = LINE · OpenChat ขาวขอบเขียว · เลขขั้นวงกลมทอง · ข้อความขั้นสั้น 1 ถึง 2 บรรทัด
- ฟอนต์ self-host: Kanit 500/600/700 (หัวข้อ) + Noto Sans Thai (เนื้อความ) · `assets/css/fonts.css` + `eaw_infra_font_files()`
- ไม่มีโหมดมืด (`eaw_is_dark_mode()` คืน false)
- **ภาษาอังกฤษเป็นพิมพ์ใหญ่ทั้งเว็บ** (style.css ส่วน 45 · CSS เท่านั้น ข้อความจริงไม่เปลี่ยน) · คำที่ต้องคงตัวพิมพ์ (อีเมล ลิงก์ @LINE ID ไฟล์ .ex5 XAUUSD.c iPhone/iPad/iOS/macOS) ห่อ `.nocaps` อัตโนมัติโดย `eaw_nocaps_buffer()` ใน infra.php · เจออีกแบบให้เพิ่มใน `eaw_nocaps_pattern()`
- **สีตามความหมาย** (style.css ส่วน 48 · เจ้าของขอ 8 ต.ค. 2026): ✓ = เขียว `--ok` · ✗/ไม่มี = แดง `--bad` · คำเตือน (!) และไอคอน `svg[data-icon="warn"]` = อำพัน `--warn` · เคล็ดลับ = เขียว · ข้อมูลทั่วไป = ฟ้า · ห้ามใช้ทอง/กรมท่าของธีมกับเครื่องหมายถูกผิด · `eaw_icon()` ใส่ `data-icon` ให้ทุกไอคอน
- กฎขอบการ์ด (style.css ส่วน 47) ใช้ !important: ส่วนที่ตั้งใจไม่มีกรอบบนจอแคบ (`.gd-step` ≤760px, `.table-wrap--stack` และ `.cmp-wrap` ≤640px) ต้องยกเว้นต่อท้ายกฎนั้น
- **ไม่มีเงา (box-shadow) ทั้งเว็บ** (style.css ส่วน 44 ลบทุกจุด เจ้าของไม่ชอบ) · แยกบล็อกด้วยขอบและสีพื้นแทน · อย่าเพิ่มเงาใหม่
- **ไม่มีคำเล็กเหนือหัวข้อ (kicker)** ทั้งเว็บ: `show_kickers` = false (เจ้าของไม่ชอบ) · อย่าเพิ่ม kicker ใหม่
- ปุ่ม/ไอคอนช่องทางใช้สีแบรนด์จริง ไม่กลืนธีม: LINE `#06C755` (header, ปุ่มลอย, แผงติดต่อ · ช่อง LINE ในแถบล่างมือถือหน้าตาเหมือนช่องอื่น และแถบไม่ย่อตอนเลื่อน)
- แถบล่างมือถือ: พื้นกรมท่า `#0A2E66` ทึบ (ไม่ใช่น้ำเงินปีก) 5 ช่องเท่ากัน ตัวขาว ทรงแคปซูล · ช่องหน้าปัจจุบันแคปซูลขาวทึบตัวกรมท่า · OpenChat ขาวขอบเขียว · Facebook `#1877F2` · อีเมล กรมท่า
- QR LINE: `assets/img/brand/eawing-line-qr.png` (ถอดได้ https://lin.ee/9wCzGEg → @eawing) · ไม่มีกรอบนอกสุด (.site-frame ไม่มีขอบ/เงา)
- รูป: `assets/img/brand/` (wordmark, icon, favicon, การ์ดแชร์) สร้างจากโลโก้จริงใน media eawing.co · `assets/img/banners/eawing-*.webp` จากภาพโฆษณาของเจ้าของ (เฉพาะภาพที่ไม่มีตัวเลขกำไร) · `assets/img/covers/<slug>.webp` สร้างด้วย `dev/make-covers.php` · ปกเพจ `covers/page-<slug>.webp` (`make-covers.php page-<slug>` · ปุ่ม Setup "3) ตั้งค่า SEO" ตั้งเป็นภาพเด่นให้เพจที่ยังไม่มี แล้วต้องกดอัปเดตเพจให้ Yoast อ่านใหม่) · ภาพในเนื้อหา `assets/img/illus/` สร้างด้วย `dev/make-art.php <name>` (แม่แบบ `dev/preview/art.php` แบบกว้าง + แบบมือถือ) · ภาพหน้าจอคู่มือติดตั้ง `assets/img/install/` (ขั้น 1 ถึง 5 · จากคู่มือ FENIX เว็บในเครือ แก้เป็น EA_WING_V4.2 · ค่า `assets/...` ในช่องรูปของคู่มือใช้ได้ `eaw_media_slot` แปลงเป็น URL และอ่านขนาดจริง) · ใส่ในเพจ/บทความด้วย `[eawing_figure name="..."]` (license-flow ใน how-to-install · vps-flow ใน 3 เพจ VPS · account-flow ใน open-mt5-account)
- ภาพหน้าจอคู่มือทุกหน้า `assets/img/guides/` (8 ต.ค. 2026 · เอามาจากคู่มือเว็บในเครือของเจ้าของ fenixpro-th.com ครอปแถบเบราว์เซอร์ เบลอข้อมูลส่วนตัว ภาพจำลอง SVG เปลี่ยนเป็นโทนกรมท่า-ทองและชื่อ EA WING VPS) · กำหนดเป็นช่องที่ 5 ของแต่ละขั้นใน `eaw_guide_data()` → ค่าเริ่มต้น `{prefix}_stepN_img` · หน้าแรกการ์ดติดตั้งใช้ภาพแดชบอร์ดจริง (`ih_step1_img`)
- หน้าคู่มือ **ฝากเงิน Zaurix** `/deposit/` (prefix `gdep`, เพิ่ม 8 ต.ค. 2026) · /go ขั้นฝากเงินลิงก์มาที่หน้านี้
- **เปลี่ยนรูปในธีมเมื่อไหร่ให้เปลี่ยนชื่อไฟล์** (Cloudflare แคชรูปตาม URL) · Cloudflare Cache Rule "Static files 1 month" (7 ต.ค. 2026): css js webp png jpg jpeg woff2 svg → Browser TTL 1 เดือน · CSS/JS มี ?ver= ใหม่ทุก deploy อยู่แล้ว · หน้า HTML ไม่อยู่ในกฎนี้ (ยังเป็น s-maxage=300)
- ช่องทางจริง (ตั้งใน Customizer บน eawing.co แล้ว 1 ต.ค. 2026): LINE OA `https://line.me/R/ti/p/@eawing` · Facebook `https://www.facebook.com/share/1EouUMc9v1/` · โบรกเกอร์ `Zaurix` เซิร์ฟเวอร์ `Zaurix-Server` · OpenChat `https://line.me/ti/g2/xGup9Uap8lRAsu6e25T4qYJqBfFFFzJPSsUMFw` (ตั้งแล้ว)

## โครงโค้ด (สรุป)
- `functions.php` bootstrap + `eaw_defaults()` + helper (`eaw_mod`, `eaw_lines`, `eaw_logo_url`, `eaw_wordmark_url` …) แล้ว require `inc/*.php` และ glob `inc/modules/*.php`
- โมดูล: `chrome` (header/footer/dock/CTA) · `home` · `homeplus` (ส่วนเสริมหน้าแรก: story, แท็บ Lite/Full, การ์ดล็อกอินจำลอง, ตารางเปรียบเทียบ, เช็กลิสต์พร้อมเริ่ม, บทความล่าสุด, FAQ ข้อ 11 ถึง 14) · `pages` · `guides` · `go` · `consent` (PDPA) · `infra` (REST, hardening, ฟอนต์, กันบทความตั้งเวลาพลาด) · `clusters` (เสาหลักของแต่ละหมวด `eaw_cluster_pillars()`, กล่อง "บทความในชุดนี้" ท้ายบทความ, เสาหลักขึ้นก่อนในหน้าหมวด)
- `inc/setup.php` manifest เพจ `eaw_site_pages()` + บทความ `eaw_seed_article_covers()` + หน้า admin **ลักษณะ → EA WING Setup**
- หมวดบทความ 8 หมวด = 8 กลุ่ม (8 ต.ค. 2026 · `eaw_article_categories()` ใน setup.php ที่เดียว): EA และบอทเทรด (`ea-basics`) · ใช้งาน MT5 (`mt5`) · VPS สำหรับ EA (`vps`) · เทรดทองคำ XAUUSD (`gold-trading`) · บริหารความเสี่ยง · วางแผนการเทรด · ติดตามผล · บัญชีและโบรกเกอร์ (`broker-account`) · หน้า /articles/ มีการ์ดหมวด (`articles_pillars_*`) ก่อนรายการคู่มือ
- บทความ: ทุกไฟล์ใน `inc/content/articles/` ถูกนำเข้าอัตโนมัติ · meta `date` = ตั้งเวลาลง (WordPress scheduled) · `rev` ≥ 2 = ปุ่ม Setup "อัปเดตบทความที่มีอยู่" แทนเนื้อหา (ไม่มี rev = ไม่ทับของที่แก้ใน wp-admin) · ปุ่มเดียวกันย้ายหมวด ตั้งชื่อ/คำอธิบายหมวด และเลื่อนวันลงของบทความที่ยังไม่ถึงวัน
- `inc/seo.php` schema/OG/robots/redirect map (`eaw_redirect_map`) · `inc/shortcodes.php` `[eawing_line|brand|broker|calc]`
- CSS: `style.css` (ฐานเดิม + section 43 Glass Sky foundation ท้ายไฟล์) แล้วตามด้วย `assets/css/<module>.css` ที่ enqueue อัตโนมัติ

## ก่อน commit
- PHP พร้อม extension: `php -d "extension_dir=<php>/ext" -d extension=mbstring -d extension=gd` (สคริปต์ `phpx` ใน scratchpad ของ session)
- `php -l` ทุกไฟล์ที่แก้ · `dev/check-settings.php` ต้องได้ "(none)" 2 บรรทัด · `dev/check-content.php` ต้อง "all good" · `dev/check-brand.php` ต้อง "no brand leaks"
- Preview: launch config `eawing-preview` → http://localhost:8765/ (ทุก slug ใน manifest, `/article/<slug>/`, `/__cover/<slug>/`, `/mockup/`)
- ตรวจจอ 375 / 820 / 1366 · `scrollWidth === innerWidth` · ไม่มี Fatal/Warning/Notice ในหน้าที่เรนเดอร์
- งานใหญ่ทำใน branch `rebuild` (ไม่ push จนพร้อมขึ้นเว็บ) · `main` ต้องพร้อม deploy เสมอ

## สถานะเว็บจริง (1 ต.ค. 2026)
- ธีม EA WING 1.0.0 เปิดใช้บน eawing.co ผ่าน WP Pusher · รัน EA WING Setup แล้ว: สร้าง 11 เพจ, หน้าแรก = /home/ (id 20), หน้าบทความ = /articles/ (id 35), เมนูหลัก, /go/ ใช้ template-go.php
- 6 ต.ค. 2026 (ธีม 1.0.3): เพจกฎหมายครบและเผยแพร่ทั้ง 4 หน้า · ผู้ให้บริการ = ทีมงาน EA WING (ไม่มีที่อยู่) · อีเมล easpeciallab@gmail.com · terms วางโครงตาม TERRA (justymatch.com/TERRA/terms เจ้าของเดียวกัน) · ลบข้อมูล: ตอบรับ 7 วัน ลบ 30 วัน สำรอง 90 วัน · เก็บแชต/สิทธิ์ไม่เกิน 2 ปี
- แพ็กเกจ (อิง fenixpro-th.com/pricing/ เจ้าของเดียวกัน): Starter ฟรี (ปรึกษา) · Pro 6,990 บาท (1 ถึง 2 บัญชี) · VIP 9,990 บาท (ช่วยติดตั้ง) · pricing_mode = price · จ่ายครั้งเดียว (ไม่มีรายเดือน/รายปี) · ไม่มีการคืนเงิน (เจ้าของยืนยัน 6 ต.ค. 2026)
- บทความ 12 เรื่องเผยแพร่แล้ว (หมวด trading-plan / monitoring / risk-management)
- เพจเก่า results / guides / risk-warning อยู่ในถังขยะ (redirect 301 ทำงาน)
- 2 ต.ค. 2026: รัน "3) ตั้งค่า SEO และระบบ" แล้ว · Yoast มีองค์กร/โลโก้/รูปแชร์เริ่มต้น/Facebook · ปิด author/date/format archive · ชื่อหน้าหมวด ค้นหา 404 เป็นไทย · คอมเมนต์ปิดทั้งเว็บ · schema ผู้เขียนบทความ = องค์กร EA WING
- ผลตรวจ SEO (สคริปต์ crawl sitemap): ทุกหน้ามี title/description/H1 เดียว/og:image · รูปมี alt และขนาดครบ · ไม่มีหน้ากำพร้า · ลิงก์นอกมี noopener ครบ · canonical ยังไม่ออกเพราะทั้งเว็บ noindex (Yoast ใส่ให้เองเมื่อเปิดให้ค้นหา)
- 7 ต.ค. 2026: เปิดให้ค้นหาแล้ว (index) · Search Console ยืนยันแบบโดเมนและส่ง sitemap แล้ว · 8 ต.ค. 2026: GA4 `G-VZPGBNF86F` (พร็อพเพอร์ตี้ EA WING ในบัญชี FENIX PRO EA) ใส่ใน Customizer หมวด 18 แล้ว · ทดสอบผ่าน: ก่อนยินยอมไม่โหลดแท็ก หลังยินยอมส่ง page_view + line_click · ห้ามเชื่อม Analytics ผ่าน Site Kit (แท็กซ้ำ ข้าม PDPA) · ใน GA4 ตั้งแล้ว: เก็บข้อมูล 14 เดือน · มิติข้อมูล "LINE button position" = line_pos · ลิงก์ Search Console (โดเมน eawing.co) · ยังต้องติดดาว line_click / openchat_click เป็น Key event เมื่อขึ้นในรายการ · ไม่ใช้ Meta Pixel (เจ้าของตัดออก 8 ต.ค. 2026 ไม่ต้องเสนออีก · ช่อง fb_pixel_id ในธีมยังอยู่ ใช้ได้ทันทีถ้าวันหน้ายิงแอด Facebook)
- 8 ต.ค. 2026 (ธีม 1.0.43): บทความ 143 บทในระบบ · เผยแพร่ 20 · ตั้งเวลา 119 บท (วันละบท 08:00 น. 15 ต.ค. 2026 ถึง 14 ก.พ. 2027 · ปฏิทินใน docs/content-plan.md) · **ไม่ลง 4 บท** (เจ้าของตัดสินใจ 8 ต.ค. 2026): zaurix-overview, broker-license, forex-tax, forex-legal-thailand · ไฟล์ย้ายไป docs/held-articles/ · ลิงก์จากบทอื่นถูกแทนด้วยการแนะนำหน่วยงาน (ธปท. 1213 · ก.ล.ต. 1207 · สรรพากร 1161) · ห้ามเขียนบทเรื่องกฎหมาย/ภาษี Forex/ใบอนุญาตโบรกเกอร์/รีวิว Zaurix ใหม่โดยไม่ถามเจ้าของ · เรื่องประกาศ ธปท. เจ้าของรับทราบแล้วและไม่ต้องการดำเนินการ (8 ต.ค. 2026) ไม่ต้องเสนออีก · 1.0.44: แผนภาพเสาหลัก 8 ภาพ (dev/preview/art-types.php → make-art.php · ชื่อใน eaw_figure_registry: ea-loop mt5-map vps-path gold-sessions risk-layers plan-cycle monitor-rhythm broker-checklist)
- 7 ต.ค. 2026: ปลั๊กอินเหลือ Yoast SEO · WP Pusher · Site Kit · Yoast Duplicate Post (เจ้าของลบ Elementor/Elementor Pro/GTranslate/PixelYourSite และเมนูเก่าแล้ว) · เมนูเหลือ "EA WING · เมนูหลัก" · ไม่ทำส่วนรีวิว (เจ้าของตัดออก)
