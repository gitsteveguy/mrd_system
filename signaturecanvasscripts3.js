(function() {
	var canvas = document.getElementById('sign3');
	var ctx = canvas.getContext('2d');
	var body = document.getElementById('body');
	var canvasdiv = document.getElementById('signdiv3');
	var canvasdiv_style = getComputedStyle(canvasdiv);
    var clearbtnsign = document.getElementById('clearsignbtn3');
    var csign = document.getElementById('signconfirm3');
    var signuri = document.getElementById('signimageuri3');
	canvas.width = parseInt(canvasdiv_style.getPropertyValue('width'));
	canvas.height = parseInt(canvasdiv_style.getPropertyValue('height'));
    ctx.fillStyle = "white";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
	var mouse = {x: 0, y: 0};
	var last_mouse = {x: 0, y: 0};
	
	/* Mouse Capturing Work */
	canvas.addEventListener('mousemove', function(e) {
		last_mouse.x = mouse.x;
		last_mouse.y = mouse.y;
		
		mouse.x = e.pageX - this.offsetLeft;
		mouse.y = e.pageY - this.offsetTop;
	}, false);
	
	
	/* Drawing on Paint App */
	ctx.lineWidth = 5;
	ctx.lineJoin = 'round';
	ctx.lineCap = 'round';
	ctx.strokeStyle = 'blue';
	
	canvas.addEventListener('mousedown', function(e) {
		canvas.addEventListener('mousemove', onPaint, false);
	}, false);
	
	body.addEventListener('mouseup', function() {
		canvas.removeEventListener('mousemove', onPaint, false);
	}, false);
	
	var onPaint = function() {
		ctx.beginPath();
		ctx.moveTo(last_mouse.x, last_mouse.y);
		ctx.lineTo(mouse.x, mouse.y);
		ctx.closePath();
		ctx.stroke();
	};
    clearbtnsign.addEventListener('click', function() {
        ctx.clearRect(0, 0,canvas.width,canvas.height);
        ctx.fillRect(0, 0, canvas.width, canvas.height);
    });
    csign.addEventListener('click', function() {
        var du = canvas.toDataURL('image/jpeg', 0.8);
        var b64du = du.replace(/^data:image\/?[A-z]*;base64,/,"");
        signuri.value = b64du;
    });
}());
