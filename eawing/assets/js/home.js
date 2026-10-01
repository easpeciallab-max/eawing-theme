/**
 * EA WING · หน้าแรก (home.js)
 * โหลดหลัง main.js เฉพาะหน้าแรก · ทำงานเมื่อมี main.home-v3 (front-page.php)
 *
 * - FAQ: เปิดได้ทีละข้อในเบราว์เซอร์ที่ยังไม่รองรับ <details name> (เบราว์เซอร์ใหม่ทำเองอยู่แล้ว)
 * ไม่มี JS / ไฟล์นี้โหลดไม่ขึ้น = ทุกส่วนใช้งานได้ครบ (details เปิดปิดได้ตามปกติ)
 */
(function () {
	'use strict';

	var root = document.querySelector('.home-v3');
	if (!root) {
		return;
	}

	var questions = root.querySelectorAll('details.hm-q[name]');
	if (!questions.length || typeof window.HTMLDetailsElement === 'undefined' || 'name' in window.HTMLDetailsElement.prototype) {
		return;
	}

	Array.prototype.forEach.call(questions, function (item) {
		item.addEventListener('toggle', function () {
			if (!item.open) {
				return;
			}
			Array.prototype.forEach.call(questions, function (other) {
				if (other !== item && other.open && other.getAttribute('name') === item.getAttribute('name')) {
					other.open = false;
				}
			});
		});
	});
})();
