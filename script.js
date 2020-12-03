
let xValues = ["-4","-3","-2","-1","0","1","2","3","4"];
let rValues = ["1","1.5","2","2.5","3"];


function getX(){
    let a = $('input[name="xRadio"]:checked');
    if (a.length === 0) return null;
    let x = a[0].value;
    if (xValues.indexOf(x) === -1) return null;
    return x;
}

function getY(){
    let y = document.getElementById('yText').value;
    if (y[0] === "-") y = y.substring(0,8); else y = y.substring(0,7);
    if ( y==='') return null;
    else if(y > -5 && y < 5) return y;
    return null;
}

function getR(){
    let a = $('input[name="rBox"]:checked');
    let r = [];
    for (let i = 0; i < a.length; i++) r.push(a[i].value);
    if (r.length === 0 || r.length > 1) return null;
    if (rValues.indexOf(r[0]) === -1) return null;
    return r[0];
}

function sendRequest(){
    let x = getX();
    let y = getY();
    let r = getR();
 

    if (x === null || y === null || r === null) {
        let msg = '';
        if (x === null) msg += 'Неверно введено значение X!\n';
        if (y === null) msg += 'Неверно введено значение Y!\n';
        if (r === null) msg += 'Неверно введено значение R!\n';
        alert(msg.substring(0, msg.length-1));
        return;
    }

    $.get('server.php', {'x':x, 'y':y, 'r':r}, function(data) {document.getElementById('resultTable').innerHTML=data;});

    return;
}

function clearRows() {
    $.get('clear.php', {}, function(){});
}

function startFunc() {
    $.get('start.php', {}, function(data) {document.getElementById('resultTable').innerHTML=data;});
}