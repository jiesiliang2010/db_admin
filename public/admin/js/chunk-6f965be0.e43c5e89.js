(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-6f965be0"],{"03dd":function(e,t,n){var r=n("eac5"),i=n("57a5"),a=Object.prototype,o=a.hasOwnProperty;function s(e){if(!r(e))return i(e);var t=[];for(var n in Object(e))o.call(e,n)&&"constructor"!=n&&t.push(n);return t}e.exports=s},"0621":function(e,t,n){var r=n("9e69"),i=n("d370"),a=n("6747"),o=r?r.isConcatSpreadable:void 0;function s(e){return a(e)||i(e)||!!(o&&e&&e[o])}e.exports=s},"087d":function(e,t){function n(e,t){var n=-1,r=t.length,i=e.length;while(++n<r)e[i+n]=t[n];return e}e.exports=n},"08cc":function(e,t,n){var r=n("1a8c");function i(e){return e===e&&!r(e)}e.exports=i},1799:function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return e.page?n("el-pagination",e._b({ref:"page",attrs:{"page-sizes":e.pageSizes,"current-page":e.currentPage,"page-size":e.perPage,total:e.page.total,layout:e.layout,background:""},on:{"size-change":e.onSizeChange,"current-change":e.onChange,"update:currentPage":function(t){e.currentPage=t},"update:current-page":function(t){e.currentPage=t},"update:pageSize":function(t){e.perPage=t},"update:page-size":function(t){e.perPage=t}}},"el-pagination",e.$attrs,!1)):e._e()},i=[],a={name:"Pagination",data:function(){return{currentPage:1,perPage:15}},props:{page:Object,layout:{type:String,default:"total, prev, pager, next, sizes, jumper"},autoPush:{type:Boolean,default:!0}},computed:{pageSizes:function(){var e=[15,30,50,100,200],t=this.page.per_page;return-1===e.indexOf(t)?[this.page.per_page].concat(e):e}},methods:{push:function(){var e=Object.assign({},this.$route.query,{page:this.currentPage,per_page:this.perPage});this.$router.push({path:this.$route.path,query:e})},onSizeChange:function(e){this.$emit("size-change",e),this.autoPush&&(this.currentPage=1,this.push())},onChange:function(e){this.$emit("current-change",e),this.autoPush&&this.push()}},watch:{page:{handler:function(e){var t=this;e&&(this.currentPage=e.current_page,this.perPage=e.per_page,this.$nextTick((function(){t.$refs.page.internalCurrentPage=e.current_page})))},immediate:!0}}},o=a,s=n("2877"),c=Object(s["a"])(o,r,i,!1,null,"0d3103cd",null);t["a"]=c.exports},1838:function(e,t,n){var r=n("c05f"),i=n("9b02"),a=n("8604"),o=n("f608"),s=n("08cc"),c=n("20ec"),u=n("f4d6"),l=1,d=2;function f(e,t){return o(e)&&s(t)?c(u(e),t):function(n){var o=i(n,e);return void 0===o&&o===t?a(n,e):r(t,o,l|d)}}e.exports=f},"1c3c":function(e,t,n){var r=n("9e69"),i=n("2474"),a=n("9638"),o=n("a2be"),s=n("edfa"),c=n("ac41"),u=1,l=2,d="[object Boolean]",f="[object Date]",p="[object Error]",h="[object Map]",g="[object Number]",v="[object RegExp]",m="[object Set]",b="[object String]",y="[object Symbol]",x="[object ArrayBuffer]",w="[object DataView]",_=r?r.prototype:void 0,C=_?_.valueOf:void 0;function O(e,t,n,r,_,O,j){switch(n){case w:if(e.byteLength!=t.byteLength||e.byteOffset!=t.byteOffset)return!1;e=e.buffer,t=t.buffer;case x:return!(e.byteLength!=t.byteLength||!O(new i(e),new i(t)));case d:case f:case g:return a(+e,+t);case p:return e.name==t.name&&e.message==t.message;case v:case b:return e==t+"";case h:var k=s;case m:var S=r&u;if(k||(k=c),e.size!=t.size&&!S)return!1;var P=j.get(e);if(P)return P==t;r|=l,j.set(e,t);var D=o(k(e),k(t),r,_,O,j);return j["delete"](e),D;case y:if(C)return C.call(e)==C.call(t)}return!1}e.exports=O},"1cec":function(e,t,n){var r=n("0b07"),i=n("2b3e"),a=r(i,"Promise");e.exports=a},"20ec":function(e,t){function n(e,t){return function(n){return null!=n&&(n[e]===t&&(void 0!==t||e in Object(n)))}}e.exports=n},2474:function(e,t,n){var r=n("2b3e"),i=r.Uint8Array;e.exports=i},"24ad":function(e,t,n){"use strict";var r=n("eae4"),i=n.n(r);i.a},"26e8":function(e,t){function n(e,t){return null!=e&&t in Object(e)}e.exports=n},2847:function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"file-preview flex-box"},[e.path?e.isImage?n("img",{staticClass:"img",attrs:{alt:e.path,title:e.path,src:e.url}}):n("div",{staticClass:"path",attrs:{title:e.path}},[e._v(e._s(e.path))]):n("div",{staticClass:"invalid",attrs:{title:e.path}},[e._v("\n    无效\n  ")]),n("div",{staticClass:"actions flex-box"},[e.disableView?e._e():[e.isImage?n("i",{staticClass:"el-icon-view",attrs:{title:"查看"},on:{click:function(t){return t.stopPropagation(),e.onPreview(t)}}}):n("a",{staticClass:"el-icon-view",attrs:{href:e.url,target:"_blank",title:"查看"}})],e._t("default",null,{file:e.formattedFile})],2)])},i=[],a=(n("8e6e"),n("ac6a"),n("456d"),n("7618")),o=n("bd86"),s=n("a6d5"),c=n("2f62"),u=n("90fe"),l=n("9f91");function d(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function f(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?d(n,!0).forEach((function(t){Object(o["a"])(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):d(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var p={name:"FilePreview",data:function(){return{formattedFile:{path:"",url:""},width:0,height:0}},props:f({file:null,disableView:Boolean},Object(c["c"])(["miniWidth"])),computed:{isImage:function(){return Object(s["b"])(this.formattedFile.path)},url:function(){return this.formattedFile.url},path:function(){return this.formattedFile.path}},methods:{toUpperCase:function(e){return e.toUpperCase()},formatFile:function(){var e=this.file;e&&("string"===typeof e?this.formattedFile={path:e,url:Object(u["i"])(e)}:"object"===Object(a["a"])(e)&&(this.formattedFile=Object.assign({},e,{path:e.path||"",url:e.url||Object(u["i"])(e.path)})))},onPreview:function(){var e,t=this;this.isImage&&(this.setImgSize(),e=l["a"].new({customClass:"image-preview-dialog",directives:[{name:"resize",value:this.setImgSize}],content:function(e){return e("img",{domProps:{src:t.formattedFile.url,width:t.width,height:t.height}})}}),e.$el.classList.add("image-preview-dialog-wrapper"))},setImgSize:function(){var e=Math.min(1e3,.9*window.innerWidth),t=.9*window.innerHeight,n=this.$el.querySelector(".img");this.width=n.naturalWidth||1,this.height=n.naturalHeight||1;var r=this.width/this.height;this.width>e&&(this.width=e,this.height=this.width/r),this.height>t&&(this.height=t,this.width=this.height*r)}},watch:{file:{handler:function(){this.formatFile()},immediate:!0}}},h=p,g=(n("adf6"),n("498c"),n("2877")),v=Object(g["a"])(h,r,i,!1,null,"e4d315d4",null);t["a"]=v.exports},"2d7c":function(e,t){function n(e,t){var n=-1,r=null==e?0:e.length,i=0,a=[];while(++n<r){var o=e[n];t(o,n,e)&&(a[i++]=o)}return a}e.exports=n},"2eaa":function(e,t,n){var r=n("d612"),i=n("8db3"),a=n("5edf"),o=n("7948"),s=n("b047"),c=n("c584"),u=200;function l(e,t,n,l){var d=-1,f=i,p=!0,h=e.length,g=[],v=t.length;if(!h)return g;n&&(t=o(t,s(n))),l?(f=a,p=!1):t.length>=u&&(f=c,p=!1,t=new r(t));e:while(++d<h){var m=e[d],b=null==n?m:n(m);if(m=l||0!==m?m:0,p&&b===b){var y=v;while(y--)if(t[y]===b)continue e;g.push(m)}else f(t,b,l)||g.push(m)}return g}e.exports=l},"2fcc":function(e,t){function n(e){var t=this.__data__,n=t["delete"](e);return this.size=t.size,n}e.exports=n},"32f4":function(e,t,n){var r=n("2d7c"),i=n("d327"),a=Object.prototype,o=a.propertyIsEnumerable,s=Object.getOwnPropertySymbols,c=s?function(e){return null==e?[]:(e=Object(e),r(s(e),(function(t){return o.call(e,t)})))}:i;e.exports=c},"39ff":function(e,t,n){var r=n("0b07"),i=n("2b3e"),a=r(i,"WeakMap");e.exports=a},"3bb4":function(e,t,n){var r=n("08cc"),i=n("ec69");function a(e){var t=i(e),n=t.length;while(n--){var a=t[n],o=e[a];t[n]=[a,o,r(o)]}return t}e.exports=a},"40cd":function(e,t,n){},4284:function(e,t){function n(e,t){var n=-1,r=null==e?0:e.length;while(++n<r)if(t(e[n],n,e))return!0;return!1}e.exports=n},"42a2":function(e,t,n){var r=n("b5a7"),i=n("79bc"),a=n("1cec"),o=n("c869"),s=n("39ff"),c=n("3729"),u=n("dc57"),l="[object Map]",d="[object Object]",f="[object Promise]",p="[object Set]",h="[object WeakMap]",g="[object DataView]",v=u(r),m=u(i),b=u(a),y=u(o),x=u(s),w=c;(r&&w(new r(new ArrayBuffer(1)))!=g||i&&w(new i)!=l||a&&w(a.resolve())!=f||o&&w(new o)!=p||s&&w(new s)!=h)&&(w=function(e){var t=c(e),n=t==d?e.constructor:void 0,r=n?u(n):"";if(r)switch(r){case v:return g;case m:return l;case b:return f;case y:return p;case x:return h}return t}),e.exports=w},"498c":function(e,t,n){"use strict";var r=n("e8a4"),i=n.n(r);i.a},"4b17":function(e,t,n){var r=n("6428");function i(e){var t=r(e),n=t%1;return t===t?n?t-n:t:0}e.exports=i},"51f5":function(e,t,n){var r=n("2b03"),i=n("badf"),a=n("4b17"),o=Math.max;function s(e,t,n){var s=null==e?0:e.length;if(!s)return-1;var c=null==n?0:a(n);return c<0&&(c=o(s+c,0)),r(e,i(t,3),c)}e.exports=s},"55a3":function(e,t){function n(e){return this.__data__.has(e)}e.exports=n},"57a5":function(e,t,n){var r=n("91e90"),i=r(Object.keys,Object);e.exports=i},"5c69":function(e,t,n){var r=n("087d"),i=n("0621");function a(e,t,n,o,s){var c=-1,u=e.length;n||(n=i),s||(s=[]);while(++c<u){var l=e[c];t>0&&n(l)?t>1?a(l,t-1,n,o,s):r(s,l):o||(s[s.length]=l)}return s}e.exports=a},"5d58":function(e,t,n){e.exports=n("d8d6")},6428:function(e,t,n){var r=n("b4b0"),i=1/0,a=17976931348623157e292;function o(e){if(!e)return 0===e?e:0;if(e=r(e),e===i||e===-i){var t=e<0?-1:1;return t*a}return e===e?e:0}e.exports=o},"642a":function(e,t,n){var r=n("966f"),i=n("3bb4"),a=n("20ec");function o(e){var t=i(e);return 1==t.length&&t[0][2]?a(t[0][0],t[0][1]):function(n){return n===e||r(n,e,t)}}e.exports=o},"67bb":function(e,t,n){e.exports=n("f921")},"6ae0":function(e,t,n){},"6fc0":function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n(e.comp,e._b({tag:"component",staticClass:"pop-confirm",attrs:{type:e.type,disabled:e.disabled}},"component",e.$attrs,!1),[n("el-popover",{attrs:{placement:"top",width:"160",disabled:e.disabled},model:{value:e.visible,callback:function(t){e.visible=t},expression:"visible"}},[n("p",[e._v(e._s(e.notice))]),n("div",{staticStyle:{"text-align":"right",margin:"0"}},[n("el-button",{attrs:{size:"mini"},on:{click:e.onCancel}},[e._v("取消")]),n("loading-action",{attrs:{type:e.confirmType,size:"mini",action:e.action,disabled:e.disabled}},[e._v("\n        确定\n      ")])],1),n("span",{staticClass:"trigger",attrs:{slot:"reference"},slot:"reference"})]),e._t("default")],2)},i=[],a=(n("96cf"),n("3b8d")),o={name:"PopConfirm",data:function(){return{visible:!1}},props:{notice:{type:String,default:"确认操作？"},confirmType:{type:String,default:"primary"},confirm:Function,type:String,disabled:Boolean,comp:{type:String,default:"el-button"}},methods:{onCancel:function(){this.visible=!1,this.$emit("cancel")},action:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(!this.disabled){e.next=2;break}return e.abrupt("return");case 2:return e.next=4,this.confirm();case 4:this.visible=!1;case 5:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}()}},s=o,c=(n("7868"),n("2877")),u=Object(c["a"])(s,r,i,!1,null,"f5b0dac6",null);t["a"]=u.exports},7391:function(e,t,n){},7618:function(e,t,n){"use strict";n.d(t,"a",(function(){return c}));var r=n("5d58"),i=n.n(r),a=n("67bb"),o=n.n(a);function s(e){return s="function"===typeof o.a&&"symbol"===typeof i.a?function(e){return typeof e}:function(e){return e&&"function"===typeof o.a&&e.constructor===o.a&&e!==o.a.prototype?"symbol":typeof e},s(e)}function c(e){return c="function"===typeof o.a&&"symbol"===s(i.a)?function(e){return s(e)}:function(e){return e&&"function"===typeof o.a&&e.constructor===o.a&&e!==o.a.prototype?"symbol":s(e)},c(e)}},7868:function(e,t,n){"use strict";var r=n("6ae0"),i=n.n(r);i.a},"7b97":function(e,t,n){var r=n("7e64"),i=n("a2be"),a=n("1c3c"),o=n("b1e5"),s=n("42a2"),c=n("6747"),u=n("0d24"),l=n("73ac"),d=1,f="[object Arguments]",p="[object Array]",h="[object Object]",g=Object.prototype,v=g.hasOwnProperty;function m(e,t,n,g,m,b){var y=c(e),x=c(t),w=y?p:s(e),_=x?p:s(t);w=w==f?h:w,_=_==f?h:_;var C=w==h,O=_==h,j=w==_;if(j&&u(e)){if(!u(t))return!1;y=!0,C=!1}if(j&&!C)return b||(b=new r),y||l(e)?i(e,t,n,g,m,b):a(e,t,w,n,g,m,b);if(!(n&d)){var k=C&&v.call(e,"__wrapped__"),S=O&&v.call(t,"__wrapped__");if(k||S){var P=k?e.value():e,D=S?t.value():t;return b||(b=new r),m(P,D,n,g,b)}}return!!j&&(b||(b=new r),o(e,t,n,g,m,b))}e.exports=m},"7d1f":function(e,t,n){var r=n("087d"),i=n("6747");function a(e,t,n){var a=t(e);return i(e)?a:r(a,n(e))}e.exports=a},"7e64":function(e,t,n){var r=n("5e2e"),i=n("efb6"),a=n("2fcc"),o=n("802a"),s=n("55a3"),c=n("d02c");function u(e){var t=this.__data__=new r(e);this.size=t.size}u.prototype.clear=i,u.prototype["delete"]=a,u.prototype.get=o,u.prototype.has=s,u.prototype.set=c,e.exports=u},"802a":function(e,t){function n(e){return this.__data__.get(e)}e.exports=n},8604:function(e,t,n){var r=n("26e8"),i=n("e2c0");function a(e,t){return null!=e&&i(e,t,r)}e.exports=a},"8a59":function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-card",{staticClass:"system-media",class:{"mini-width":e.miniWidth},attrs:{shadow:"never"}},[n("el-container",{staticClass:"body"},[e.miniWidth?e._e():n("el-aside",{staticClass:"aside",attrs:{width:"221px"}},[n("category",{ref:"category",staticClass:"h-100",on:{select:e.onCategorySelect,"categories-change":e.onCategoriesChange}})],1),n("el-dialog",{staticClass:"categories-dialog",attrs:{title:"选择分类",visible:e.categoriesDialog,width:"90%","append-to-body":""},on:{"update:visible":function(t){e.categoriesDialog=t}}},[e.miniWidth?n("category",{ref:"category",staticClass:"h-100",on:{select:e.onCategorySelect,"categories-change":e.onCategoriesChange}}):e._e()],1),n("el-container",[n("el-header",[n("collapse-button-group",[n("loading-action",{attrs:{action:e.onReloadMedia}},[e._v("刷新")]),n("el-button",{attrs:{disabled:!e.anySelected},on:{click:function(t){e.movingDialog=!0}}},[e._v("移动")]),void 0===e.defaultMultiple?n("el-button",{attrs:{type:e.multiple?"primary":""},on:{click:function(t){e.multiple=!e.multiple}}},[e._v("\n            多选\n          ")]):e._e(),n("pop-confirm",{attrs:{notice:"物理文件也有可能会被删除！确认删除？",type:"danger",disabled:!e.anySelected,confirm:e.onDestroyMedia}},[e._v("\n            删除\n          ")])],1),e.miniWidth?n("el-button",{staticClass:"ml-1",on:{click:function(t){e.categoriesDialog=!0}}},[e._v("选择分类")]):e._e()],1),n("el-main",{directives:[{name:"loading",rawName:"v-loading",value:e.mediaLoading||e.uploading,expression:"mediaLoading || uploading"}],attrs:{"element-loading-text":e.uploadingText}},[n("div",{staticClass:"h-100"},[n("el-scrollbar",{staticClass:"h-100"},[n("files",{ref:"media",attrs:{media:e.media,multiple:e.multiple,selected:e.selected,ext:e.defaultExt},on:{"update:selected":function(t){e.selected=t}}})],1)],1)]),n("el-footer",{staticClass:"footer"},[n("collapse-button-group",{staticClass:"footer-actions"},[n("el-button",{attrs:{disabled:e.currentCategoryId<=0},on:{click:e.onClickUpload}},[e._v("上传")]),n("el-button",{attrs:{disabled:!e.anySelected},on:{click:e.clearSelected}},[e._v("\n            清空 "+e._s(this.selectedCount?"("+this.selectedCount+")":"")+"\n          ")]),n("el-button",{attrs:{disabled:!!e.defaultExt,title:e.ext},on:{click:e.onOpenExtDialog}},[e._v("\n            "+e._s(e.ext?"已筛选":"筛选")+"\n          ")]),e._t("actions",null,null,e.getThis)],2),n("flex-spacer"),n("pagination",{attrs:{page:e.page,layout:"total, pager","auto-push":!1,"pager-count":5,"hide-on-single-page":""},on:{"current-change":e.onPageChange}})],1)],1)],1),e.defaultExt?e._e():n("el-dialog",{attrs:{title:"筛选类型",visible:e.extDialog,width:"400px","append-to-body":""},on:{"update:visible":function(t){e.extDialog=t}},nativeOn:{keydown:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.onExtFilter(t)}}},[n("el-input",{attrs:{autofocus:"",autocomplete:"off",placeholder:"多个之间用英文逗号隔开"},model:{value:e.extTemp,callback:function(t){e.extTemp=t},expression:"extTemp"}}),n("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[n("el-button",{on:{click:function(t){e.extDialog=!1}}},[e._v("取消")]),n("el-button",{attrs:{type:"primary"},on:{click:e.onExtFilter}},[e._v("确定")])],1)],1),n("el-dialog",{attrs:{title:"移动文件",visible:e.movingDialog,width:"400px","append-to-body":""},on:{"update:visible":function(t){e.movingDialog=t}}},[n("el-select",{attrs:{filterable:"",placeholder:"请选择目标分类"},model:{value:e.movingTarget,callback:function(t){e.movingTarget=t},expression:"movingTarget"}},e._l(e.categoriesSelectOptions,(function(t){return n("el-option",{key:t.id,attrs:{label:t.title,value:t.id}},[n("span",[e._v(e._s(t.text))])])})),1),n("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[n("el-button",{on:{click:function(t){e.movingDialog=!1}}},[e._v("取消")]),n("loading-action",{attrs:{type:"primary",action:e.onMove,disabled:!e.movingTarget}},[e._v("\n        移动\n      ")])],1)],1),n("el-upload",{ref:"upload",staticStyle:{display:"none"},attrs:{disabled:e.currentCategoryId<=0,multiple:"",action:"#","http-request":e.storeMedia,"show-file-list":!1,"on-change":e.onUploadChange,"before-upload":e.beforeUpload,accept:"."+(e.defaultExt?e.defaultExt:"").replace(/,/g,",.")}})],1)},i=[],a=(n("7f7f"),n("96cf"),n("3b8d")),o=(n("28a5"),n("6fc0")),s=n("ff66");function c(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return s["b"].get("system-media-categories",{params:e})}function u(e){return s["b"].delete("system-media-categories/".concat(e))}function l(e,t){return s["b"].put("system-media-categories/".concat(e),t)}function d(e){return s["b"].post("system-media-categories",e)}function f(e,t){var n=new FormData;return n.append("file",t),s["b"].post("system-media-categories/".concat(e,"/system-media"),n)}function p(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return s["b"].get("system-media-categories/".concat(e,"/system-media"),{params:t})}function h(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return s["b"].get("system-media",{params:e})}function g(e){return s["b"].put("system-media",e)}function v(e){return s["b"].post("system-media",{_method:"DELETE",id:e})}var m=n("9b02"),b=n.n(m),y=n("24a0"),x=n("1799"),w=n("90fe"),_=n("a125"),C=n.n(_),O=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("el-input",{staticClass:"filter-input mb-1",class:{"w-100":e.miniWidth},attrs:{placeholder:"搜索分类",size:"small"},model:{value:e.q,callback:function(t){e.q=t},expression:"q"}}),n("el-button-group",{staticClass:"category-actions mb-2",class:{"w-100":e.miniWidth}},[n("loading-action",{attrs:{size:"mini",action:e.getCategories}},[e._v("刷新")]),n("el-button",{attrs:{size:"mini"},on:{click:function(t){return e.onOpenDialog(!1)}}},[e._v("添加")]),n("el-button",{attrs:{disabled:e.currentId<=0,size:"mini"},on:{click:function(t){return e.onOpenDialog(!0)}}},[e._v("\n      编辑\n    ")]),n("pop-confirm",{attrs:{disabled:e.currentId<=0,size:"mini",type:"danger",confirm:e.onDestroyCategory,notice:"所有子孙分类也将被删除!分类下的文件会被移动到“无分类”下。确认删除？"}},[e._v("\n      删除\n    ")])],1),n("el-scrollbar",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}],staticClass:"scroll-wrapper"},[n("div",{staticClass:"side-tree"},[n("el-tree",{ref:"tree",attrs:{"expand-on-click-node":!1,data:e.categories,props:e.treeOptions,"default-expand-all":"","filter-node-method":e.filter,indent:8,"node-key":"id","current-node-key":"1","highlight-current":"",draggable:"","allow-drag":e.allowDrag,"allow-drop":e.allowDrop},on:{"current-change":e.onCurrentChange,"node-drop":e.onNodeDrop}}),n("div")],1)]),n("el-dialog",{attrs:{title:e.editMode?"编辑分类":"添加分类",visible:e.dialog,width:"400px","append-to-body":""},on:{"update:visible":function(t){e.dialog=t}},nativeOn:{keydown:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.$refs.saveConfirm.onAction(t)}}},[n("el-form",{attrs:{model:e.form,"label-position":"top"}},[n("el-form-item",{attrs:{error:e.errors.parent_id,label:"父级"}},[n("el-select",{attrs:{filterable:"",clearable:""},model:{value:e.form.parent_id,callback:function(t){e.$set(e.form,"parent_id",t)},expression:"form.parent_id"}},e._l(e.cateOptions,(function(t){return n("el-option",{key:t.id,attrs:{label:t.title,value:t.id}},[n("span",[e._v(e._s(t.text))])])})),1)],1),n("el-form-item",{staticClass:"mb-0",attrs:{error:e.errors.name,label:"名称"}},[n("el-input",{attrs:{autocomplete:"off",autofocus:""},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1)],1),n("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[n("el-button",{on:{click:function(t){e.dialog=!1}}},[e._v("取消")]),n("loading-action",{ref:"saveConfirm",attrs:{type:"primary",action:e.onSave}},[e._v("\n        确定\n      ")])],1)],1)],1)},j=[],k=n("75fc"),S={name:"Category",components:{PopConfirm:o["a"]},data:function(){return{treeOptions:{children:"children",label:"name"},q:"",categories:[],loading:!1,current:null,editMode:!1,dialog:!1,form:{parent_id:0,name:""},errors:{}}},computed:{currentId:function(){return b()(this.current,"id",-1)},miniWidth:function(){return this.$store.state.miniWidth},canSave:function(){return!this.editMode||this.currentId>0},cateOptions:function(){return Object(w["m"])(this.categories.slice(2),{title:"name"})}},created:function(){this.getCategories()},methods:{getCategories:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){var t,n;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return this.loading=!0,e.prev=1,e.next=4,c();case 4:return t=e.sent,n=t.data,this.categories=[{id:-1,name:"所有"},{id:0,name:"无分类"}].concat(Object(k["a"])(n)),e.next=9,this.$nextTick();case 9:this.initSelected();case 10:return e.prev=10,this.loading=!1,e.finish(10);case 13:case"end":return e.stop()}}),e,this,[[1,,10,13]])})));function t(){return e.apply(this,arguments)}return t}(),initSelected:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,this.$nextTick();case 2:this.$refs.tree.setCurrentKey(-1),this.current=this.categories[0];case 4:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),onOpenDialog:function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.editMode=e,this.canSave&&(this.form={parent_id:e?this.current.parent_id:this.currentId<0?0:this.currentId,name:e?this.current.name:""},this.dialog=!0)},onDestroyCategory:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(t=this.currentId,!(t<=0)){e.next=3;break}return e.abrupt("return");case 3:return e.next=5,u(t);case 5:this.$message.success(Object(w["h"])("destroyed")),this.initSelected(),this.$refs.tree.remove(t);case 8:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),filter:function(e,t){return!e||-1!==t.name.indexOf(e)},onCurrentChange:function(e){this.current=e},allowDrag:function(e){var t=e.data;return t.id>0},allowDrop:function(e,t,n){var r=e.data,i=t.data;return!(i.id<=0)&&(0===i.parent_id||(r.parent_id!==i.parent_id||"inner"===n))},onNodeDrop:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(t,n,r){var i,a,o,s;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return i=t.data,a=n.data,o=0,o="inner"===r?a.id:a.parent_id,e.prev=4,e.next=7,this.updateCategory(i,{parent_id:o},!0);case 7:e.next=14;break;case 9:e.prev=9,e.t0=e["catch"](4),s=this.$refs.tree,s.remove(i),s.append(i,i.parent_id);case 14:case"end":return e.stop()}}),e,this,[[4,9]])})));function t(t,n,r){return e.apply(this,arguments)}return t}(),updateCategory:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(t,n){var r,i,a=arguments;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return r=!(a.length>2&&void 0!==a[2])||a[2],e.next=3,l(t.id,n).setConfig({showValidationMsg:r,validationForm:r?null:this});case 3:i=e.sent,this.$message.success(Object(w["h"])("updated")),t.name=i.data.name,t.parent_id=i.data.parent_id;case 7:case"end":return e.stop()}}),e,this)})));function t(t,n){return e.apply(this,arguments)}return t}(),onSave:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){var t,n,r,i,a;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(this.canSave){e.next=2;break}return e.abrupt("return");case 2:if(t=this.$refs.tree,n=this.form.parent_id,this.errors={},!this.editMode){e.next=12;break}return r=this.current.parent_id,e.next=9,this.updateCategory(this.current,this.form,!1);case 9:r!==n&&(t.remove(this.current),t.append(this.current,n)),e.next=19;break;case 12:return e.next=14,d(this.form).setConfig({validationForm:this});case 14:i=e.sent,a=i.data,a.children=[],t.append(a,n),this.$message.success(Object(w["h"])("created"));case 19:this.dialog=!1;case 20:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}()},watch:{q:function(e){this.$refs.tree.filter(e)},current:{handler:function(e){this.$emit("select",e)},immediate:!0},categories:{handler:function(e){this.$emit("categories-change",e.slice(2))},deep:!0},dialog:function(e){e||(this.errors={},this.form={parent_id:0,name:""})}}},P=S,D=(n("24ad"),n("2877")),$=Object(D["a"])(P,O,j,!1,null,"85effffe",null),E=$.exports,M=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"file-wrapper"},e._l(e.media,(function(t,r){return n("file-preview",{key:t.id,class:{selected:e.isSelected(t)},attrs:{file:t},nativeOn:{click:function(n){return e.onSelect(t,r)}}})})),1)},z=[],I=(n("8e6e"),n("ac6a"),n("456d"),n("bd86")),R=n("51f5"),F=n.n(R),T=n("e572"),W=n("a6d5"),A=n("2847");function L(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function U(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?L(n,!0).forEach((function(t){Object(I["a"])(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):L(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var B={name:"Files",components:{FilePreview:A["a"]},props:{media:Array,multiple:Boolean,selected:Array,ext:String},computed:U({},Object(T["e"])(["IMAGE_EXTS"])),methods:{onSelect:function(e,t){if(!this.ext||-1!==this.ext.split(",").indexOf(e.ext?e.ext.toLowerCase():"")){var n=this.findInSelected(e);-1!==n?this.selected.splice(n,1):this.multiple?this.selected.push(e):this.$emit("update:selected",[e]),this.$emit("select",this.selected,e,t,-1===n)}},findInSelected:function(e){return F()(this.selected,(function(t){return t.id===e.id}))},isSelected:function(e){return-1!==this.findInSelected(e)},isImage:W["b"],toUpperCase:function(e){return e.toUpperCase()}},watch:{multiple:function(e){e||this.selected.splice(1)}}},q=B,V=(n("9a5e"),Object(D["a"])(q,M,z,!1,null,"caa17e1a",null)),N=V.exports,G=n("1cae"),H={name:"SystemMedia",components:{CollapseButtonGroup:G["a"],Files:N,Category:E,Pagination:x["a"],FlexSpacer:y["a"],PopConfirm:o["a"]},data:function(){return{categories:[],currentCategory:null,media:[],mediaLoading:!1,page:null,ext:this.defaultExt||"",extTemp:"",extDialog:!1,selected:[],movingDialog:!1,moving:!1,movingTarget:"",uploading:!1,uploadCount:0,uploadFail:0,uploadSuccess:0,uploadInvalid:0,multiple:void 0!==this.defaultMultiple&&this.defaultMultiple,categoriesDialog:!1}},props:{defaultExt:{type:String,default:""},defaultMultiple:{type:Boolean,default:void 0}},computed:{currentCategoryId:function(){return b()(this.currentCategory,"id",-1)},miniWidth:function(){return this.$store.state.miniWidth},anySelected:function(){return this.selectedCount>0},selectedCount:function(){return this.selected.length},categoriesSelectOptions:function(){return Object(w["m"])(this.categories,{title:"name",firstLevel:null})},uploadingText:function(){return this.uploading?"正在上传中 (".concat(this.uploadSuccess," / ").concat(this.uploadCount,")"):""},getThis:function(){return this},extArray:function(){return this.ext.split(",")}},created:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,this.getMedia();case 2:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),methods:{getMedia:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){var t,n,r,i,a,o,s=arguments;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(t=s.length>0&&void 0!==s[0]?s[0]:-1,n=s.length>1?s[1]:void 0,this.mediaLoading=!0,i={page:n,ext:this.ext||void 0},e.prev=4,!(t>0)){e.next=12;break}return e.next=8,p(t,i);case 8:a=e.sent,r=a.data,e.next=17;break;case 12:return i.category_id=-1===t?void 0:0,e.next=15,h(i);case 15:o=e.sent,r=o.data;case 17:if(this.currentCategoryId===t){e.next=19;break}return e.abrupt("return");case 19:this.media=r.data,this.page=r.meta;case 21:return e.prev=21,this.mediaLoading=!1,e.finish(21);case 24:case"end":return e.stop()}}),e,this,[[4,,21,24]])})));function t(){return e.apply(this,arguments)}return t}(),onPageChange:function(e){this.getMedia(this.currentCategoryId,e)},onReloadMedia:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,this.getMedia(this.currentCategoryId);case 2:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),onExtFilter:function(){this.defaultExt||(this.ext=this.extTemp,this.extDialog=!1)},clearSelected:function(){this.selected=[]},onMove:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(this.movingTarget&&this.selectedCount){e.next=2;break}return e.abrupt("return");case 2:if(this.movingTarget!==this.currentCategoryId){e.next=6;break}return this.$message.info("没有移动到其他分类"),this.movingDialog=!1,e.abrupt("return");case 6:return e.next=8,this.batchUpdateMedia({id:this.selected.map((function(e){return e.id})),category_id:this.movingTarget});case 8:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),batchUpdateMedia:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(t){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,g(t).setConfig({showValidationMsg:!0});case 2:this.movingDialog=!1,this.$message.success(Object(w["h"])("updated")),-1===this.currentCategoryId?this.clearSelected():this.moveSelected();case 5:case"end":return e.stop()}}),e,this)})));function t(t){return e.apply(this,arguments)}return t}(),moveSelected:function(){this.media=C()(this.media,this.selected,"id"),this.clearSelected(),0===this.media.length&&this.onReloadMedia()},onDestroyMedia:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(this.selectedCount){e.next=2;break}return e.abrupt("return");case 2:return e.next=4,v(this.selected.map((function(e){return e.id})));case 4:this.$message.success(Object(w["h"])("destroyed")),this.moveSelected();case 6:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),onCategorySelect:function(e){this.currentCategory=e},onCategoriesChange:function(e){this.categories=e},onClickUpload:function(){var e=b()(this.$refs,"upload.$refs.upload-inner");e&&e.handleClick()},storeMedia:function(){var e=Object(a["a"])(regeneratorRuntime.mark((function e(t){var n,r,i,a;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(n=t.file,r=this.currentCategoryId,!(r<=0)){e.next=4;break}return e.abrupt("return");case 4:return e.next=6,f(r,n).setConfig({showValidationMsg:!0});case 6:i=e.sent,a=i.data,r!==this.currentCategoryId&&-1!==this.currentCategoryId||this.media.unshift(a);case 9:case"end":return e.stop()}}),e,this)})));function t(t){return e.apply(this,arguments)}return t}(),onUploadChange:function(e,t){"success"===e.status?this.uploadSuccess++:"fail"===e.status&&this.uploadFail++,this.uploadCount&&this.uploadSuccess+this.uploadFail===this.uploadCount&&(this.$msgbox({title:"上传完成",message:"上传成功 (".concat(this.uploadSuccess,")，失败 (").concat(this.uploadFail,")，无效 (").concat(this.uploadInvalid,")")}),this.$refs.upload.clearFiles(),this.uploading=!1,this.uploadCount=0,this.uploadFail=0,this.uploadSuccess=0)},beforeUpload:function(e){var t=e.size/1024/1024<=10;t||Object(w["e"])("文件 不能大于 10240 KB");var n=!this.defaultExt||-1!==this.extArray.indexOf(Object(w["f"])(e.name));n||Object(w["e"])("文件类型只能是："+this.defaultExt);var r=t&&n;return r?(this.uploadCount++,this.uploading=!0):this.uploadInvalid++,r},onOpenExtDialog:function(){this.defaultExt||(this.extDialog=!0)}},watch:{currentCategoryId:function(e){this.clearSelected(),this.getMedia(e)},extDialog:function(e){e&&(this.extTemp=this.ext)},ext:function(e){this.clearSelected(),this.getMedia(this.currentCategoryId)},miniWidth:function(e){e||(this.categoriesDialog=!1)},defaultMultiple:function(e){this.multiple=e}}},J=H,K=(n("cba3"),Object(D["a"])(J,r,i,!1,null,"c1e5926a",null));t["a"]=K.exports},"91e90":function(e,t){function n(e,t){return function(n){return e(t(n))}}e.exports=n},"966f":function(e,t,n){var r=n("7e64"),i=n("c05f"),a=1,o=2;function s(e,t,n,s){var c=n.length,u=c,l=!s;if(null==e)return!u;e=Object(e);while(c--){var d=n[c];if(l&&d[2]?d[1]!==e[d[0]]:!(d[0]in e))return!1}while(++c<u){d=n[c];var f=d[0],p=e[f],h=d[1];if(l&&d[2]){if(void 0===p&&!(f in e))return!1}else{var g=new r;if(s)var v=s(p,h,f,e,t,g);if(!(void 0===v?i(h,p,a|o,s,g):v))return!1}}return!0}e.exports=s},"9a5e":function(e,t,n){"use strict";var r=n("7391"),i=n.n(r);i.a},a125:function(e,t,n){var r=n("2eaa"),i=n("5c69"),a=n("badf"),o=n("100e"),s=n("dcbe"),c=n("4416"),u=o((function(e,t){var n=c(t);return s(n)&&(n=void 0),s(e)?r(e,i(t,1,s,!0),a(n,2)):[]}));e.exports=u},a2be:function(e,t,n){var r=n("d612"),i=n("4284"),a=n("c584"),o=1,s=2;function c(e,t,n,c,u,l){var d=n&o,f=e.length,p=t.length;if(f!=p&&!(d&&p>f))return!1;var h=l.get(e);if(h&&l.get(t))return h==t;var g=-1,v=!0,m=n&s?new r:void 0;l.set(e,t),l.set(t,e);while(++g<f){var b=e[g],y=t[g];if(c)var x=d?c(y,b,g,t,e,l):c(b,y,g,e,t,l);if(void 0!==x){if(x)continue;v=!1;break}if(m){if(!i(t,(function(e,t){if(!a(m,t)&&(b===e||u(b,e,n,c,l)))return m.push(t)}))){v=!1;break}}else if(b!==y&&!u(b,y,n,c,l)){v=!1;break}}return l["delete"](e),l["delete"](t),v}e.exports=c},a994:function(e,t,n){var r=n("7d1f"),i=n("32f4"),a=n("ec69");function o(e){return r(e,a,i)}e.exports=o},ac41:function(e,t){function n(e){var t=-1,n=Array(e.size);return e.forEach((function(e){n[++t]=e})),n}e.exports=n},adf6:function(e,t,n){"use strict";var r=n("c5a2"),i=n.n(r);i.a},b1e5:function(e,t,n){var r=n("a994"),i=1,a=Object.prototype,o=a.hasOwnProperty;function s(e,t,n,a,s,c){var u=n&i,l=r(e),d=l.length,f=r(t),p=f.length;if(d!=p&&!u)return!1;var h=d;while(h--){var g=l[h];if(!(u?g in t:o.call(t,g)))return!1}var v=c.get(e);if(v&&c.get(t))return v==t;var m=!0;c.set(e,t),c.set(t,e);var b=u;while(++h<d){g=l[h];var y=e[g],x=t[g];if(a)var w=u?a(x,y,g,t,e,c):a(y,x,g,e,t,c);if(!(void 0===w?y===x||s(y,x,n,a,c):w)){m=!1;break}b||(b="constructor"==g)}if(m&&!b){var _=e.constructor,C=t.constructor;_!=C&&"constructor"in e&&"constructor"in t&&!("function"==typeof _&&_ instanceof _&&"function"==typeof C&&C instanceof C)&&(m=!1)}return c["delete"](e),c["delete"](t),m}e.exports=s},b5a7:function(e,t,n){var r=n("0b07"),i=n("2b3e"),a=r(i,"DataView");e.exports=a},badf:function(e,t,n){var r=n("642a"),i=n("1838"),a=n("cd9d"),o=n("6747"),s=n("f9ce");function c(e){return"function"==typeof e?e:null==e?a:"object"==typeof e?o(e)?i(e[0],e[1]):r(e):s(e)}e.exports=c},c05f:function(e,t,n){var r=n("7b97"),i=n("1310");function a(e,t,n,o,s){return e===t||(null==e||null==t||!i(e)&&!i(t)?e!==e&&t!==t:r(e,t,n,o,a,s))}e.exports=a},c5a2:function(e,t,n){},c869:function(e,t,n){var r=n("0b07"),i=n("2b3e"),a=r(i,"Set");e.exports=a},cba3:function(e,t,n){"use strict";var r=n("40cd"),i=n.n(r);i.a},d02c:function(e,t,n){var r=n("5e2e"),i=n("79bc"),a=n("7b83"),o=200;function s(e,t){var n=this.__data__;if(n instanceof r){var s=n.__data__;if(!i||s.length<o-1)return s.push([e,t]),this.size=++n.size,this;n=this.__data__=new a(s)}return n.set(e,t),this.size=n.size,this}e.exports=s},d327:function(e,t){function n(){return[]}e.exports=n},e2c0:function(e,t,n){var r=n("e2e4"),i=n("d370"),a=n("6747"),o=n("c098"),s=n("b218"),c=n("f4d6");function u(e,t,n){t=r(t,e);var u=-1,l=t.length,d=!1;while(++u<l){var f=c(t[u]);if(!(d=null!=e&&n(e,f)))break;e=e[f]}return d||++u!=l?d:(l=null==e?0:e.length,!!l&&s(l)&&o(f,l)&&(a(e)||i(e)))}e.exports=u},e3f8:function(e,t,n){var r=n("656b");function i(e){return function(t){return r(t,e)}}e.exports=i},e8a4:function(e,t,n){},eae4:function(e,t,n){},ec69:function(e,t,n){var r=n("6fcd"),i=n("03dd"),a=n("30c9");function o(e){return a(e)?r(e):i(e)}e.exports=o},edfa:function(e,t){function n(e){var t=-1,n=Array(e.size);return e.forEach((function(e,r){n[++t]=[r,e]})),n}e.exports=n},ef5d:function(e,t){function n(e){return function(t){return null==t?void 0:t[e]}}e.exports=n},efb6:function(e,t,n){var r=n("5e2e");function i(){this.__data__=new r,this.size=0}e.exports=i},f9ce:function(e,t,n){var r=n("ef5d"),i=n("e3f8"),a=n("f608"),o=n("f4d6");function s(e){return a(e)?r(o(e)):i(e)}e.exports=s}}]);
//# sourceMappingURL=chunk-6f965be0.e43c5e89.js.map