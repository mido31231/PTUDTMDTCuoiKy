// ===== Set default dates =====
(function setDefaultDates(){
  try {
    const now = new Date();
    const tomorrow = new Date(now.getTime() + 24*60*60*1000);

    const toISO = d => d.toISOString().slice(0,10);

    const ci = document.getElementById('checkin');
    const co = document.getElementById('checkout');

    if(ci) ci.value = toISO(now);
    if(co) co.value = toISO(tomorrow);
  } catch(e){
    console.error('date init error', e);
  }
})();

// ===== DOM Ready =====
document.addEventListener('DOMContentLoaded', function(){

  /* ===== Gallery ===== */
  const thumbs = document.querySelectorAll('.thumb');
  const mainPhoto = document.getElementById('mainPhoto');

  thumbs.forEach((thumb, i) => {
    if(i === 0) thumb.classList.add('active');

    thumb.addEventListener('click', () => {
      const full = thumb.getAttribute('data-full') || thumb.src;
      if(mainPhoto) mainPhoto.src = full;

      thumbs.forEach(t => t.classList.remove('active'));
      thumb.classList.add('active');
    });
  });

  /* ===== FAQ Ask question ===== */
  const askBtn = document.getElementById('askBtn');

  if(askBtn){
    askBtn.addEventListener('click', () => {
      const input = document.getElementById('askInput');
      const result = document.getElementById('askResult');

      if(!input || input.value.trim() === ''){
        alert('Vui lòng nhập câu hỏi.');
        return;
      }

      if(result) result.style.display = 'block';
      input.value = '';
    });
  }

  /* ===== Search rooms button ===== */
  const searchBtn = document.getElementById('searchBtn');

  if(searchBtn){
    searchBtn.addEventListener('click', () => {
      const ci = document.getElementById('checkin').value;
      const co = document.getElementById('checkout').value;
      const adults = document.getElementById('adults').value;
      const children = document.getElementById('children').value;
      const roomsCount = document.getElementById('roomsCount').value;

      if(!ci || !co){
        alert('Vui lòng chọn ngày nhận và trả phòng.');
        return;
      }

      alert(
        `Đang tìm phòng:\n` +
        `Nhận phòng: ${ci}\n` +
        `Trả phòng: ${co}\n` +
        `Người lớn: ${adults}\n` +
        `Trẻ em: ${children}\n` +
        `Số phòng: ${roomsCount}`
      );
    });
  }

  /* ===== Book room buttons ===== */
  document.querySelectorAll('.book-now').forEach((btn) => {
    btn.addEventListener('click', function(e){
      const roomEl = e.target.closest('.room');
      if(!roomEl) return;

      const roomName = roomEl.querySelector('h4')?.innerText || 'Phòng';
      const qtyEl = roomEl.querySelector('.qty');
      const qty = parseInt(qtyEl?.value || '0');

      let priceText = '';
      const nowPrice = roomEl.querySelector('.now-price');
      const price = roomEl.querySelector('.price');

      if(nowPrice) priceText = nowPrice.innerText;
      else if(price) priceText = price.innerText;

      priceText = priceText.replace(/[^\d]/g,'');

      if(qty === 0){
        alert('Vui lòng chọn số lượng phòng.');
        return;
      }

      const params = new URLSearchParams({
        room: roomName,
        qty: qty,
        price: priceText
      });

      window.location.href = 'checkout.html?' + params.toString();
    });
  });

});


/* ===== Helpers (modal backup nếu bạn cần sau này) ===== */
function escapeHtml(str){
  if(!str) return '';
  return String(str).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}