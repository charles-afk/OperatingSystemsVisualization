var animList = [];

var paused = false;

var fit = 0;

var p1 = 0;
var p2 = 0;
var p3 = 0;

var m1 = 0;
var m2 = 0;
var m3 = 0;

var m1c = 0;
var m2c = 0;
var m3c = 0;

var animSpeed = 1000;
var animLock = false;
var startLock = false;

var memtblpos;

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

function displayProcsnMems() {
    $('#p1span').text('P1: ' + p1);
    $('#p2span').text('P2: ' + p2);
    $('#p3span').text('P3: ' + p3);

    $('#m1span').text('M1: ' + m1);
    $('#m2span').text('M2: ' + m2);
    $('#m3span').text('M3: ' + m3);
}

$(document).ready(function () {
    memtblpos = $('#memtbl').position();
    $('#rndData').click(function () {
        p1 = Math.floor(Math.random() * 1000);
        p2 = Math.floor(Math.random() * 1000);
        p3 = Math.floor(Math.random() * 1000);

        m1 = Math.floor(Math.random() * 1000);
        m2 = Math.floor(Math.random() * 1000);
        m3 = Math.floor(Math.random() * 1000);

        displayProcsnMems();
    });
    $('#start').click(function () {
        if (animLock) return;
        startLock = true;
        for (i = animList.length - 1; i >= 0; i--) {
            Undo(animList[i]);
        }
        currStep = 0;
        animLock = false;
        occupied = [false, false, false];
        setTimeout(function () {
            startLock = false;
        }, 1000);
    });
    $('#next').click(function () {
        if (animLock) return;
        paused = false;
        animate(0);
        paused = true;
    });
    $('#back').click(function () {
        if (animLock) return;
        if (animList.length < 1) return;
        Undo(animList[animList.length - 1], 1);
    });
    $('#play').click(function () {
        if (animLock || startLock) return;
        animSpeed = 1000;
        paused = false;
        //while(currStep < 3 && paused == false) {
        animate(0);
        //}
    });
    $('#pause').click(function () {
        //if (animLock) return;
        console.log('pausing: ' + paused);
        paused = true;
        console.log(paused);
    });
    $('#end').click(function () {
        if (animLock || startLock) return;
        paused = false;
        animSpeed = 100;
        //while(currStep < 3 && paused == false) {
        animate(0);
    });

    $('#firstfit').click(function () {
        if (animLock) return;
        fit = 1;
    });
    $('#bestfit').click(function () {
        if (animLock) return;
        fit = 2;
    });
    $('#worstfit').click(function () {
        if (animLock) return;
        fit = 3;
    });
    $('#uploadbtn').click(function () {
        uploadedmems = [];
        fileobj = $('#inputGroupFile01').prop('files')[0];
        fr = new FileReader();
        fr.readAsText(fileobj);
        var count = 0;
        fr.onload = function () {
            lines = fr.result.split('\r\n');
            lines.forEach(function (line) {
                console.log(line + ' ' + line.length);
                if (line.length <= 1) return;
                nums = line.split(' ');
                if (count < 3) {
                    uploadedmems.push(parseInt(nums[1]) - parseInt(nums[0]));
                    startend.push([nums[0], nums[1]]);
                }

                if (count >= 3)
                    uploadedmems.push(parseInt(nums[1]));
                count++;
            }, this);
            m1 = uploadedmems[0];
            m2 = uploadedmems[1];
            m3 = uploadedmems[2];

            p1 = uploadedmems[3];
            p2 = uploadedmems[4];
            p3 = uploadedmems[5];
            displayProcsnMems();

            console.log(lines);
        };
    });
    $('#dwnld').click(function () {
        var text = [];
        var c = 0;
        animList.forEach(function (anim) {
            if (anim.mem == 'm1') {
                text += startend[0][0] + ' ' + startend[0][1] + ' ' + anim.proc.attr('id')[1] + '\n';
            }
            if (anim.mem == 'm2') {
                text += startend[1][0] + ' ' + startend[1][1] + ' ' + anim.proc.attr('id')[1] + '\n';
            }
            if (anim.mem == 'm3') {
                text += startend[2][0] + ' ' + startend[2][1] + ' ' + anim.proc.attr('id')[1] + '\n';
            }
            c++;
        }, this);
        var data = new Blob([text], { type: 'text/plain' });
        textFile = window.URL.createObjectURL(data);
        var a = document.createElement("a");
        document.body.appendChild(a);
        a.style = "display: none";
        a.href = textFile;
        a.download = 'output.txt';
        a.click();
        console.log(text);
    });
});

uploadedmems = [];
startend = [];


function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

var currStep = 0;
var occupied = [false, false, false];

function memCheck(proc, mem, loc) {
    console.log(proc + ' ' + mem);
    if (occupied[loc] != true) {
        if (mem >= proc) {
            return mem;
        } else return 99999;
    } else return 99999;

}
function memCheckW(proc, mem, loc) {
    console.log(proc + ' ' + mem);
    if (occupied[loc] != true) {
        if (mem >= proc) {
            return mem;
        } else return 0;
    } else return 0;
}

function getBestFit(proc) {
    console.log("checking: " + proc + "mem: " + m1);
    var bestmem = 0;
    if (m1 >= proc && m1 <= memCheck(proc, m2, 1) && m1 <= memCheck(proc, m3, 2) && occupied[0] != true) bestmem = 1;
    if (m2 >= proc && m2 <= memCheck(proc, m1, 0) && m2 <= memCheck(proc, m3, 2) && occupied[1] != true) bestmem = 2;
    if (m3 >= proc && m3 <= memCheck(proc, m1, 0) && m3 <= memCheck(proc, m2, 1) && occupied[2] != true) bestmem = 3;

    return bestmem;
}

function getWorstFit(proc) {
    var worstmem = 0;
    if (m1 >= proc && m1 >= memCheckW(proc, m2, 1) && m1 >= memCheckW(proc, m3, 2) && occupied[0] != true) worstmem = 1;
    if (m2 >= proc && m2 >= memCheckW(proc, m1, 0) && m2 >= memCheckW(proc, m3, 2) && occupied[1] != true) worstmem = 2;
    if (m3 >= proc && m3 >= memCheckW(proc, m1, 0) && m3 >= memCheckW(proc, m2, 1) && occupied[2] != true) worstmem = 3;

    return worstmem;
}

function animate(type) {
    console.log("Step: " + currStep);
    if (paused) return;
    if (currStep > 2) return;
    if (type == 0) {
        var procs = [p1, p2, p3];
        var procsname = ['p1', 'p2', 'p3'];
        //for (i = currStep; i < 3 && paused == false; i++) {
        run = 1;
        if (fit == 1) {
            if (m1 >= procs[currStep] && occupied[0] != true) {
                moveProcToMem(procsname[currStep], 'm1', m1 - procs[currStep]);
                occupied[0] = true;
            } else if (m2 >= procs[currStep] && occupied[1] != true) {
                moveProcToMem(procsname[currStep], 'm2', m2 - procs[currStep]);
                occupied[1] = true;
            } else if (m3 >= procs[currStep] && occupied[2] != true) {
                moveProcToMem(procsname[currStep], 'm3', m3 - procs[currStep]);
                occupied[2] = true;
            } else {
                animList.push({ proc: $('#' + procsname[currStep]), mem: 'dot', top: $('#' + procsname[currStep]).position().top });
                displayDot(procsname[currStep]);
                run = 0;
            }
        }
        if (fit == 2) {
            bestmem = 0;
            diff = 0;

            bestmem = getBestFit(procs[currStep]);

            console.log('bestmem: ' + bestmem);
            if (bestmem == 1) {
                moveProcToMem(procsname[currStep], 'm1', m1 - procs[currStep]);
                occupied[bestmem - 1] = true;
            } else if (bestmem == 2) {
                moveProcToMem(procsname[currStep], 'm2', m2 - procs[currStep]);
                occupied[bestmem - 1] = true;
            } else if (bestmem == 3) {
                moveProcToMem(procsname[currStep], 'm3', m3 - procs[currStep]);
                occupied[bestmem - 1] = true;
            } else {
                animList.push({ proc: $('#' + procsname[currStep]), mem: 'dot', top: $('#' + procsname[currStep]).position().top });
                displayDot(procsname[currStep]);
                run = 0;
            }

        }
        if (fit == 3) {
            worstmem = 0;
            diff = 0;

            worstmem = getWorstFit(procs[currStep]);

            console.log(worstmem);
            if (worstmem == 1) {
                moveProcToMem(procsname[currStep], 'm1', m1 - procs[currStep]);
                occupied[worstmem - 1] = true;
            } else if (worstmem == 2) {
                moveProcToMem(procsname[currStep], 'm2', m2 - procs[currStep]);
                occupied[worstmem - 1] = true;
            } else if (worstmem == 3) {
                moveProcToMem(procsname[currStep], 'm3', m3 - procs[currStep]);
                occupied[worstmem - 1] = true;
            } else {
                animList.push({ proc: $('#' + procsname[currStep]), mem: 'dot', top: $('#' + procsname[currStep]).position().top });
                displayDot(procsname[currStep]);
                run = 0;
            }
        }
        //sleep(1000);

        currStep++;
        if (run < 1) {
            animate(0);
        }
        //}
    }
}

function moveProcToMem(proc, mem, rem, chck) {
    animLock = true;
    $('#' + proc).css({ backgroundColor: getRandomColor() });
    var clonedProc = $('#' + proc).clone();
    $('#animarea').append(clonedProc);
    var procs = 0;
    animList.forEach(function (val, index, arr) {
        if (val.mem == mem) procs++;
    }, this);
    animList.push({ org: $('#' + proc), proc: clonedProc, mem: mem, top: clonedProc.position().top });
    clonedProc.animate({ left: memtblpos.left + $('#' + mem).position().left + 80, top: memtblpos.top + $('#' + mem).position().top + (procs * 50) }, animSpeed, function () {
        animLock = false;
        $('#' + mem + 'slot').text('' + rem);
        if (currStep > 2) return;
        animate(0);
    });
    if (rem > 0) {
        //$('#' + mem).animate({ height: $('#' + mem).height() + 50 });
    }
}

function displayDot(proc) {
    console.log("displayig dot: " + proc);
    $('#' + proc + 'hide').show();
}

function hideDot(proc) {
    console.log("hiding dot: " + proc);
    $('#' + proc + 'hide').hide();
}

function Undo(anim, rem) {
    animLock = true;
    if (currStep > 0)
        currStep--;
    console.log('proc mem: ' + anim.mem);
    switch (anim.mem) {
        case 'm1': occupied[0] = false; break;
        case 'm2': occupied[1] = false; break;
        case 'm3': occupied[2] = false; break;
    }
    console.log("undoing: " + anim.top + " " + anim.proc);
    var procs = 0;
    animList.forEach(function (val, index, arr) {
        if (val.mem == anim.mem) procs++;
    }, this);
    if (anim.mem == 'dot')
        hideDot(anim.proc.attr('id'));
    anim.proc.animate({ left: 35, top: anim.top }, animSpeed, function () {
        animLock = false;
        animList.pop();
        anim.proc.css({ backgroundColor: "#E0DDD8" });
        if (anim.mem != 'dot') {
            anim.proc.remove();
            anim.org.css({ backgroundColor: '#E0DDD8' });
        }
        procs = 0;
        animList.forEach(function (val, index, arr) {
            if (val.mem == anim.mem) procs++;
        }, this);
        if (procs >= 1) {
            $('#' + anim.mem + 'slot').text('' + rem);
        } else if (procs < 1) {
            $('#' + anim.mem + 'slot').text(' ');
        }
    });
    if (procs >= 1) {
        //$('#' + anim.mem).animate({ height: $('#' + anim.mem).height() - 50 });
    }
}