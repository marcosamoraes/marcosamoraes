(function (global, factory){
typeof exports==='object'&&typeof module!=='undefined' ? module.exports=factory(require('jquery')) :
typeof define==='function'&&define.amd ? define(['jquery'], factory) :
(global.Util=factory(global.jQuery));
}(this, (function ($){ 'use strict';
$=$&&$.hasOwnProperty('default') ? $['default']:$;
var Util=function ($$$1){
var TRANSITION_END='transitionend';
var MAX_UID=1000000;
var MILLISECONDS_MULTIPLIER=1000;
function toType(obj){
return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
}
function getSpecialTransitionEndEvent(){
return {
bindType: TRANSITION_END,
delegateType: TRANSITION_END,
handle: function handle(event){
if($$$1(event.target).is(this)){
return event.handleObj.handler.apply(this, arguments);
}
return undefined;
}};}
function transitionEndEmulator(duration){
var _this=this;
var called=false;
$$$1(this).one(Util.TRANSITION_END, function (){
called=true;
});
setTimeout(function (){
if(!called){
Util.triggerTransitionEnd(_this);
}}, duration);
return this;
}
function setTransitionEndSupport(){
$$$1.fn.emulateTransitionEnd=transitionEndEmulator;
$$$1.event.special[Util.TRANSITION_END]=getSpecialTransitionEndEvent();
}
var Util={
TRANSITION_END: 'bsTransitionEnd',
getUID: function getUID(prefix){
do {
prefix +=~~(Math.random() * MAX_UID); // "~~" acts like a faster Math.floor() here
} while (document.getElementById(prefix));
return prefix;
},
getSelectorFromElement: function getSelectorFromElement(element){
var selector=element.getAttribute('data-target');
if(!selector||selector==='#'){
selector=element.getAttribute('href')||'';
}
try {
return document.querySelector(selector) ? selector:null;
} catch (err){
return null;
}},
getTransitionDurationFromElement: function getTransitionDurationFromElement(element){
if(!element){
return 0;
}
var transitionDuration=$$$1(element).css('transition-duration');
var floatTransitionDuration=parseFloat(transitionDuration);
if(!floatTransitionDuration){
return 0;
}
transitionDuration=transitionDuration.split(',')[0];
return parseFloat(transitionDuration) * MILLISECONDS_MULTIPLIER;
},
reflow: function reflow(element){
return element.offsetHeight;
},
triggerTransitionEnd: function triggerTransitionEnd(element){
$$$1(element).trigger(TRANSITION_END);
},
supportsTransitionEnd: function supportsTransitionEnd(){
return Boolean(TRANSITION_END);
},
isElement: function isElement(obj){
return (obj[0]||obj).nodeType;
},
typeCheckConfig: function typeCheckConfig(componentName, config, configTypes){
for (var property in configTypes){
if(Object.prototype.hasOwnProperty.call(configTypes, property)){
var expectedTypes=configTypes[property];
var value=config[property];
var valueType=value&&Util.isElement(value) ? 'element':toType(value);
if(!new RegExp(expectedTypes).test(valueType)){
throw new Error(componentName.toUpperCase() + ": " + ("Option \"" + property + "\" provided type \"" + valueType + "\" ") + ("but expected type \"" + expectedTypes + "\"."));
}}
}}
};
setTransitionEndSupport();
return Util;
}($);
return Util;
})));