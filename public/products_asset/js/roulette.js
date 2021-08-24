var colors = [
  "#ACDDDE", "#e7feff", "#e1d590", "#fdee73",
  "#aaffaa", "#aefd6c", "#F0F8FF", "#F0E68C"
];

var restaraunts = [
  "1 POINT", "5 POINTS", "2 POINTS", "3 POINTS",
  "1 POINT", "4 POINTS", "2 POINTS", "3 POINTS"
  ];

var startAngle = 0;
var arc = Math.PI / 4;
var spinTimeout = null;

var spinArcStart = 1;
var spinTime = 0;
var spinTimeTotal = 0;

var ctx;
   
function drawRouletteWheel() {
  var canvas = document.getElementById("canvas");
  if (canvas.getContext) {
    var outsideRadius = 170;
    var textRadius = 100;
    var insideRadius = 25;
   
    ctx = canvas.getContext("2d");
    ctx.clearRect(0,0,500,500);

    ctx.strokeStyle = "#F7AB07";
    ctx.lineWidth = 4;
    ctx.fill();
    ctx.font = 'bold 18px Poppins, sans-serif';
   
    for(var i = 0; i < 8; i++) {
      var angle = startAngle + i * arc;
      ctx.fillStyle = colors[i];

      ctx.beginPath();
      ctx.arc(250, 250, outsideRadius, angle, angle + arc, false);
      ctx.arc(250, 250, insideRadius, angle + arc, angle, true);
      ctx.fill();
  
      ctx.save();
      ctx.shadowBlur = 0;
      ctx.fillStyle = "#000000";
      ctx.translate(250 + Math.cos(angle + arc / 2) * textRadius,
                    255 + Math.sin(angle + arc / 1.5) * textRadius);
      ctx.rotate(angle + arc / 4 + Math.PI / 18);
      var text = restaraunts[i];
      ctx.fillText(text.toUpperCase(), -ctx.measureText(text).width / 2, 0);
      ctx.restore();
      ctx.stroke();
      
    }
   
    //Arrow
    ctx.fillStyle = "#0E67B9";
    ctx.beginPath();
    ctx.moveTo(250 - 4, 250 - (outsideRadius + 5));
    ctx.lineTo(250 + 4, 250 - (outsideRadius + 5));
    ctx.lineTo(250 + 9, 250 - (outsideRadius - 5));
    ctx.lineTo(250 + 0, 250 - (outsideRadius - 23));
    ctx.lineTo(250 - 9, 250 - (outsideRadius - 5));
    ctx.lineTo(250 - 4, 250 - (outsideRadius + 5));
    ctx.fill();
  }
}
 
var x = document.getElementById("myAudio"); 

$('.spin').click(()=> {
  spinAngleStart = Math.random() * 120 + 10;
  spinTime = 0;
  spinTimeTotal = Math.random() * 3 + 5 * 3500;
  x.play();
  x.volume=0.5;
  var timeUpdate = $('#spin-countdown').text();
  // var now = new Date(timeeUpdate);
  $('.btn-close').attr('disabled','true');
  $('#spin').attr('disabled', 'true');
  $('#spin').css({
    'color':'#808080',
    'cursor':'not-allowed'
  });
  rotateWheel();
  //COUNTDOWN TIMER
  var timeUpdate = $('#spin-countdown').text();
  function Timer(duration, display) {
    var myInterval = setInterval(()=> {
    var subtract = duration.subtract(1, 'seconds');
        var formatted = moment(subtract).format('HH:mm:ss');
        if(formatted === '00:00:00'){
          clearInterval(myInterval);
          $('#spin-countdown').hide();
          $('.spin-countdown').hide();
          $('#spin').removeAttr('disabled');
          $('#spin').css({
            'color':'#0E67B9',
            'cursor':'pointer'
          });
        }
        display.text(formatted);
    }, 1000);
  }
  //COUNTDOWN INFO

  var oneDay = moment(timeUpdate);
  var display = $('#spin-countdown');
  Timer(oneDay, display);
});


function rotateWheel() {
  spinTime += 40;
  if(spinTime >= spinTimeTotal) {
    stopRotateWheel();
    insertRewards();
    return;
  }
  var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
  startAngle += (spinAngle * Math.PI / 180);
  drawRouletteWheel();
  spinTimeout = setTimeout('rotateWheel()', 20);
}

function stopRotateWheel() {
  clearTimeout(spinTimeout);
  var degrees = startAngle * 180 / Math.PI + 90;
  var arcd = arc * 180 / Math.PI;
  var index = Math.floor((360 - degrees % 360) / arcd);
  ctx.save();
  var text = restaraunts[index] 
  ctx.restore();
  $('#roulette-points').text('CONGRATS! YOU GOT ' + text);
  $('#daily-roulette-spin').val('Daily Roulette Spin');
  var textString = text;
  var substrText = textString.substr(0,1);
  $('#roulette-reward-points').val(substrText + ' POINTS');
  $('.modal-backdrop').addClass('roulette-background');
  $('#staticModalRoulette').css('z-index','1');
  $('#fireworks').css('display', 'block');
  $('.btn-close').removeAttr('disabled');
    setTimeout(()=>{
      $('#fireworks').css('display','none');
      $('#staticModalRoulette').css('z-index','9999');
      $('.modal-backdrop').removeClass('roulette-background');
    }, 5000); // 5000ms = 5s 
}

function easeOut(t, b, c, d) {
  var ts = (t/=d)*t;
  var tc = ts*t;
  return b+c*(tc + -3*ts + 3*t);
}

drawRouletteWheel();

window.onload = () => {
  var timer = moment(0, 'seconds').format('YYYY-MM-DD HH:mm:ss');
  var timeUpdate = $('#spin-countdown').text();
  if(timer != timeUpdate) {
    function Timer(duration, display) {
        var myInterval = setInterval(()=> {
          var subtract = duration.subtract(1, 'seconds');
              var formatted = moment(subtract).format('HH:mm:ss');
              if(formatted === '00:00:00'){
                clearInterval(myInterval);
                $('#spin-countdown').hide();
                $('.spin-countdown').hide();
                $('#spin').removeAttr('disabled');
                $('#spin').css({
                  'color':'#0E67B9',
                  'cursor':'pointer'
                });
              }
              display.text(formatted);
          }, 1000);
        }
        //COUNTDOWN INFO
        var oneDay = moment(timeUpdate);
        var display = $('#spin-countdown');
        Timer(oneDay, display);
      } else {
        $('.spin-countdown').hide();
      }
  }