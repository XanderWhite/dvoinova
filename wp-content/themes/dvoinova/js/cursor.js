var с = document.getElementById("canvas");
var ctx = с.getContext("2d");
ctx.canvas.width = window.innerWidth;
ctx.canvas.height = window.innerHeight;

window.onresize = function () {
	ctx.canvas.width = window.innerWidth;
	ctx.canvas.height = window.innerHeight*2;
};

dots = [];
emitRate = 5;
minRad = 1;
maxRad = 3;
color = "";
opc = 0.5;
sha = 0;
lifeTime = 20;
tn = 0;
roc = 1;
speed = 1;

var controls = new (function () {
	this.emitRate = emitRate;
	this.spread = speed;
	this.radiusMin = minRad;
	this.radiusMax = maxRad;
	this.color = "#ffffff";
	this.opacity = opc;
	this.glow = sha;
	this.onChange_redraw = false;
	this.randomColor = true;
	this.lifeTime = lifeTime;
	this.circleShape = true;

	this.redraw = function () {
		emitRate = controls.emitRate;
		speed = controls.spread;
		minRad = controls.radiusMin;
		maxRad = controls.radiusMax;
		lifeTime = controls.lifeTime;
		color = controls.color;
		opc = controls.opacity;
		sha = controls.glow;
		if (controls.onChange_redraw) {
			dots.splice(0, dots.length);
		}
		if (controls.circleShape) {
			roc = 1;
		} else {
			roc = 0;
		}
		if (controls.randomColor) {
			color = "";
		}
	};
})();

// var gui = new dat.GUI({resizable : false});
// gui.add(controls, "emitRate", 2, 100).step(1).onChange(controls.redraw);
// gui.add(controls, "spread", 0.1, 5).onChange(controls.redraw);
// gui.add(controls, "lifeTime", 10, 300).onChange(controls.redraw);
// gui.add(controls, "radiusMin", 1, 10).step(1).onChange(controls.redraw);
// gui.add(controls, "radiusMax", 1, 30).step(1).onChange(controls.redraw);
// gui.add(controls, "opacity", 0.1, 1).onChange(controls.redraw);
// gui.add(controls, "glow", 0, 30).step(1).onChange(controls.redraw);
// gui.addColor(controls, "color").onChange(controls.redraw);
// gui.add(controls, "circleShape").onChange(controls.redraw);
// gui.add(controls, "randomColor").onChange(controls.redraw);
// gui.add(controls, "onChange_redraw").onChange(controls.redraw);

prevx = ctx.canvas.width / 2 - 250;
prevy = ctx.canvas.height / 8;
var prev2 = setInterval(preview, 16.67);
increase = (Math.PI * 2) / 40;
counter = 0;
function preview() {
	prevx += 8;
	prevy += (Math.sin(counter) / 2 + 0.5) * 8;
	emitDots(prevx, prevy);
	counter += increase;
}
preview();
setTimeout(function () {
	clearInterval(prev2);
}, 1000);

function emitDots(mx, my) {
	for (i = 0; i < emitRate; i++) {
		rxv = Math.random() * 2 - 1;
		ryv = Math.random() * 2 - 1;
		if (color == "") {
			//   col = "hsl("+Math.random() * 360+",65%,65%)";
			col = Math.random() > 0.3 ? "#e04eb3" : "#ffffff";
		} else {
			col = color;
		}
		rad = Math.random() * (maxRad - minRad) + minRad;
		dots.push({ x: mx, y: my, xv: rxv, yv: ryv, col: col, rad: rad });
	}
}

function animDots() {
	for (i = 0; i < dots.length; i++) {
		dots[i].x += dots[i].xv * speed;
		dots[i].y += dots[i].yv * speed;

		ctx.beginPath();
		ctx.fillStyle = dots[i].col;
		ctx.globalAlpha = opc;
		ctx.shadowColor = dots[i].col;
		ctx.shadowBlur = sha;
		if (roc == 0) {
			ctx.rect(dots[i].x, dots[i].y, dots[i].rad, dots[i].rad);
		} else {
			ctx.arc(dots[i].x, dots[i].y, dots[i].rad, 0, 2 * Math.PI);
		}
		ctx.fill();
		ctx.closePath();
	}
}

function cleanUp() {
	if (dots.length > 1) {
		dots.splice(0, Math.ceil(dots.length / lifeTime));
	}
}


function loop() {
	ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
	

    
    // Если скролл активен и есть касание
    if (isTouched && isScrolling) {
        const rect = canvas.getBoundingClientRect();
        const currentX = lastTouchX - rect.left;
        const currentY = lastTouchY - rect.top;
        emitDots(currentX, currentY);
       
    }

  animDots();
  cleanUp();
  
  
    requestAnimationFrame(loop);
}



let lastTouchX = 0, lastTouchY = 0;
let isTouched=false;
let lastRoundedX = null;
let lastRoundedY = null;
let isScrolling = false; // Идет ли скролл прямо сейчас
let scrollTimeout; // Таймер для определения конца скролла

	document.onmousemove = function (e) {
		mx = e.clientX;
		my = e.clientY;
		 lastTouchX = mx;
        lastTouchY = my;
		emitDots(mx, my);
	};
	
	document.ontouchstart= function(e) {
        isTouched = true;
        lastTouchX = e.touches[0].clientX;
        lastTouchY = e.touches[0].clientY;
        lastScrollY = window.scrollY;
    }; 
    
	document.ontouchend= function(e) {
        isTouched = false;
    }; 
    
    document.ontouchmove = function(e) {
        const touch = e.touches[0];
        mx = touch.clientX;
        my = touch.clientY;
        lastTouchX = mx;
        lastTouchY = my;
        if(!isScrolling)
        emitDots(mx, my);
    };
    
window.addEventListener('scroll', () => {

 if (!isScrolling) {
        isScrolling = true;
    }

    // Сбрасываем предыдущий таймер
    clearTimeout(scrollTimeout);

    // Если в течение 100 мс не было скролла — считаем, что он закончился
    scrollTimeout = setTimeout(() => {
        isScrolling = false;
          }, 100);
   
});


loop();