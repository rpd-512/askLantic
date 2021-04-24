displayErr = (msg) => {
    err.innerText = msg;
    err.style.opacity = "100%";
    setTimeout(() => {
        err.style.opacity = "0%";
        err.innerText = msg;
        err.innerText = msg;
    }, 5000)
}
function validateMail(mail) {
    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail)) {
        return (true)
    }
    return (false)
}
sign = (tsk) => {
    if (tsk == "up") {
        us.style.borderColor = "white";
        ml.style.borderColor = "white";
        ps.style.borderColor = "white";
        cp.style.borderColor = "white";
        if (us.value.length < 3) { displayErr("Username can't be smaller than 3 characters"); us.style.borderColor = "rgba(255,102,102)"; return false; }
        else if (us.value.length > 20) { displayErr("Username can't be larger than 20 characters"); us.style.borderColor = "rgba(255,102,102)"; return false; }
        else if (!validateMail(ml.value)) { displayErr("Invalid email address"); ml.style.borderColor = "rgba(255,102,102)"; return false; }
        else if (ps.value.length < 8) { displayErr("Password too small. Please use atleast 8 characters."); ps.style.borderColor = "rgba(255,102,102)"; return false; }
        else if (ps.value !== cp.value) { displayErr("Password confirmation mismatch."); ps.style.borderColor = "rgba(255,102,102)"; cp.style.borderColor = "rgba(255,102,102)"; return false; }
        subm.disabled = true;
        subm.innerHTML = "<img src='images/load1.gif'>";
        postData = { 'u': us.value, 'm': ml.value, 'tsk': 'up' };
        var isOk = true;
        jQuery.ajax({
            type: "POST",
            url: 'auth.php',
            data: postData,
            success: function (resp) {
                subm.disabled = false;
                subm.innerHTML = "Sign Up";
                if (resp == 'u') {
                    displayErr("Username already in use"); us.style.borderColor = "rgba(255,102,102)"; isOk = false;
                }
                else if (resp == 'm') {
                    displayErr("Email address already in use"); ml.style.borderColor = "rgba(255,102,102)"; isOk = false;
                }
            },
            async: false
        });
        return isOk;
    }
    else if (tsk == "in") {
        us.style.borderColor = "white";
        ps.style.borderColor = "white";
        if (us.value.length < 3 || us.value.length > 20) { displayErr("Invalid username"); us.style.borderColor = "rgba(255,102,102)"; return false; }
        else if (ps.value.length < 8) { displayErr("Invalid password"); ps.style.borderColor = "rgba(255,102,102)"; return false; }
        subm.disabled = true;
        subm.innerHTML = "<img src='images/load1.gif'>";
        postData = { 'u': us.value, 'p': ps.value, 'tsk': 'in' };
        var isOk = true;
        jQuery.ajax({
            type: "POST",
            url: 'auth.php',
            data: postData,
            success: function (resp) {
                subm.disabled = false;
                subm.innerHTML = "Login";
                if (resp == 'u') {
                    displayErr("Username not found"); us.style.borderColor = "rgba(255,102,102)"; isOk = false;
                }
                else if (resp == 'p') {
                    displayErr("Incorrect password"); ps.style.borderColor = "rgba(255,102,102)"; isOk = false;
                }
            },
            async: false
        });
        return isOk
    }
}
lgout = () => {
    if (confirm("Are you sure you wanna logout?")) {
        document.cookie = "userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
        location.replace("index.php");
    }
}
chngPswd = () => {
    np.style.borderColor = "white";
    cp.style.borderColor = "white";
    if (sign('in')) {
        if (np.value.length < 8) {
            displayErr("New password too small. Please use atleast 8 characters."); np.style.borderColor = "rgba(255,102,102)"; isOk = false;
            return false;
        }
        else if (cp.value != np.value) {
            displayErr("Password confirmation mismatch"); cp.style.borderColor = "rgba(255,102,102)"; np.style.borderColor = "rgba(255,102,102)"; isOk = false;
            return false;
        }
    }
    else { return false; }
}
rtuImg = () => {
    if (slctImg.files.length == 1) { profPic.src = window.URL.createObjectURL(slctImg.files[0]); $('#rmvImg').prop('disabled', false); isDef.value = "0"; imgErr = 0; }
    else if (profPic.src != window.location.protocol + "//" + document.location.hostname + document.location.pathname.replace("profile.php", "") + "images/default.png") { $('#rmvImg').prop('disabled', false); isDef.value = "0"; imgErr = 0; }
    else { profPic.src = "images/default.png"; $('#rmvImg').prop('disabled', true); isDef.value = "1"; imgErr = 0; }
    e.value = imgErr;
}
htmlEntities = (str) => {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
rplcLnk = (content) =>
   {
   var exp_match = /(\b(https?|):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
   var element_content=content.replace(exp_match, "<a target='_blank' href='$1'>$1</a>");
   var new_exp_match =/(^|[^\/])(www\.[\S]+(\b|$))/gim;
   var new_content=element_content.replace(new_exp_match, '$1<a target="_blank" href="http://$2">$2</a>');
   return new_content;
   }

insrtInBdy = (newText,el=bdy) => {
    const [start, end] = [el.selectionStart, el.selectionEnd];
    el.setRangeText(newText, start, end, 'select');
}

fltrDesc = (dsc,filt=false) => {
    dsc = htmlEntities(dsc);
    dsc = dsc
    .replaceAll("\n","<br>")
    .replaceAll("[C]","<p class='code'>")
    .replaceAll("[B]","<p class='bold'>")
    .replaceAll("[I]","<p class='ilcs'>")
    .replaceAll("[U]","<p class='undr'>")
    .replaceAll("[!]","</p>");
    if(filt){
        dsc = dsc.replaceAll("[&gt;]","<p class='quot'>")
    }
    else{
        dsc = dsc.replaceAll("[&amp;gt;]","<p class='quot'>")
    }

    return rplcLnk(dsc);
}
isValidTag = (strng) => {
    result = strng.match(/\w/g);
    return result.length == strng.replaceAll(" ","").length;
}

submQues = () => {
    var errElem = document.getElementsByClassName("alrt");
    var hedElem = document.getElementsByClassName("wrdCnt");
    var err = false;
    errElem[0].style.display = "none";
    errElem[1].style.display = "none";
    errElem[2].style.display = "none";
    
    if(ttl.value.replaceAll(" ","") == "" || ttl.value.length > 150){
        hedElem[0].scrollIntoView();
        errElem[0].style.display = "inline";
        err = true;
    }
    if(bdy.value.replaceAll(" ","") == "" || bdy.value.length > 5000){
        if(!err) hedElem[1].scrollIntoView();
        errElem[1].style.display = "inline";
        err = true;
    }
    if(totTags > 5 || totTags == 0){
        if(!err) hedElem[2].scrollIntoView();
        errElem[2].style.display = "inline";
        err = true;
    }
    if(tgs.value == "")
    {
        displayErr("Please enter the tags");
        if(!err) hedElem[2].scrollIntoView();
        errElem[2].style.display = "inline";
        err = true;
    }
    else if(! isValidTag(tgs.value))
    {
        displayErr("Special characters are not allowed in tags");
        if(!err) hedElem[2].scrollIntoView();
        errElem[2].style.display = "inline";
        err = true;
    }
    for(t of tgs.value.split(" ")){
        if(t.replaceAll(" ","").length == 0){continue;}
        if(htmlEntities(t).length > 50){
            displayErr("A tag can't be greater than 50 characters");
            if(!err) hedElem[2].scrollIntoView();
            errElem[2].style.display = "inline";
            err = true;
        };
    }
    return !err;
}
submRelp = (iden=bdy) => {
    if(iden.value.replaceAll(" ","").length == 0 || iden.value.length > 1500){
        err.style.color = "red";
        err.style.borderColor = "red";
        err.style.backgroundColor = "pink";
        displayErr("Reply can't be blank or have a length greater than 1500");
        return false;
    }
    return true;
}
cpyTxt = (str) => {
    const el = document.createElement('textarea');
    el.value = str;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    err.style.color = "green";
    err.style.borderColor = "green";
    err.style.backgroundColor = "rgba(120,255,120,0.5)";
    displayErr("URL link copied");
  };

pDlt = (id) => {
    jQuery.ajax({
        type: "POST",
        url: 'taskAPI.php',
        data: {"postId":id,"dltPost":''},
        success: function (resp) {
            if(resp == 'pd'){
                err.style.color = "red";
                err.style.borderColor = "red";
                err.style.backgroundColor = "pink";
                displayErr("Permission Denied");
            }
            else if(resp == 'dl'){
                err.style.color = "green";
                err.style.borderColor = "green";
                err.style.backgroundColor = "rgba(120,255,120,0.5)";
                displayErr("Your post is now deleted..")
                setTimeout(() => {
                    location.reload()
                },1000)
            }
        },
        async: false
    });

}
editRepl = (id,txt) => {
    jQuery.ajax({
        type: "POST",
        url: 'taskAPI.php',
        data: {"postId":id,"edtPost":''},
        success: function (resp) {
            if(resp == 'pd'){
                err.style.color = "red";
                err.style.borderColor = "red";
                err.style.backgroundColor = "pink";
                displayErr("Permission Denied");
            }
            else if(resp.includes('ed')){
                edtR.style.display = "block";
                replBdy.value = txt.replaceAll("[&gt;]","[>]");
                document.getElementsByName('replId')[0].value = resp;
                setTimeout(() => {
                    edtR.style.opacity = "0.95";
                }, 100);
            }
        },
        async: false
    });    
}
confThis = (id) => {
    jQuery.ajax({
        type: "POST",
        url: "taskAPI.php",
        data: {"postId":id,'verifRepl':''},
        success: function(resp){
            if(resp == "cnf1") document.getElementById(id).innerHTML = '<svg width="50" height="50" viewBox="0 0 458 361" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" fill="#327896"/><path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" stroke="black"/><rect x="381.269" y="14" width="95" height="378.214" transform="rotate(45.5 381.269 14)" fill="#327896"/><rect x="10" y="203.759" width="95" height="182.092" transform="rotate(-45.5 10 203.759)" fill="#327896"/></svg>';
            else document.getElementById(id).innerHTML = '<svg width="50" height="50" viewBox="0 0 458 361" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" fill="#327896"/><path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" stroke="black"/></svg>';
        },
        async: false
    });
}
rprtQues = (replId = "") => {
    if(replId.length != 0){
        document.getElementsByName('replId')[1].value=replId;
    }
    rprt.style.display = "block";
    setTimeout(() => {
        rprt.style.opacity = "0.95";
    }, 100);
}
canRprt = () => {
    for(i of document.getElementsByName("rprt")){if(i.checked){return true;}}
    err.style.color = "red";
    err.style.borderColor = "red";
    err.style.backgroundColor = "pink";
    displayErr("Please select atleast one category");
    return false;
}
getViewCnt = (id) => {
    setInterval(() => {
    jQuery.ajax({
        type: 'POST',
        url: 'taskAPI.php',
        data: {'postId':id,'getView':''},
        success: function(resp){
            if(resp != 'na'){
            vw.innerHTML = resp;}
        },
        async: false
    })},1000)

}
votePost = (v,qId,up,dw,vCnt) => {
    up.style.fill = "rgb(175,175,175)";
    dw.style.fill = "rgb(175,175,175)";
    jQuery.ajax({
        type: 'POST',
        url: 'taskAPI.php',
        data: {'postId':qId,'votePost':v},
        success: function(resp){
            if(resp == 'pd'){
                err.style.color = "red";
                err.style.borderColor = "red";
                err.style.backgroundColor = "pink";
                displayErr("Permission Denied");
                return;
            }
            else if(resp == 'vtSelf'){
                err.style.color = "red";
                err.style.borderColor = "red";
                err.style.backgroundColor = "pink";
                displayErr("You can't vote your own posts");
                return;
            }
            else if(resp == 'rpLess'){
                err.style.color = "red";
                err.style.borderColor = "red";
                err.style.backgroundColor = "pink";
                displayErr("You need atleast 10 reputation to vote.");
                return;
            }
            else{
                if(resp.split("|")[0] != ""){
                vCnt.innerHTML = resp.split("|")[0];}
                if(resp.split("|")[1] == 'u'){
                    up.style.fill = "rgb(50,120,150)";
                }
                else if(resp.split("|")[1] == 'd'){
                    dw.style.fill = "rgb(50,120,150)";
                }
            }

        },
        async: false
    })
}
timeSpent = () =>{
    setInterval(() => {
    jQuery.ajax({
        type: 'POST',
        url: 'taskAPI.php',
        data: {'timeSpent':''},
        async: false
    })},10000)
}

socialVisit = (sm) => {
    jQuery.ajax({
        type: 'POST',
        url: 'taskAPI.php',
        data: {'socialClick':(sm[0].toLowerCase())},
        async: false
    })
}
dltNotif = (nId) => {
    jQuery.ajax({
        type: 'POST',
        url: 'taskAPI.php',
        data: {'dltNotif':nId},
        success: function(resp){
            console.log(resp);
            if(resp != 'pd'){
                $('#notif'+nId)[0].remove()
            }
        },
        async: false
    })
}
