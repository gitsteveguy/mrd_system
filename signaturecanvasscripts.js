(function() {
    var canvas = document.getElementById('sign');
    var ctx = canvas.getContext('2d');
    var body = document.getElementById('body');
    var canvasdiv = document.getElementById('signdiv');
    var canvasdiv_style = getComputedStyle(canvasdiv);
    var clearbtnsign = document.getElementById('clearsignbtn');
    var csign = document.getElementById('signconfirm');
    var signuri = document.getElementById('signimageuri');
    canvas.width = parseInt(canvasdiv_style.getPropertyValue('width'));
    canvas.height = parseInt(canvasdiv_style.getPropertyValue('height'));
    ctx.fillStyle = "white";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    var touch = false;
    var last_pos = { x: 0, y: 0 };
    var curr_pos = { x: 0, y: 0 };
	/* Drawing on Paint App */
	ctx.lineWidth = 5;
	ctx.lineJoin = 'round';
	ctx.lineCap = 'round';
	ctx.strokeStyle = 'blue';

    /* Touch and Mouse Capturing Work */
    canvas.addEventListener('mousedown', function(e) {
        touch = false;
        last_pos.x = e.pageX - this.offsetLeft;
        last_pos.y = e.pageY - this.offsetTop;
        canvas.addEventListener('mousemove', onPaint, false);
    }, false);

    canvas.addEventListener('touchstart', function(e) {
		e.preventDefault();
        touch = true;
        last_pos.x = e.touches[0].pageX - this.offsetLeft;
        last_pos.y = e.touches[0].pageY - this.offsetTop;
        canvas.addEventListener('touchmove', onPaint, false);
    }, false);

    body.addEventListener('mouseup', function() {
        if (!touch) {
            canvas.removeEventListener('mousemove', onPaint, false);
        }
    }, false);

    body.addEventListener('touchend', function() {
        if (touch) {
            canvas.removeEventListener('touchmove', onPaint, false);
        }
    }, false);

    var onPaint = function(e) {
        if (touch) {
            curr_pos.x = e.touches[0].pageX - this.offsetLeft;
            curr_pos.y = e.touches[0].pageY - this.offsetTop;
        } else {
            curr_pos.x = e.pageX - this.offsetLeft;
            curr_pos.y = e.pageY - this.offsetTop;
        }

        ctx.beginPath();
        ctx.moveTo(last_pos.x, last_pos.y);
        ctx.lineTo(curr_pos.x, curr_pos.y);
        ctx.closePath();
        ctx.stroke();

        last_pos.x = curr_pos.x;
        last_pos.y = curr_pos.y;
    };

    clearbtnsign.addEventListener('click', function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillRect(0, 0, canvas.width, canvas.height);
    });

    csign.addEventListener('click', function() {
        var du = canvas.toDataURL('image/jpeg', 0.8);
        var b64du = du.replace(/^data:image\/?[A-z]*;base64,/, "");
        signuri.value = b64du;
    });
}());
