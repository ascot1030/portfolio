var ARK_game_arena_connector={_compatibilityMode:!1,_actionHandler:{},_showGameEnd:!0,_scoreChangleLog:[],_score:0,_playId:"",_gameSecret:"",_params:[],_arena_events_subscription:{},_arena_return_values_subscription:{},_TRUE_AS_STRING:String(!0).toLowerCase(),_messageSender:null,_postInitCallback:null,_md5:function(e){function n(e,n){return e<<n|e>>>32-n}function a(e,n){var a,r,o,_,t;return o=2147483648&e,_=2147483648&n,a=1073741824&e,r=1073741824&n,t=(1073741823&e)+(1073741823&n),a&r?2147483648^t^o^_:a|r?1073741824&t?3221225472^t^o^_:1073741824^t^o^_:t^o^_}function r(e,n,a){return e&n|~e&a}function o(e,n,a){return e&a|n&~a}function _(e,n,a){return e^n^a}function t(e,n,a){return n^(e|~a)}function c(e,o,_,t,c,s,g){return e=a(e,a(a(r(o,_,t),c),g)),a(n(e,s),o)}function s(e,r,_,t,c,s,g){return e=a(e,a(a(o(r,_,t),c),g)),a(n(e,s),r)}function g(e,r,o,t,c,s,g){return e=a(e,a(a(_(r,o,t),c),g)),a(n(e,s),r)}function m(e,r,o,_,c,s,g){return e=a(e,a(a(t(r,o,_),c),g)),a(n(e,s),r)}function i(e){for(var n,a=e.length,r=a+8,o=(r-r%64)/64,_=16*(o+1),t=Array(_-1),c=0,s=0;a>s;)n=(s-s%4)/4,c=s%4*8,t[n]=t[n]|e.charCodeAt(s)<<c,s++;return n=(s-s%4)/4,c=s%4*8,t[n]=t[n]|128<<c,t[_-2]=a<<3,t[_-1]=a>>>29,t}function l(e){var n,a,r="",o="";for(a=0;3>=a;a++)n=e>>>8*a&255,o="0"+n.toString(16),r+=o.substr(o.length-2,2);return r}function u(e){e=e.replace(/\r\n/g,"\n");for(var n="",a=0;a<e.length;a++){var r=e.charCodeAt(a);128>r?n+=String.fromCharCode(r):r>127&&2048>r?(n+=String.fromCharCode(r>>6|192),n+=String.fromCharCode(63&r|128)):(n+=String.fromCharCode(r>>12|224),n+=String.fromCharCode(r>>6&63|128),n+=String.fromCharCode(63&r|128))}return n}var d,f,p,R,A,h,K,v,C,S=Array(),y=7,I=12,w=17,b=22,k=5,E=9,M=14,U=20,G=4,L=11,P=16,V=23,T=6,N=10,F=15,H=21;for(e=u(e),S=i(e),h=1732584193,K=4023233417,v=2562383102,C=271733878,d=0;d<S.length;d+=16)f=h,p=K,R=v,A=C,h=c(h,K,v,C,S[d+0],y,3614090360),C=c(C,h,K,v,S[d+1],I,3905402710),v=c(v,C,h,K,S[d+2],w,606105819),K=c(K,v,C,h,S[d+3],b,3250441966),h=c(h,K,v,C,S[d+4],y,4118548399),C=c(C,h,K,v,S[d+5],I,1200080426),v=c(v,C,h,K,S[d+6],w,2821735955),K=c(K,v,C,h,S[d+7],b,4249261313),h=c(h,K,v,C,S[d+8],y,1770035416),C=c(C,h,K,v,S[d+9],I,2336552879),v=c(v,C,h,K,S[d+10],w,4294925233),K=c(K,v,C,h,S[d+11],b,2304563134),h=c(h,K,v,C,S[d+12],y,1804603682),C=c(C,h,K,v,S[d+13],I,4254626195),v=c(v,C,h,K,S[d+14],w,2792965006),K=c(K,v,C,h,S[d+15],b,1236535329),h=s(h,K,v,C,S[d+1],k,4129170786),C=s(C,h,K,v,S[d+6],E,3225465664),v=s(v,C,h,K,S[d+11],M,643717713),K=s(K,v,C,h,S[d+0],U,3921069994),h=s(h,K,v,C,S[d+5],k,3593408605),C=s(C,h,K,v,S[d+10],E,38016083),v=s(v,C,h,K,S[d+15],M,3634488961),K=s(K,v,C,h,S[d+4],U,3889429448),h=s(h,K,v,C,S[d+9],k,568446438),C=s(C,h,K,v,S[d+14],E,3275163606),v=s(v,C,h,K,S[d+3],M,4107603335),K=s(K,v,C,h,S[d+8],U,1163531501),h=s(h,K,v,C,S[d+13],k,2850285829),C=s(C,h,K,v,S[d+2],E,4243563512),v=s(v,C,h,K,S[d+7],M,1735328473),K=s(K,v,C,h,S[d+12],U,2368359562),h=g(h,K,v,C,S[d+5],G,4294588738),C=g(C,h,K,v,S[d+8],L,2272392833),v=g(v,C,h,K,S[d+11],P,1839030562),K=g(K,v,C,h,S[d+14],V,4259657740),h=g(h,K,v,C,S[d+1],G,2763975236),C=g(C,h,K,v,S[d+4],L,1272893353),v=g(v,C,h,K,S[d+7],P,4139469664),K=g(K,v,C,h,S[d+10],V,3200236656),h=g(h,K,v,C,S[d+13],G,681279174),C=g(C,h,K,v,S[d+0],L,3936430074),v=g(v,C,h,K,S[d+3],P,3572445317),K=g(K,v,C,h,S[d+6],V,76029189),h=g(h,K,v,C,S[d+9],G,3654602809),C=g(C,h,K,v,S[d+12],L,3873151461),v=g(v,C,h,K,S[d+15],P,530742520),K=g(K,v,C,h,S[d+2],V,3299628645),h=m(h,K,v,C,S[d+0],T,4096336452),C=m(C,h,K,v,S[d+7],N,1126891415),v=m(v,C,h,K,S[d+14],F,2878612391),K=m(K,v,C,h,S[d+5],H,4237533241),h=m(h,K,v,C,S[d+12],T,1700485571),C=m(C,h,K,v,S[d+3],N,2399980690),v=m(v,C,h,K,S[d+10],F,4293915773),K=m(K,v,C,h,S[d+1],H,2240044497),h=m(h,K,v,C,S[d+8],T,1873313359),C=m(C,h,K,v,S[d+15],N,4264355552),v=m(v,C,h,K,S[d+6],F,2734768916),K=m(K,v,C,h,S[d+13],H,1309151649),h=m(h,K,v,C,S[d+4],T,4149444226),C=m(C,h,K,v,S[d+11],N,3174756917),v=m(v,C,h,K,S[d+2],F,718787259),K=m(K,v,C,h,S[d+9],H,3951481745),h=a(h,f),K=a(K,p),v=a(v,R),C=a(C,A);var D=l(h)+l(K)+l(v)+l(C);return D.toLowerCase()},_urlEncode:function(){for(var e="",n=arguments,a=0;a<n.length;a++){var r=n[a].key,o=n[a].value;e+=r+"=";for(var _=0;_<o.length;_++)e+=o[_],_<o.length-1&&(e+=",");a<n.length-1&&(e+="&")}return e},_urlDecode:function(e){return decodeURIComponent((e+"").replace(/\+/g,"%20"))},_parseMessage:function(e){for(var n={empty:!0,events:[],actions:[],params:ARK_game_arena_connector._params,returnValues:[],show_game_end:ARK_game_arena_connector._showGameEnd,play_id:ARK_game_arena_connector._playId},a=e.split("&"),r=0;r<a.length;r++){var o=a[r].split("=");if(2===o.length){var _=o[0],t=decodeURIComponent(o[1]),c=t.split(",");if("events"===_||"actions"===_)n[_]=c,n.empty=!1;else if("get_values"===_)n.returnValues=c,n.empty=!1;else if("play_id"===_)n[_]=t,n.empty=!1;else if("show_game_end"===_)n[_]=t===ARK_game_arena_connector._TRUE_AS_STRING,n.empty=!1;else if(c.length>0){n.empty=!1;for(var s=!0,g=0;g<c.length;g++){for(var m=0;m<n.params.length;++m)if(n.params[m].name===_){n.params[m].value=decodeURIComponent(c[g]),s=!1;break}s&&n.params.push({name:_,value:decodeURIComponent(c[g])})}}}}return n},registerAction:function(e,n){ARK_game_arena_connector._actionHandler[e]=n},fireEventToArena:function(e){if(console.log("trying to send message",e),ARK_game_arena_connector._compatibilityMode&&"game_end"===e)try{ARK_game_arena_connector._messageSender("sc"+ARK_game_arena_connector._score)}catch(n){}else if(ARK_game_arena_connector._arena_events_subscription[e]===!0||"event_change"===e){var a="event="+e;if("game_end"===e){a+="&score="+encodeURIComponent(ARK_game_arena_connector._score)+"&score_hash="+ARK_game_arena_connector._md5(ARK_game_arena_connector._score.toString()+"_"+ARK_game_arena_connector._playId+"_"+ARK_game_arena_connector._gameSecret);for(var r in ARK_game_arena_connector._arena_return_values_subscription)"game_log"===r&&ARK_game_arena_connector._arena_return_values_subscription[r]===!0&&(a+="&game_log="+encodeURIComponent(JSON.stringify(ARK_game_arena_connector._scoreChangleLog)))}try{ARK_game_arena_connector._messageSender(a,"*")}catch(n){}}},showGameEnd:function(){return ARK_game_arena_connector._showGameEnd},changeScore:function(e,n){ARK_game_arena_connector._score=e,ARK_game_arena_connector._scoreChangleLog.push({score:e,time:(new Date).getTime(),comment:n})},setGameSecret:function(e){ARK_game_arena_connector._gameSecret=e},_handleMessageFromArena:function(e){ARK_game_arena_connector.doInit(e.data)},_iframe_messageSender:function(e){console.log("game message: "+e),parent.postMessage(e,"*")},_arkPage_messageSender:function(e){arkPage.postMessage(e)},getParam:function(e,n){for(var a=0;a<ARK_game_arena_connector._params.length;++a)if(ARK_game_arena_connector._params[a].name===e)return ARK_game_arena_connector._params[a].value;return n},init:function(e,n){if(ARK_game_arena_connector._postInitCallback="function"==typeof e?e:null,"arkPage"in window&&null!=arkPage.postMessage)ARK_game_arena_connector._messageSender=ARK_game_arena_connector._arkPage_messageSender,ARK_game_arena_connector._arkPage_messageSender("event=game_loaded&callback=ARK_game_arena_connector.doInit");else{ARK_game_arena_connector._messageSender=ARK_game_arena_connector._iframe_messageSender,window.addEventListener?window.addEventListener("message",ARK_game_arena_connector._handleMessageFromArena,!1):window.attachEvent("onmessage",ARK_game_arena_connector._handleMessageFromArena);var a;a=n?"".concat(window.location.search.substr(1),"&",n):window.location.search.substr(1),ARK_game_arena_connector.doInit(a)}},doInit:function(e){var n,a,r=ARK_game_arena_connector._parseMessage(e);if(!r.empty){for(ARK_game_arena_connector._showGameEnd=r.show_game_end,ARK_game_arena_connector._playId=r.play_id,ARK_game_arena_connector._params=r.params,a=0;a<r.actions.length;++a)n=ARK_game_arena_connector._actionHandler[r.actions[a]],"function"==typeof n&&n(r.params);var o="";for(a=0;a<r.returnValues.length;++a)ARK_game_arena_connector._arena_return_values_subscription[r.returnValues[a]]=!0,"score"===r.returnValues[a]&&(o+="score="+encodeURIComponent(ARK_game_arena_connector._score)),"score_hash"===r.returnValues[a]&&(o+="&score_hash="+ARK_game_arena_connector._md5(ARK_game_arena_connector._score.toString()+"_"+ARK_game_arena_connector._playId)),"game_log"===r.returnValues[a]&&(o+="&game_log="+encodeURIComponent(JSON.stringify(ARK_game_arena_connector._scoreChangleLog)));for(a=0;a<r.events.length;++a)ARK_game_arena_connector._arena_events_subscription[r.events[a]]=!0;o.length>0&&ARK_game_arena_connector._messageSender(o),null!==ARK_game_arena_connector._postInitCallback&&(ARK_game_arena_connector._postInitCallback(),ARK_game_arena_connector._postInitCallback=null)}}};