# EA WING · แผนงานทั้งเว็บ (1 ต.ค. 2026)

ดีไซน์: `docs/design.md` (Glass Sky) · ต้นแบบหน้าแรก: `dev/mockup/` (เปิดผ่าน preview `/mockup/`)

## 1) หลัก

- **โครงหน้าและระบบ** เท่า ea2000.co ครบ · **หน้าตา** เป็นของ EA WING เอง (Glass Sky) · **ข้อความ** เขียนใหม่ทั้งหมด ไม่คัดลอกจาก ea2000 / FALCON (กัน duplicate content ข้ามโดเมนของเจ้าของเดียวกัน)
- จุดยืนแบรนด์จากภาพโฆษณา: **"บินอย่างมีแบบแผน ไปได้ไกลกว่าเดิม" · วางแผน · ติดตาม · บริหารความเสี่ยง** ใช้เป็นแกนเนื้อหาและ SEO ให้ต่างจาก ea2000 (เน้นทอง/แก้ปัญหา MT5) และ FALCON
- ปิดการขายทาง LINE เท่านั้น · ไม่แต่งรีวิว · ไม่ใส่ตัวเลขผลเทรดสมมติ · ไม่บอกว่า EA ใช้ martingale/grid/SL/TP หรือไม่ · disclaimer ห้ามลด
- แพ็กเกจ: โหมด "ติดต่อสอบถาม" (ไม่มีราคา) จนกว่าเจ้าของกำหนดราคา

## 2) วิธีสร้าง

fork โค้ดธีม FALCON PRO (สถาปัตยกรรม v3 แบบโมดูล ซึ่งยึดโครง ea2000 อยู่แล้ว) มาเป็น `eawing/`

| ระบบ | ที่มา | งานที่ EA WING ต้องทำ |
|---|---|---|
| ค่าเริ่มต้น + Customizer loop (~1,070 ช่อง) | FALCON | เขียนข้อความใหม่ทั้งหมด |
| เพจ manifest + หน้า Setup (สร้างเพจ เมนู หน้าแรก นำเข้าบทความ) | FALCON | เปลี่ยนชื่อเป็น "EA WING Setup" |
| คู่มือ 5 หน้า (ขั้นตอน + ช่องรูป + FAQ + คู่มือที่เกี่ยวข้อง) | FALCON | ข้อความใหม่ |
| คุกกี้ PDPA 3 หมวด + GA4/Pixel หลังยินยอม | FALCON | สไตล์ใหม่ |
| SEO: schema, OG, robots, redirect map, verification | FALCON | ใส่ redirect ของ eawing.co |
| LINE CTA ทุกจุด + event `line_click` ตามตำแหน่ง | FALCON | ปุ่มทอง |
| เครื่องคำนวณ Lot / Drawdown | FALCON | สไตล์ใหม่ |
| REST อ่าน/เขียน Customizer | FALCON | namespace `eawing/v1` |
| เครื่องมือ dev (preview, check-settings, check-content, check-brand, make-covers) | FALCON | ปรับชื่อ |

- prefix ภายใน `fenix_` → เปลี่ยนเป็น `eaw_` ทั้งหมดครั้งเดียวตอน fork (ไม่ให้ชื่อแบรนด์อื่นโผล่ใน source)
- ลบ: โหมดมืด, บล็อกตัดทแยง, footer watermark, แบนเนอร์และรูปปกของ FALCON ทั้งหมด

## 3) เพจและ SEO รายหน้า

title ลงท้าย ` · EA WING` (≤ 60 ตัวอักษร) · meta description 120-155 ตัวอักษร · canonical ตัวเอง · ผูกคีย์เวิร์ดหน้าละ 1 คำ ห้ามซ้ำกันเอง

| slug | template | H1 / หัวข้อหลัก | focus keyword | ลิงก์ภายในหลัก (นอกเหนือเมนู) | ลิงก์ภายนอก |
|---|---|---|---|---|---|
| `/` | front-page | EA WING ผู้ช่วยเทรดอัตโนมัติสำหรับ MT5 | EA WING EA MT5 | /how-to-install/ /backtest/ /forward-test/ /pricing/ /risk-disclosure/ + บทความหลัก 3 | - |
| `/backtest/` | template-backtest | ทดสอบ EA ย้อนหลังใน MT5 ด้วย Strategy Tester | ทดสอบ ea ย้อนหลัง mt5 | /forward-test/ /tools/ บทความ Equity/Balance | metatrader5.com (help Strategy Tester) |
| `/forward-test/` | template-forward | ทดสอบ EA กับตลาดจริงก่อนใช้เงินจริง | forward test ea คือ | /backtest/ /open-mt5-account/ บทความติดตามผล | - |
| `/how-to-install/` | template-install | ติดตั้ง EA WING บน MT5 ทีละขั้น | ลง ea ใน mt5 | /mt5-login/ /vps-windows/ บทความ Journal/Experts | metatrader5.com (help Algo Trading) |
| `/open-mt5-account/` | template-guide | เปิดบัญชี MT5 เพื่อใช้ EA WING | สมัครบัญชี mt5 | /mt5-login/ /forward-test/ /go/ (ไม่ลิงก์โบรกเกอร์ตรง ขอลิงก์ทาง LINE) | - |
| `/mt5-login/` | template-guide | ติดตั้ง MT5 และล็อกอินบนมือถือและคอม | ล็อกอิน mt5 มือถือ | /how-to-install/ บทความแจ้งเตือน MT5 | apps.apple.com, play.google.com, metatrader5.com |
| `/vps-windows/` | template-guide | ใช้ Windows VPS รัน EA ด้วย Remote Desktop | vps รัน ea | /vps-android/ /vps-ios/ /how-to-install/ | learn.microsoft.com (Remote Desktop) |
| `/vps-android/` | template-guide | เข้า VPS จากมือถือ Android | vps android | /vps-windows/ | play.google.com (Windows App) |
| `/vps-ios/` | template-guide | เข้า VPS จาก iPhone และ iPad | vps iphone | /vps-windows/ | apps.apple.com (Windows App) |
| `/tools/` | template-guide (tools) | เครื่องคำนวณ Lot และ Drawdown | คำนวณ lot size | บทความความเสี่ยงต่อออเดอร์ /risk-disclosure/ | - |
| `/pricing/` | template-pricing | แพ็กเกจ EA WING | ราคา ea wing | /how-to-install/ /risk-disclosure/ /go/ | - |
| `/risk-disclosure/` | template-risk | ความเสี่ยงของการใช้ EA เทรดบน MT5 | ความเสี่ยงการใช้ ea | บทความบริหารความเสี่ยงทั้งหมด (สูงสุด 4) | sec.or.th (คำเตือนนักลงทุน) |
| `/about/` | page | เกี่ยวกับ EA WING | เกี่ยวกับ ea wing | /risk-disclosure/ /pricing/ | - |
| `/privacy-policy/` `/terms-of-use/` `/data-deletion/` | page | เอกสาร | - | ถึงกัน + /privacy-policy/#cookies | pdpc.or.th (privacy) |
| `/articles/` | index (posts page) | บทความ EA WING | - (noindex จนมีบทความ ≥ 6) | ทุกบทความ | - |
| `/go/` | template-go | ลิงก์รวม (noindex) | - | คู่มือ แพ็กเกจ เอกสาร | lin.ee, line.me, ร้านแอป MT5, Zaurix portal |

**ลิงก์ภายนอก**: `target="_blank" rel="noopener"` · ลิงก์พันธมิตร/โบรกเกอร์ `rel="sponsored noopener"` · แหล่งอ้างอิงต้องเป็นต้นทาง (MetaQuotes, Microsoft, ก.ล.ต., สคส.) ห้ามลิงก์คู่แข่ง

**กฎลิงก์ภายใน** (ยึดของ ea2000)
1. บทความลิงก์เพจหลักของกลุ่ม 1 ครั้งใน 2 ย่อหน้าแรก
2. ปิดท้ายด้วยลิงก์ money page 1 ลิงก์ (`/`, `/pricing/` หรือ `/how-to-install/`) + บล็อก LINE · ห้ามลิงก์ `/go/` ในเนื้อบทความ
3. พูดถึงผลตอบแทน/drawdown ต้องลิงก์ `/risk-disclosure/`
4. เพจหลักลิงก์ออกไปบทความได้ไม่เกิน 4
5. anchor ใช้คำค้นจริง ซ้ำได้ไม่เกิน 3 หน้า · ไม่มีหน้ากำพร้า (ทุกหน้ามีลิงก์เข้า ≥ 2)
6. ลิงก์ลึกถึง section ด้วย `#prefix-sec-N`

**Schema**: Organization + WebSite (Yoast) · BreadcrumbList ทุกหน้า · SoftwareApplication หน้าแรก/แพ็กเกจ (ไม่มี offer จนกว่ามีราคา) · FAQPage หน้าแรก + เพจที่มี FAQ · Article (บทความ)

**robots / redirect**
- noindex: `/go/`, ค้นหา, หมวดที่มีบทความ < 4, author, attachment
- 301: `/results/`→`/backtest/` · `/guides/`→`/how-to-install/` · `/risk-warning/`→`/risk-disclosure/` · `/ea-products/`→`/pricing/` · `/category/other/`→`/articles/` (เก็บ utm/gclid/fbclid)
- ทั้งเว็บยัง "ปิดการค้นหา" จนเปิดตัว (ข้อ 7)

## 4) บทความรอบแรก 12 เรื่อง (แกน วางแผน · ติดตาม · ความเสี่ยง)

ไม่ชนคีย์เวิร์ดกับ ea2000 / FALCON · ≥ 1,200 คำไทย · คำตอบสั้น 2 ประโยคก่อน H2 แรก · FAQ 3-5 ข้อ · ภาพปกสร้างจาก `make-covers`

| # | slug | หัวข้อ | หมวด | focus keyword | hub |
|---|---|---|---|---|---|
| 1 | trading-plan-for-ea | เขียนแผนการเทรดก่อนเปิดใช้ EA | วางแผนการเทรด | แผนการเทรด | / |
| 2 | risk-per-trade | ความเสี่ยงต่อออเดอร์กี่เปอร์เซ็นต์ดี | วางแผนการเทรด | ความเสี่ยงต่อออเดอร์ | /tools/ |
| 3 | capital-split-ea | แบ่งทุนใช้ EA หลายบัญชีอย่างไร | วางแผนการเทรด | แบ่งทุนเทรด | /pricing/ |
| 4 | daily-loss-limit | ตั้งเพดานขาดทุนรายวันให้พอร์ต | วางแผนการเทรด | daily loss limit | /risk-disclosure/ |
| 5 | mt5-mobile-monitor | ติดตามผล EA บนมือถือด้วยแอป MT5 | ติดตามผล | ดูผล ea มือถือ | /mt5-login/ |
| 6 | mt5-push-notification | ตั้งแจ้งเตือน MT5 เข้ามือถือด้วย MetaQuotes ID | ติดตามผล | แจ้งเตือน mt5 มือถือ | /mt5-login/ |
| 7 | mt5-journal-experts-tab | อ่านแท็บ Journal และ Experts หาสาเหตุ EA ไม่ทำงาน | ติดตามผล | mt5 journal | /how-to-install/ |
| 8 | mt5-history-report | ดึงรายงานประวัติการเทรดจาก MT5 มาทบทวน | ติดตามผล | รายงาน mt5 history | /forward-test/ |
| 9 | equity-vs-balance | Equity กับ Balance ต่างกันอย่างไร | บริหารความเสี่ยง | equity balance ต่างกัน | /risk-disclosure/ |
| 10 | risk-reward-ratio | Risk Reward Ratio คืออะไร คำนวณอย่างไร | บริหารความเสี่ยง | risk reward ratio คือ | /tools/ |
| 11 | currency-correlation | เปิดหลายคู่เงินพร้อมกัน ความเสี่ยงซ้อนที่มองไม่เห็น | บริหารความเสี่ยง | correlation คู่เงิน | /risk-disclosure/ |
| 12 | weekend-gap-ea | Gap วันจันทร์กับ EA เตรียมรับอย่างไร | บริหารความเสี่ยง | gap ราคา forex | /risk-disclosure/ |

ลำดับเผยแพร่: วันเว้นวัน 09:00 น. หลังเจ้าของอนุมัติร่าง · หมวดเปิด index เมื่อครบ 4 เรื่อง · หลังครบ 12 เรื่องตรวจ Search Console 1 สัปดาห์ก่อนรอบสอง

## 5) เก็บกวาด eawing.co

| ของเดิม | จัดการ |
|---|---|
| หน้าแรก id 20 (slug home) | ใช้ต่อเป็น front page ของธีมใหม่ |
| /articles/ id 35 | ใช้ต่อเป็น posts page |
| /about/ 27, /privacy-policy/ 3, /data-deletion/ 11 | แทนเนื้อหาด้วยของ EA WING (privacy/terms/data-deletion เป็นร่างรอเจ้าของตรวจ) |
| /results/ 23, /guides/ 25, /risk-warning/ 29 | ย้ายลงถังขยะ + 301 ตามข้อ 3 |
| หมวด other, เมนู Navigation เก่า | redirect / แทนด้วยเมนูใหม่ |
| ธีม easpecial (WP Pusher) | เก็บไว้ 2 สัปดาห์เผื่อย้อนกลับ แล้วลบ |
| Elementor floating buttons, GTranslate | ปิดถ้าไม่ใช้ |

## 6) ลำดับงาน

| ขั้น | งาน | สถานะ |
|---|---|---|
| 0 | repo `eawing-theme`, WP Pusher, หน้า /go ชั่วคราว, ชื่อเว็บ EA WING | เสร็จ |
| 1 | fork FALCON → `eawing/` · เปลี่ยนชื่อแบรนด์และ prefix · เครื่องมือตรวจผ่าน | เสร็จ |
| 2 | ใส่ดีไซน์ Glass Sky ทุกเทมเพลต (header, footer, dock, หน้าแรก, หน้าย่อย, คู่มือ, แพ็กเกจ, /go, คุกกี้, 404, บทความ) | เสร็จ |
| 3 | เขียนข้อความใหม่: ค่าเริ่มต้นทุกช่อง + เนื้อหา 15 เพจ | เสร็จ |
| 4 | รูป: wordmark, ไอคอน, การ์ดแชร์ 1200×630, แบนเนอร์จากภาพที่ไม่มีตัวเลข, ภาพปกบทความ · ฟอนต์ Kanit + Noto Sans Thai self-host | เสร็จ |
| 5 | deploy → หน้า Setup สร้างเพจ/เมนู/หน้าแรก → แทนเพจเก่า → redirect → ตรวจหน้าเว็บจริงทุกหน้า | เสร็จ 1 ต.ค. |
| 6 | บทความรอบแรก 12 เรื่อง | เผยแพร่ครบแล้ว (เว็บยัง noindex) |
| 7 | เปิดตัว: GA4/Pixel (หลังยินยอม), Search Console, เปิดให้ค้นหา, ส่ง sitemap | |

## 7) ข้อมูลจริงที่ต้องได้จากเจ้าของ (ระหว่างนี้ใช้ช่องว่าง/ซ่อนปุ่ม)

- ภาพหน้าจอคู่มือ (รายการใน `dev/image-shot-list.md`) จากบัญชีเดโม
- ราคาแพ็กเกจ (ถ้าจะแสดง) และสิ่งที่ได้ในแต่ละแพ็กเกจ
- ข้อมูลผู้ให้บริการสำหรับ privacy / terms (ชื่อ ที่อยู่ อีเมลติดต่อ)
- GA4 Measurement ID, Meta Pixel ID, รหัสยืนยัน Search Console
- รีวิวจริง (ถ้ามี) ก่อนเปิดส่วนรีวิว
