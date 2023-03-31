"use strict";(self.webpackChunkgravityforms=self.webpackChunkgravityforms||[]).push([[355],{6443:function(e,t,n){n.d(t,{Z:function(){return h}});var r=n(1930),s=n(8821),a=n(5169),i=n(2340),o=n.n(i),u=function(){function e(t){(0,s.Z)(this,e),this.handlers=[],this.name=t;for(var n=arguments.length,r=new Array(n>1?n-1:0),a=1;a<n;a++)r[a-1]=arguments[a];this.args=r}return(0,a.Z)(e,[{key:"subscribe",value:function(e,t){if(Array.isArray(e))for(var n=0;n<e.length;n++)this.handlers.push({handler:e[n],scope:t});else this.handlers.push({handler:e,scope:t})}},{key:"unsubscribe",value:function(e){this.handlers=this.handlers.filter((function(t){return t!==e&&t}))}},{key:"fire",value:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return!!this.handlers.length&&(this.handlers.forEach((function(e){var n;(n=e.handler).call.apply(n,[e.scope].concat(t))})),!0)}}]),e}();function c(e,t){var n="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!n){if(Array.isArray(e)||(n=function(e,t){if(e){if("string"==typeof e)return f(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?f(e,t):void 0}}(e))||t&&e&&"number"==typeof e.length){n&&(e=n);var r=0,s=function(){};return{s:s,n:function(){return r>=e.length?{done:!0}:{done:!1,value:e[r++]}},e:function(e){throw e},f:s}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,i=!0,o=!1;return{s:function(){n=n.call(e)},n:function(){var e=n.next();return i=e.done,e},e:function(e){o=!0,a=e},f:function(){try{i||null==n.return||n.return()}finally{if(o)throw a}}}}function f(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}var h=function(){function e(){(0,s.Z)(this,e),this.events=[]}return(0,a.Z)(e,[{key:"destroyEvents",value:function(){this.events=[]}},{key:"add",value:function(e){this.events.push(e)}},{key:"get",value:function(e){var t,n=!1,r=c(this.events);try{for(r.s();!(t=r.n()).done;){var s=t.value;if(e===s.name){n=s;break}}}catch(e){r.e(e)}finally{r.f()}return!1===n&&(n=new u(e),this.add(n)),n}},{key:"addListener",value:function(e,t,n){this.get(e).subscribe(t,n)}},{key:"addListeners",value:function(e,t){var n=this;e.forEach((function(e){var r=e.scope?e.scope:t;if(Array.isArray(e.name)){var s,a=c(e.name);try{for(a.s();!(s=a.n()).done;){var i=s.value;n.addListener(i,e.handler,r)}}catch(e){a.e(e)}finally{a.f()}}else n.addListener(e.name,e.handler,r)}))}},{key:"trigger",value:function(e){var t=this.get(e),n=[].slice.call(arguments);return n.shift(),t.fire.apply(t,(0,r.Z)(n)),o().doAction.apply(o(),["gform_form_saving_action_"+e.replace(/[A-Z]/g,(function(e){return"_".concat(e.toLowerCase())})),window.form,t].concat((0,r.Z)(n))),n.push(t),n.push(window.form),o().applyFilters.apply(o(),["gform_form_saving_filter_"+e.replace(/[A-Z]/g,(function(e){return"_".concat(e.toLowerCase())}))].concat((0,r.Z)(n)))}}]),e}()},8355:function(e,t,n){n.d(t,{Z:function(){return v}});var r=n(6655),s=n(8950),a=n(8821),i=n(5169),o=n(2975),u=n.n(o),c=n(5311),f=n.n(c),h=n(9608),l=n.n(h),d=n(6443),g=n(2954),v=function(){function e(t,n){(0,a.Z)(this,e),this.config=t,this.formJSONString="formJSONString"in n?n.formJSONString:"",this.form="form"in n?n.form:t.data.form,this.eventsManager="events"in n?n.events:new d.Z,this.endpoints="endpoints"in n?n.endpoints:t.endpoints,this.endpointKey="endpointKey"in n?n.endpointKey:"admin_save_form",this.response={},this.saveInProgress=!1}var t;return(0,i.Z)(e,[{key:"addEndPoint",value:function(e){this.config.endpoints.push(e)}},{key:"setForm",value:function(e){this.form=e}},{key:"getFormEscapedJsonString",value:function(){return""===this.formJSONString&&(this.formJSONString=f().toJSON(this.form)),this.formJSONString.replace(/"/g,'\\"').replace(/\\n/g,"\\\\n").replace(/\\r/g,"\\\\r").replace(/\\t/g,"\\\\t")}},{key:"save",value:(t=(0,s.Z)(u().mark((function e(){var t,n,s,a,i,o,c,f,h,d,v;return u().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(t=!1,!this.saveInProgress){e.next=3;break}return e.abrupt("return",!1);case 3:if(this.eventsManager.trigger("SaveBegan"),n=this.getFormEscapedJsonString(),"object"===(0,r.Z)(this.form)&&"id"in this.form!=0&&""!==n){e.next=9;break}this.eventsManager.trigger("SaveFormDataMissing",this.form),e.next=16;break;case 9:return a={baseUrl:l(),method:"POST",body:{data:n,form_id:this.form.id}},this.eventsManager.trigger("SaveInProgress",a),e.next=13,(0,g.Z)(this.endpointKey,this.config.endpoints,a);case 13:if("error"in(i=e.sent)&&500!==i.status&&"detail"in i.error&&"text"in i.error.detail&&(o=i.error.detail.text,c=this.config.data.json_containers[0],f=this.config.data.json_containers[1],o.indexOf(c)>=0&&o.indexOf(f)>0)){h=o.substring(o.indexOf(c)-2,o.indexOf(f)+f.length+4);try{h=JSON.parse(h),d=!(!(d=h.status)||"success"!==d&&!0!==d),h.success=d,v={data:h,success:d},i.data=v,i.success=d}catch(e){this.eventsManager.trigger("SaveRequestFailed",i)}}null!=i&&null!==(s=i.data)&&void 0!==s&&s.success?(this.response=i.data,this.handleSuccessfulRequest(),t=!0):(this.eventsManager.trigger("SaveResponseMalformed",i),t=!1);case 16:return this.eventsManager.trigger("SaveCompleted",this.form),e.abrupt("return",t);case 18:case"end":return e.stop()}}),e,this)}))),function(){return t.apply(this,arguments)})},{key:"handleSuccessfulRequest",value:function(){return"data"in this.response==0||"object"!==(0,r.Z)(this.response.data)||Array.isArray(this.response.data)||null===this.response.data?(this.eventsManager.trigger("SaveResponseMalformed",this.response),!1):!("status"in this.response.data)||!0!==this.response.data.status&&"success"!==this.response.data.status?(this.eventsManager.trigger("SaveFailed",this.response.data,this.form),!1):(this.eventsManager.trigger("SaveSucceeded",this.response),!0)}}]),e}()}}]);
//# sourceMappingURL=355.208686d31b904e61799f.js.map