document.addEventListener("DOMContentLoaded",function(){const i=document.querySelectorAll(".rating-stars, .rating");i.forEach(t=>{const s=t.querySelectorAll('input[type="radio"]'),e=t.querySelectorAll("label");e.forEach((o,n)=>{o.addEventListener("mouseenter",function(){for(let r=0;r<=n;r++)e[r]&&(e[r].style.color="#6f00ff")}),o.addEventListener("mouseleave",function(){a(t)})}),s.forEach(o=>{o.addEventListener("change",function(){const n=parseInt(this.value);l(t,n),d(t,n)})})});function a(t){const s=t.querySelectorAll("label"),e=t.querySelector('input[type="radio"]:checked');if(s.forEach(o=>{o.style.color="#ccc"}),e){const o=parseInt(e.value);for(let n=0;n<o;n++)s[n]&&(s[n].style.color="#6f00ff")}}function l(t,s){const e=t.parentElement.querySelector(".rating-text");e&&(e.textContent=`${s} star${s!==1?"s":""} selected`)}function d(t,s){const e=document.createElement("div");e.className="rating-feedback",e.style.cssText=`
            position: absolute;
            background: #6f00ff;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s;
        `;const o={1:"Poor 😞",2:"Fair 😐",3:"Good 🙂",4:"Very Good 😄",5:"Excellent 🤩"};e.textContent=o[s]||`${s} stars`,t.style.position="relative",t.appendChild(e),setTimeout(()=>e.style.opacity="1",10),setTimeout(()=>{e.style.opacity="0",setTimeout(()=>{e.parentNode&&e.parentNode.removeChild(e)},300)},2e3)}document.querySelectorAll('form[action*="reviews"]').forEach(t=>{t.addEventListener("submit",function(s){const e=this.querySelector('input[name="rating"]:checked');if(this.querySelector('textarea[name="comment"]'),!e){s.preventDefault(),u("Please select a rating before submitting.","warning");return}const o=this.querySelector('button[type="submit"]');o&&(o.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Submitting...',o.disabled=!0)})}),document.querySelectorAll(".progress-bar").forEach(t=>{const s=t.style.width;t.style.width="0%";const e=new IntersectionObserver(o=>{o.forEach(n=>{n.isIntersecting&&(setTimeout(()=>{t.style.width=s},200),e.unobserve(n.target))})});e.observe(t)});function u(t,s="info"){const e=document.createElement("div");e.className=`alert alert-${s} alert-dismissible fade show position-fixed`,e.style.cssText=`
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        `,e.innerHTML=`
            ${t}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `,document.body.appendChild(e),setTimeout(()=>{e.parentNode&&e.remove()},5e3)}i.forEach(t=>{a(t)});const c=document.createElement("style");c.textContent=`
        .rating {
            transition: all 0.3s ease;
        }

        .rating label {
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .rating label:hover {
            transform: scale(1.1);
        }

        .progress {
            transition: height 0.3s ease;
        }

        .progress-bar {
            transition: width 1s ease-in-out;
        }

        .rating-feedback {
            box-shadow: 0 4px 8px rgba(111, 0, 255, 0.3);
        }
    `,document.head.appendChild(c)});
