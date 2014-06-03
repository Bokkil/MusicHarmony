// Class Network
var srcAddress;

function Network() {
    this.URI = "ws://172.16.100.76:8080";
    //this.URI = "ws://61.43.139.31:8080";

    this.websocket = null;
    this.intervalId = null;

    this.disconnectionAsked = false;
}

Network.prototype.connect = function(URI) {
    this.disconnectionAsked = false;
    if (typeof URI !== "undefined") {
        this.URI = URI;
    }

    try {
        if (this.websocket) {
            if (this.connected()) {
                this.websocket.close();
            }
            delete this.websocket;
        }

        if (typeof MozWebSocket === 'function') {
            WebSocket = MozWebSocket;
        }

        this.websocket = new WebSocket(this.URI);

        this.websocket.onopen = function(evt) {
            updateSocketState(this.websocket);
            var p = getParams();
            var idToSend = p["project_id"];
            this.websocket.send(idToSend);
        }.bind(this);
        this.websocket.onclose = function(evt) {
            updateSocketState(this.websocket);
            if (!this.disconnectionAsked) {
                //setTimeout(this.connect.bind(this), 500);
            }
            delete this.websocket;
        }.bind(this);
        this.websocket.onmessage = function(evt) {
            console.log(getLogDate() + "Message received :", evt.data);
            srcAddress = 'http://172.16.100.76/uploads/music/'+evt.data;
            //srcAddress = 'http://61.43.139.31/uploads/music/'+evt.data;
            console.log(srcAddress);
            //displayMessage(evt.data);
            var oReq = new XMLHttpRequest();
            oReq.open("GET", srcAddress, true);
            oReq.responseType = "blob";
            oReq.onload = function(oEvent) {
              var blob = oReq.response;
              console.log(blob);
              Audiee.Player.preloadFile(blob, this.el);
            };
            oReq.send();
        }.bind(this);
        this.websocket.onerror = function(evt) {
            console.warn("Websocket error:", evt.data);
        };
        updateSocketState(this.websocket);
    } catch (exception) {
        alert("Websocket fatal error, maybe your browser can't use websockets. You can look at the javascript console for more details on the error.");
        console.error("Websocket fatal error", exception);
    }
}

Network.prototype.connected = function() {
    if (this.websocket && this.websocket.readyState == 1) {
        return true;
    }
    return false;
};

Network.prototype.reconnect = function() {
    if (this.connected()) {
        this.disconnect();
    }
    this.connect();
}

Network.prototype.disconnect = function() {
    this.disconnectionAsked = true;
    if (this.connected()) {
        this.websocket.close();
        updateSocketState(this.websocket);
    }
}

Network.prototype.send = function(message) {
    if (this.connected()) {
        this.websocket.send(message);
    }
};

Network.prototype.checkSocket = function() {
    if (this.websocket) {
        var stateStr;
        switch (this.websocket.readyState) {
            case 0:
                stateStr = "CONNECTING";
                break;
            case 1:
                stateStr = "OPEN";
                break;
            case 2:
                stateStr = "CLOSING";
                break;
            case 3:
                stateStr = "CLOSED";
                break;
            default:
                stateStr = "UNKNOW";
                break;
        }
        console.log("Websocket state : " + this.websocket.readyState + " (" + stateStr + ")");
    } else {
        console.log("Websocket is not initialised");
    }
}

/////////////////////////////////////////////////

// global functions
function displayMessage(message) {
    chatTextArea.value += message + "\n";
    chatTextArea.scrollTop = chatTextArea.scrollHeight;
}

function sendMessage() {
    var pseudo = document.getElementById("inputPseudo").value;
    pseudo = pseudo ? pseudo : document.getElementById("inputPseudo").getAttribute("placeholder");
    var message = document.getElementById("inputMessage").value;
    message = message ? message : "echo";
    var strToSend = pseudo + ": " + message;
    if (network && network.connected()) {
        document.getElementById("inputMessage").value = "";
        network.send(strToSend);
        console.log("Message sent :", '"' + strToSend + '"');
    }
}

function updateSocketState(websocket) {
    if (websocket != null) {
        var stateStr;
        switch (websocket.readyState) {
            case 0:
                stateStr = "CONNECTING";
                break;
            case 1:
                stateStr = "OPEN";
                break;
            case 2:
                stateStr = "CLOSING";
                break;
            case 3:
                stateStr = "CLOSED";
                break;
            default:
                stateStr = "UNKNOW";
                break;
        }
        document.querySelector("#socketState").innerText = websocket.readyState + " (" + stateStr + ")";
        console.log(getLogDate() + "socket state changed: " + websocket.readyState + " (" + stateStr + ")");
    } else {
        document.querySelector("#socketState").innerText = "3 (CLOSED)";
    }
}

function getLogDate() {
    return "[" + (new Date).toLocaleTimeString() + "] ";
}

function getSoundPath(id) {
    if (network && network.connected()) {
        network.send(id);
        console.log("Message sent :", '"' + id + '"');
    }
}

function getParams() {
    // 파라미터가 담길 배열
    var param = new Array();
 
    // 현재 페이지의 url
    var url = decodeURIComponent(location.href);
    // url이 encodeURIComponent 로 인코딩 되었을때는 다시 디코딩 해준다.
    url = decodeURIComponent(url);
 
    var params;
    // url에서 '?' 문자 이후의 파라미터 문자열까지 자르기
    params = url.substring( url.indexOf('?')+1, url.length );
    // 파라미터 구분자("&") 로 분리
    params = params.split("&");

    // params 배열을 다시 "=" 구분자로 분리하여 param 배열에 key = value 로 담는다.
    var size = params.length;
    var key, value;
    for(var i=0 ; i < size ; i++) {
        key = params[i].split("=")[0];
        value = params[i].split("=")[1];

        param[key] = value;
    }
    return param;
}

function sendId(id) {
  console.log(id);                
  this.send(id);
  console.log("Message sent :", '"' + id + '"'); 
}

function secureURI(secured) {
    var regExpRep = /^(wss?):\/\//i;
    var uri = document.querySelector("#wsURI").value;
    if (secured) {
        uri = uri.replace(regExpRep, "wss://");
    } else {
        uri = uri.replace(regExpRep, "ws://");
    }
    document.querySelector("#wsURI").value = uri;
}