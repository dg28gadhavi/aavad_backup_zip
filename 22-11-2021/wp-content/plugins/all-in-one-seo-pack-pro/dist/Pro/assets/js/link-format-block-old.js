/*! ! built on Thursday, November 11th 2021, 4:03:01 pm */
!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=83)}({0:function(e,t){e.exports=window.wp.element},12:function(e,t){function n(){return e.exports=n=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n,o=arguments[t];for(n in o)Object.prototype.hasOwnProperty.call(o,n)&&(e[n]=o[n])}return e},n.apply(this,arguments)}e.exports=n},14:function(e,t,n){var o=n(31);e.exports=function(e,t){if(null==e)return{};var n,r=o(e,t);if(Object.getOwnPropertySymbols)for(var i=Object.getOwnPropertySymbols(e),s=0;s<i.length;s++)n=i[s],0<=t.indexOf(n)||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n]);return r}},15:function(e,t){e.exports=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}},16:function(e,t){function n(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}e.exports=function(e,t,o){return t&&n(e.prototype,t),o&&n(e,o),e}},17:function(e,t,n){var o=n(32);e.exports=function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&o(e,t)}},18:function(e,t,n){var o=n(33),r=n(3);e.exports=function(e,t){return!t||"object"!==o(t)&&"function"!=typeof t?r(e):t}},19:function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}},3:function(e,t){e.exports=function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}},31:function(e,t){e.exports=function(e,t){if(null==e)return{};for(var n,o={},r=Object.keys(e),i=0;i<r.length;i++)n=r[i],0<=t.indexOf(n)||(o[n]=e[n]);return o}},32:function(e,t){function n(t,o){return e.exports=n=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},n(t,o)}e.exports=n},33:function(e,t){function n(t){return"function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?e.exports=n=function(e){return typeof e}:e.exports=n=function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},n(t)}e.exports=n},6:function(e,t){e.exports=window.lodash},7:function(e,t,n){var o;!function(){"use strict";var n={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var o=arguments[t];if(o){var i=typeof o;if("string"==i||"number"==i)e.push(o);else if(Array.isArray(o)&&o.length){var s=r.apply(null,o);s&&e.push(s)}else if("object"==i)for(var a in o)n.call(o,a)&&o[a]&&e.push(a)}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(o=function(){return r}.apply(t,[]))||(e.exports=o)}()},8:function(e,t){function n(t){return e.exports=n=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},n(t)}e.exports=n},83:function(e,t,n){"use strict";n.r(t),n.d(t,"link",(function(){return Et}));var o=n(14),r=n.n(o),i=n(19),s=n.n(i),a=n(15),l=n.n(a),c=(t=n(16),n.n(t)),u=(o=n(3),n.n(o)),p=(i=n(17),n.n(i)),f=(a=n(18),n.n(a)),d=(t=n(8),n.n(t)),h=n(0),g=n(6),v=(o=n(12),n.n(o)),b=(a=(i=window.wp).url).getProtocol,y=a.isValidProtocol,m=a.getAuthority,w=a.isValidAuthority,k=a.getPath,O=a.isValidPath,S=a.getQueryString,j=a.isValidQueryString,L=a.getFragment,R=a.isValidFragment,E=(t=i.i18n).__,C=t.sprintf;function P(e){if(e){var t=e.trim();if(t){if(/^\S+:/.test(t)){if(e=b(t),!y(e))return;if(Object(g.startsWith)(e,"http")&&!/^https?:\/\/[^\/\s]/i.test(t))return;if(e=m(t),!w(e))return;if((e=k(t))&&!O(e))return;if((e=S(t))&&!j(e))return;if((e=L(t))&&!R(e))return}return!Object(g.startsWith)(t,"#")||R(t)?1:void 0}}}function x(e){var t=e.url,n=e.opensInNewWindow,o=e.noFollow,r=e.sponsored,i=e.ugc,s=e.text;e={type:"core/link",attributes:{url:t}},t=[];return n&&(s=C(E("%s (opens in a new tab)","all-in-one-seo-pack"),s),e.attributes.target="_blank",e.attributes["aria-label"]=s,t.push("noreferrer noopener")),o&&t.push("nofollow"),r&&t.push("sponsored"),i&&t.push("ugc"),0<t.length&&(e.attributes.rel=t.join(" ")),e}o=wp.element.Component;var N=(a=wp.dom).getOffsetParent,_=a.getRectangleFromRange,F=function(e){p()(n,e);var t=function(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,o=d()(e);return o=t?(n=d()(this).constructor,Reflect.construct(o,arguments,n)):o.apply(this,arguments),f()(this,o)}}(n);function n(){var e;return l()(this,n),(e=t.apply(this,arguments)).state={style:function(){var e=window.getSelection();if(0===e.rangeCount)return{};var t=(n=_(e.getRangeAt(0))).top+n.height,n=n.left+n.width/2;return(e=N(e.anchorNode))&&(t-=(e=e.getBoundingClientRect()).top,n-=e.left),{top:t,left:n}}()},e}return c()(n,[{key:"render",value:function(){var e=this.props.children,t=this.state.style;return Object(h.createElement)("div",{className:"editor-format-toolbar__selection-position",style:t},e)}}]),n}(o),T=(i=n(7),n.n(i));function W(e){return(W="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function A(e,t){var n,o=Object.keys(e);return Object.getOwnPropertySymbols&&(n=Object.getOwnPropertySymbols(e),t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,n)),o}function I(e,t){var n=e["page".concat(t?"Y":"X","Offset")];t="scroll".concat(t?"Top":"Left");return"number"==typeof n||"number"!=typeof(n=(e=e.document).documentElement[t])&&(n=e.body[t]),n}function D(e){return I(e)}function V(e){return I(e,!0)}function B(e){var t,n,o,r=(n=(r=(t=e).ownerDocument).body,o=r&&r.documentElement,t=(r=t.getBoundingClientRect()).left,r=r.top,{left:t-=o.clientLeft||n.clientLeft||0,top:r-=o.clientTop||n.clientTop||0});e=(e=e.ownerDocument).defaultView||e.parentWindow;return r.left+=D(e),r.top+=V(e),r}var M,U=new RegExp("^(".concat(/[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source,")(?!px)[a-z%]+$"),"i"),K=/^(top|right|bottom|left)$/,H="currentStyle",z="runtimeStyle",q="left";function Q(e,t){for(var n=0;n<e.length;n++)t(e[n])}function $(e){return"border-box"===M(e,"boxSizing")}"undefined"!=typeof window&&(M=window.getComputedStyle?function(e,t,n){var o="",r=e.ownerDocument;return(e=n||r.defaultView.getComputedStyle(e,null))?e.getPropertyValue(t)||e[t]:o}:function(e,t){var n,o,r,i=e[H]&&e[H][t];return U.test(i)&&!K.test(t)&&(o=(n=e.style)[q],r=e[z][q],e[z][q]=e[H][q],n[q]="fontSize"===t?"1em":i||0,i=n.pixelLeft+"px",n[q]=o,e[z][q]=r),""===i?"auto":i});var G=["margin","border","padding"];function X(e,t,n){for(var o,r,i=0,s=0;s<t.length;s++)if(o=t[s])for(r=0;r<n.length;r++){var a="border"===o?"".concat(o+n[r],"Width"):o+n[r];i+=parseFloat(M(e,a))||0}return i}function Y(e){return null!=e&&e==e.window}var J={};function Z(e,t,n){if(Y(e))return"width"===t?J.viewportWidth(e):J.viewportHeight(e);if(9===e.nodeType)return"width"===t?J.docWidth(e):J.docHeight(e);var o="width"===t?["Left","Right"]:["Top","Bottom"],r="width"===t?e.offsetWidth:e.offsetHeight,i=(M(e),$(e)),s=0;return(null==r||r<=0)&&(r=void 0,(null==(s=M(e,t))||Number(s)<0)&&(s=e.style[t]||0),s=parseFloat(s)||0),t=void 0!==r||i,r=r||s,-1===(n=void 0===n?i?1:-1:n)?t?r-X(e,["border","padding"],o):s:t?(t=2===n?-X(e,["border"],o):X(e,["margin"],o),r+(1===n?0:t)):s+X(e,G.slice(n),o)}Q(["Width","Height"],(function(e){J["doc".concat(e)]=function(t){return t=t.document,Math.max(t.documentElement["scroll".concat(e)],t.body["scroll".concat(e)],J["viewport".concat(e)](t))},J["viewport".concat(e)]=function(t){var n="client".concat(e),o=t.document,r=o.body;t=o.documentElement[n];return"CSS1Compat"===o.compatMode&&t||r&&r[n]||t}}));var ee={position:"absolute",visibility:"hidden",display:"block"};function te(e){var t,n=arguments;return 0!==e.offsetWidth?t=Z.apply(void 0,n):function(e,t,n){var o,r={},i=e.style;for(o in t)t.hasOwnProperty(o)&&(r[o]=i[o],i[o]=t[o]);for(o in n.call(e),t)t.hasOwnProperty(o)&&(i[o]=r[o])}(e,ee,(function(){t=Z.apply(void 0,n)})),t}function ne(e,t,n){var o;n=n;if("object"!==W(t))return void 0!==n?("number"==typeof n&&(n+="px"),void(e.style[t]=n)):M(e,t);for(o in t)t.hasOwnProperty(o)&&ne(e,o,t[o])}Q(["width","height"],(function(e){var t=e.charAt(0).toUpperCase()+e.slice(1);J["outer".concat(t)]=function(t,n){return t&&te(t,e,n?0:1)};var n="width"===e?["Left","Right"]:["Top","Bottom"];J[e]=function(t,o){return void 0===o?t&&te(t,e,-1):t?(M(t),$(t)&&(o+=X(t,["padding","border"],n)),ne(t,e,o)):void 0}}));var oe=function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?A(n,!0).forEach((function(t){var o,r;o=e,t=n[r=t],r in o?Object.defineProperty(o,r,{value:t,enumerable:!0,configurable:!0,writable:!0}):o[r]=t})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):A(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({getWindow:function(e){return(e=e.ownerDocument||e).defaultView||e.parentWindow},offset:function(e,t){if(void 0===t)return B(e);!function(e,t){"static"===ne(e,"position")&&(e.style.position="relative");var n,o,r=B(e),i={};for(o in t)t.hasOwnProperty(o)&&(n=parseFloat(ne(e,o))||0,i[o]=n+t[o]-r[o]);ne(e,i)}(e,t)},isWindow:Y,each:Q,css:ne,clone:function(e){var t,n={};for(t in e)e.hasOwnProperty(t)&&(n[t]=e[t]);if(e.overflow)for(var o in e)e.hasOwnProperty(o)&&(n.overflow[o]=e.overflow[o]);return n},scrollLeft:function(e,t){if(Y(e)){if(void 0===t)return D(e);window.scrollTo(t,V(e))}else{if(void 0===t)return e.scrollLeft;e.scrollLeft=t}},scrollTop:function(e,t){if(Y(e)){if(void 0===t)return V(e);window.scrollTo(D(e),t)}else{if(void 0===t)return e.scrollTop;e.scrollTop=t}},viewportWidth:0,viewportHeight:0},J);function re(e){return e.stopPropagation()}var ie=(a=(t=window.wp).i18n).__,se=a.sprintf,ae=a._n,le=(n=(o=t.element).Component,o.createRef),ce=t.htmlEntities.decodeEntities,ue=(i=t.keycodes).UP,pe=i.DOWN,fe=i.ENTER,de=i.TAB,he=(a=t.components).Spinner,ge=(o=a.withSpokenMessages,a.Popover),ve=(i=t.compose.withInstanceId,t.apiFetch),be=t.url.addQueryArgs,ye=o(i(function(e){p()(n,e);var t=function(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,o=d()(e);return o=t?(n=d()(this).constructor,Reflect.construct(o,arguments,n)):o.apply(this,arguments),f()(this,o)}}(n);function n(e){var o=e.autocompleteRef;return l()(this,n),(e=t.apply(this,arguments)).onChange=e.onChange.bind(u()(e)),e.onKeyDown=e.onKeyDown.bind(u()(e)),e.autocompleteRef=o||le(),e.inputRef=le(),e.updateSuggestions=Object(g.throttle)(e.updateSuggestions.bind(u()(e)),200),e.suggestionNodes=[],e.state={posts:[],showSuggestions:!1,selectedSuggestion:null},e}return c()(n,[{key:"componentDidUpdate",value:function(){var e=this,t=(n=this.state).showSuggestions,n=n.selectedSuggestion;t&&null!==n&&!this.scrollingIntoView&&(this.scrollingIntoView=!0,function(e,t,n){n=n||{},9===t.nodeType&&(t=oe.getWindow(t));var o,r,i,s,a,l,c=n.allowHorizontalScroll,u=n.onlyScrollIfNeeded,p=n.alignWithTop,f=n.alignWithLeft,d=n.offsetTop||0,h=n.offsetLeft||0,g=n.offsetBottom||0,v=n.offsetRight||0,b=(c=void 0===c||c,oe.isWindow(t)),y=oe.offset(e);n=oe.outerHeight(e),e=oe.outerWidth(e);b?(i=t,l=oe.height(i),a=oe.width(i),s={left:oe.scrollLeft(i),top:oe.scrollTop(i)},o={left:y.left-s.left-h,top:y.top-s.top-d},r={left:y.left+e-(s.left+a)+v,top:y.top+n-(s.top+l)+g},i=s):(a=oe.offset(t),l=t.clientHeight,s=t.clientWidth,i={left:t.scrollLeft,top:t.scrollTop},o={left:y.left-(a.left+(parseFloat(oe.css(t,"borderLeftWidth"))||0))-h,top:y.top-(a.top+(parseFloat(oe.css(t,"borderTopWidth"))||0))-d},r={left:y.left+e-(a.left+s+(parseFloat(oe.css(t,"borderRightWidth"))||0))+v,top:y.top+n-(a.top+l+(parseFloat(oe.css(t,"borderBottomWidth"))||0))+g}),o.top<0||0<r.top?!0===p||!1!==p&&o.top<0?oe.scrollTop(t,i.top+o.top):oe.scrollTop(t,i.top+r.top):u||((p=void 0===p||!!p)?oe.scrollTop(t,i.top+o.top):oe.scrollTop(t,i.top+r.top)),c&&(o.left<0||0<r.left?!0===f||!1!==f&&o.left<0?oe.scrollLeft(t,i.left+o.left):oe.scrollLeft(t,i.left+r.left):u||((f=void 0===f||!!f)?oe.scrollLeft(t,i.left+o.left):oe.scrollLeft(t,i.left+r.left)))}(this.suggestionNodes[n],this.autocompleteRef.current,{onlyScrollIfNeeded:!0}),setTimeout((function(){e.scrollingIntoView=!1}),100))}},{key:"componentWillUnmount",value:function(){delete this.suggestionsRequest}},{key:"bindSuggestionNode",value:function(e){var t=this;return function(n){t.suggestionNodes[e]=n}}},{key:"updateSuggestions",value:function(e){var t,n=this;e.length<2||/^https?:/.test(e)?this.setState({showSuggestions:!1,selectedSuggestion:null,loading:!1}):(this.setState({showSuggestions:!0,selectedSuggestion:null,loading:!0}),(t=ve({path:be("/wp/v2/search",{search:e,per_page:20,type:"post"})})).then((function(e){n.suggestionsRequest===t&&(n.setState({posts:e,loading:!1}),e.length?n.props.debouncedSpeak(se(ae("%d result found, use up and down arrow keys to navigate.","%d results found, use up and down arrow keys to navigate.",e.length),e.length),"assertive"):n.props.debouncedSpeak(ie("No results.","all-in-one-seo-pack"),"assertive"))})).catch((function(){n.suggestionsRequest===t&&n.setState({loading:!1})})),this.suggestionsRequest=t)}},{key:"onChange",value:function(e){e=e.target.value,this.props.onChange(e),this.updateSuggestions(e)}},{key:"onKeyDown",value:function(e){var t=(r=this.state).showSuggestions,n=r.selectedSuggestion,o=r.posts,r=r.loading;if(t&&o.length&&!r){var i=this.state.posts[this.state.selectedSuggestion];switch(e.keyCode){case ue:e.stopPropagation(),e.preventDefault();var s=n?n-1:o.length-1;this.setState({selectedSuggestion:s});break;case pe:e.stopPropagation(),e.preventDefault(),s=null===n||n===o.length-1?0:n+1,this.setState({selectedSuggestion:s});break;case de:null!==this.state.selectedSuggestion&&(this.selectLink(i),this.props.speak(ie("Link selected.","all-in-one-seo-pack")));break;case fe:null!==this.state.selectedSuggestion&&(e.stopPropagation(),this.selectLink(i))}}else switch(e.keyCode){case ue:0!==e.target.selectionStart&&(e.stopPropagation(),e.preventDefault(),e.target.setSelectionRange(0,0));break;case pe:this.props.value.length!==e.target.selectionStart&&(e.stopPropagation(),e.preventDefault(),e.target.setSelectionRange(this.props.value.length,this.props.value.length))}}},{key:"selectLink",value:function(e){this.props.onChange(e.url,e),this.setState({selectedSuggestion:null,showSuggestions:!1})}},{key:"handleOnClick",value:function(e){this.selectLink(e),this.inputRef.current.focus()}},{key:"render",value:function(){var e=this,t=void 0===(l=(s=this.props).value)?"":l,n=void 0===(i=s.autoFocus)||i,o=s.instanceId,r=s.className,i=(l=this.state).showSuggestions,s=l.posts,a=l.selectedSuggestion,l=l.loading;return Object(h.createElement)("div",{className:T()("editor-url-input block-editor-url-input",r)},Object(h.createElement)("input",{autoFocus:n,type:"text","aria-label":ie("URL","all-in-one-seo-pack"),required:!0,value:t,onChange:this.onChange,onInput:re,placeholder:ie("Paste URL or type to search","all-in-one-seo-pack"),onKeyDown:this.onKeyDown,role:"combobox","aria-expanded":i,"aria-autocomplete":"list","aria-owns":"editor-url-input-suggestions-".concat(o),"aria-activedescendant":null!==a?"editor-url-input-suggestion-".concat(o,"-").concat(a):void 0,ref:this.inputRef}),l&&Object(h.createElement)(he,null),i&&!!s.length&&Object(h.createElement)(ge,{position:"bottom",noArrow:!0,focusOnMount:!1},Object(h.createElement)("div",{className:T()("editor-url-input__suggestions","block-editor-url-input__suggestions","".concat(r,"__suggestions")),id:"editor-url-input-suggestions-".concat(o),ref:this.autocompleteRef,role:"listbox"},s.map((function(t,n){return Object(h.createElement)("button",{key:t.id,role:"option",tabIndex:"-1",id:"editor-url-input-suggestion-".concat(o,"-").concat(n),ref:e.bindSuggestionNode(n),className:T()("editor-url-input__suggestion block-editor-url-input__suggestion",{"is-selected":n===a}),onClick:function(){return e.handleOnClick(t)},"aria-selected":n===a},ce(t.title)||ie("(no title)","all-in-one-seo-pack"))})))))}}]),n}(n))),me=["autocompleteRef","className","onChangeInputValue","value"],we=(a=window.wp).i18n.__,ke=a.components.IconButton;function Oe(e){var t=e.autocompleteRef,n=e.className,o=e.onChangeInputValue,i=e.value;e=r()(e,me);return Object(h.createElement)("form",v()({className:T()("block-editor-url-popover__link-editor",n)},e),Object(h.createElement)(ye,{value:i,onChange:o,autocompleteRef:t}),Object(h.createElement)(ke,{icon:"editor-break",label:we("Apply","all-in-one-seo-pack"),type:"submit"}))}var Se=["className","linkClassName","onEditLinkClick","url","urlLabel"],je=(t=window.wp).i18n.__,Le=(o=t.components).ExternalLink,Re=o.IconButton,Ee=(i=t.url).safeDecodeURI,Ce=i.filterURLForDisplay;function Pe(e){var t=e.url,n=e.urlLabel;e=e.className,e=T()(e,"block-editor-url-popover__link-viewer-url");return t?Object(h.createElement)(Le,{className:e,href:t},n||Ce(Ee(t))):Object(h.createElement)("span",{className:e})}function xe(e){var t=e.className,n=e.linkClassName,o=e.onEditLinkClick,i=e.url,s=e.urlLabel;e=r()(e,Se);return Object(h.createElement)("div",v()({className:T()("block-editor-url-popover__link-viewer",t)},e),Object(h.createElement)(Pe,{url:i,urlLabel:s,className:n}),o&&Object(h.createElement)(Re,{icon:"edit",label:je("Edit","all-in-one-seo-pack"),onClick:o}))}var Ne=["isActive","addingLink","value","resetOnMount"];function _e(e){return e.stopPropagation()}var Fe=(n=window.wp).i18n.__,Te=(o=(a=n.element).Component,a.createRef),We=a.useMemo,Ae=a.Fragment,Ie=(t=n.components).ToggleControl,De=(i=t.withSpokenMessages,(a=n.keycodes).LEFT),Ve=a.RIGHT,Be=a.UP,Me=a.DOWN,Ue=a.BACKSPACE,Ke=a.ENTER,He=a.ESCAPE,ze=n.dom.getRectangleFromRange,qe=n.url.prependHTTP,Qe=(t=n.richText).create,$e=t.insert,Ge=t.isCollapsed,Xe=t.applyFormat,Ye=t.getTextContent,Je=t.slice,Ze=n.blockEditor.URLPopover;function et(e,t){return e.addingLink||t.editLink}function tt(e){var t=e.isActive,n=e.addingLink,o=e.value,i=e.resetOnMount;e=r()(e,Ne);return(o=We((function(){var e;if(e=0<(e=window.getSelection()).rangeCount?e.getRangeAt(0):null){if(n)return ze(e);for(var t=(t=e.startContainer).nextElementSibling||t;t.nodeType!==window.Node.ELEMENT_NODE;)t=t.parentNode;return(e=t.closest("a"))?e.getBoundingClientRect():void 0}}),[t,n,o.start,o.end]))?(i(o),Object(h.createElement)(Ze,v()({anchorRect:o},e))):null}var nt=i(function(e){p()(n,e);var t=function(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,o=d()(e);return o=t?(n=d()(this).constructor,Reflect.construct(o,arguments,n)):o.apply(this,arguments),f()(this,o)}}(n);function n(){var e;return l()(this,n),(e=t.apply(this,arguments)).editLink=e.editLink.bind(u()(e)),e.submitLink=e.submitLink.bind(u()(e)),e.onKeyDown=e.onKeyDown.bind(u()(e)),e.onChangeInputValue=e.onChangeInputValue.bind(u()(e)),e.setLinkTarget=e.setLinkTarget.bind(u()(e)),e.setNoFollow=e.setNoFollow.bind(u()(e)),e.setSponsored=e.setSponsored.bind(u()(e)),e.setUgc=e.setUgc.bind(u()(e)),e.onFocusOutside=e.onFocusOutside.bind(u()(e)),e.resetState=e.resetState.bind(u()(e)),e.autocompleteRef=Te(),e.resetOnMount=e.resetOnMount.bind(u()(e)),e.state={opensInNewWindow:!1,noFollow:!1,sponsored:!1,ugc:!1,inputValue:"",anchorRect:!1},e}return c()(n,[{key:"onKeyDown",value:function(e){-1<[De,Me,Ve,Be,Ue,Ke].indexOf(e.keyCode)&&e.stopPropagation(),-1<[He].indexOf(e.keyCode)&&this.resetState()}},{key:"onChangeInputValue",value:function(e){this.setState({inputValue:e})}},{key:"setLinkTarget",value:function(e){var t=this.props,n=void 0===(r=t.activeAttributes.url)?"":r,o=t.value,r=t.onChange;this.setState({opensInNewWindow:e}),et(this.props,this.state)||(t=Ye(Je(o)),r(Xe(o,x({url:n,opensInNewWindow:e,noFollow:this.state.noFollow,sponsored:this.state.sponsored,ugc:this.state.ugc,text:t}))))}},{key:"setNoFollow",value:function(e){var t=this.props,n=void 0===(r=t.activeAttributes.url)?"":r,o=t.value,r=t.onChange;this.setState({noFollow:e}),et(this.props,this.state)||(t=Ye(Je(o)),r(Xe(o,x({url:n,opensInNewWindow:this.state.opensInNewWindow,noFollow:e,sponsored:this.state.sponsored,ugc:this.state.ugc,text:t}))))}},{key:"setSponsored",value:function(e){var t=this.props,n=void 0===(r=t.activeAttributes.url)?"":r,o=t.value,r=t.onChange;this.setState({sponsored:e}),et(this.props,this.state)||(t=Ye(Je(o)),r(Xe(o,x({url:n,opensInNewWindow:this.state.opensInNewWindow,noFollow:this.state.noFollow,sponsored:e,ugc:this.state.ugc,text:t}))))}},{key:"setUgc",value:function(e){var t=this.props,n=void 0===(r=t.activeAttributes.url)?"":r,o=t.value,r=t.onChange;this.setState({ugc:e}),et(this.props,this.state)||(t=Ye(Je(o)),r(Xe(o,x({url:n,opensInNewWindow:this.state.opensInNewWindow,noFollow:this.state.noFollow,sponsored:this.state.sponsored,ugc:e,text:t}))))}},{key:"editLink",value:function(e){this.setState({editLink:!0}),e.preventDefault()}},{key:"submitLink",value:function(e){var t=(l=this.props).isActive,n=l.value,o=l.onChange,r=l.speak,i=(c=this.state).inputValue,s=c.opensInNewWindow,a=c.noFollow,l=c.sponsored,c=c.ugc;c=x({url:i=qe(i),opensInNewWindow:s,noFollow:a,sponsored:l,ugc:c,text:Ye(Je(n))});e.preventDefault(),Ge(n)&&!t?(e=Xe(Qe({text:i}),c,0,i.length),o($e(n,e))):o(Xe(n,c)),this.resetState(),P(i)?r(Fe(t?"Link edited.":"Link inserted.","all-in-one-seo-pack"),"assertive"):r(Fe("Warning: the link has been inserted but could have errors. Please test it.","all-in-one-seo-pack"),"assertive")}},{key:"onFocusOutside",value:function(){var e=this.autocompleteRef.current;e&&e.contains(event.target)||this.resetState()}},{key:"resetState",value:function(){this.props.stopAddingLink(),this.setState({editLink:!1})}},{key:"resetOnMount",value:function(e){this.state.anchorRect!==e&&this.setState({opensInNewWindow:!1,noFollow:!1,sponsored:!1,ugc:!1,anchorRect:e})}},{key:"render",value:function(){var e=this,t=(u=this.props).isActive,n=u.activeAttributes.url,o=u.addingLink,r=u.value;if(!t&&!o)return null;var i=(u=this.state).inputValue,s=u.opensInNewWindow,a=u.noFollow,l=u.sponsored,c=u.ugc,u=et(this.props,this.state);return Object(h.createElement)(F,{key:"".concat(r.start).concat(r.end)},Object(h.createElement)(tt,{resetOnMount:this.resetOnMount,value:r,isActive:t,addingLink:o,onFocusOutside:this.onFocusOutside,onClose:function(){i||e.resetState()},focusOnMount:!!u&&"firstElement",renderSettings:function(){return Object(h.createElement)(Ae,null,Object(h.createElement)(Ie,{label:Fe("Open in New Tab","all-in-one-seo-pack"),checked:s,onChange:e.setLinkTarget}),Object(h.createElement)(Ie,{label:Fe('Add "nofollow" to link',"all-in-one-seo-pack"),checked:a,onChange:e.setNoFollow}),Object(h.createElement)(Ie,{label:Fe('Add "sponsored" to link',"all-in-one-seo-pack"),checked:l,onChange:e.setSponsored}),Object(h.createElement)(Ie,{label:Fe('Add "ugc" to link',"all-in-one-seo-pack"),checked:c,onChange:e.setUgc}))}},u?Object(h.createElement)(Oe,{className:"editor-format-toolbar__link-container-content block-editor-format-toolbar__link-container-content",value:i,onChangeInputValue:this.onChangeInputValue,onKeyDown:this.onKeyDown,onKeyPress:_e,onSubmit:this.submitLink,autocompleteRef:this.autocompleteRef}):Object(h.createElement)(xe,{className:"editor-format-toolbar__link-container-content block-editor-format-toolbar__link-container-content",onKeyPress:_e,url:n,onEditLinkClick:this.editLink,linkClassName:P(qe(n))?void 0:"has-invalid-link"})))}}],[{key:"getDerivedStateFromProps",value:function(e,t){var n=(i=e.activeAttributes).url,o=i.target,r=i.rel,i="_blank"===o;o={};return et(e,t)||(n!==t.inputValue&&(o.inputValue=n),i!==t.opensInNewWindow&&(o.opensInNewWindow=i),"string"==typeof r&&(n=r.split(" ").includes("nofollow"),i=r.split(" ").includes("sponsored"),r=r.split(" ").includes("ugc"),n!==t.noFollow&&(o.noFollow=n),i!==t.sponsored&&(o.sponsored=i),r!==t.ugc&&(o.ugc=r))),o}}]),n}(o));function ot(e,t){var n,o=Object.keys(e);return Object.getOwnPropertySymbols&&(n=Object.getOwnPropertySymbols(e),t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,n)),o}var rt=(a=window.wp).i18n.__,it=(n=(t=a.element).Component,t.Fragment),st=(i=a.data).select,at=(o=i.withSelect,(t=a.blockEditor).BlockControls),lt=t.RichTextToolbarButton,ct=t.RichTextShortcut,ut=(i=a.richText).getTextContent,pt=i.applyFormat,ft=i.removeFormat,dt=i.slice,ht=a.url.isURL,gt=(t=a.components).Toolbar,vt=(i=t.withSpokenMessages,a=(t=a.compose).compose,t=t.ifCondition,"core/link"),bt=rt("Add Link","all-in-one-seo-pack"),yt=/^(mailto:)?[a-z0-9._%+-]+@[a-z0-9][a-z0-9.-]*\.[a-z]{2,63}$/i,mt=(n=function(e){p()(n,e);var t=function(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,o=d()(e);return o=t?(n=d()(this).constructor,Reflect.construct(o,arguments,n)):o.apply(this,arguments),f()(this,o)}}(n);function n(){var e;return l()(this,n),(e=t.apply(this,arguments)).isEmail=e.isEmail.bind(u()(e)),e.addLink=e.addLink.bind(u()(e)),e.stopAddingLink=e.stopAddingLink.bind(u()(e)),e.onRemoveFormat=e.onRemoveFormat.bind(u()(e)),e.state={addingLink:!1},e}return c()(n,[{key:"isEmail",value:function(e){return yt.test(e)}},{key:"addLink",value:function(){var e,t=(e=this.props).value,n=e.onChange;(e=ut(dt(t)))&&ht(e)?n(pt(t,{type:vt,attributes:{url:e}})):e&&this.isEmail(e)?n(pt(t,{type:vt,attributes:{url:"mailto:".concat(e)}})):this.setState({addingLink:!0})}},{key:"stopAddingLink",value:function(){this.setState({addingLink:!1})}},{key:"onRemoveFormat",value:function(){var e=(n=this.props).value,t=n.onChange,n=n.speak,o=e;Object(g.map)(["core/link"],(function(e){o=ft(o,e)})),t(function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?ot(Object(n),!0).forEach((function(t){s()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):ot(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({},o)),n(rt("Link removed.","all-in-one-seo-pack"),"assertive")}},{key:"render",value:function(){var e=(n=this.props).activeAttributes,t=n.onChange,n=(o=this.props).isActive,o=o.value;return Object(h.createElement)(it,null,Object(h.createElement)(at,null,Object(h.createElement)(gt,{className:"editorskit-components-toolbar"},Object(h.createElement)(ct,{type:"primary",character:"k",onUse:this.addLink}),Object(h.createElement)(ct,{type:"primaryShift",character:"k",onUse:this.onRemoveFormat}),n&&Object(h.createElement)(lt,{name:"link",icon:"editor-unlink",title:rt("Unlink","all-in-one-seo-pack"),onClick:this.onRemoveFormat,isActive:n,shortcutType:"primaryShift",shortcutCharacter:"k"}),!n&&Object(h.createElement)(lt,{name:"link",icon:"admin-links",title:bt,onClick:this.addLink,isActive:n,shortcutType:"primary",shortcutCharacter:"k"}),Object(h.createElement)(nt,{addingLink:this.state.addingLink,stopAddingLink:this.stopAddingLink,isActive:n,activeAttributes:e,value:o,onChange:t}))))}}]),n}(n),t=a(o((function(){return{isDisabled:st("core/edit-post").isFeatureActive("disableEditorsKitLinkFormats")}})),t((function(e){return!e.isDisabled})),i)(n),["name"]),wt=(i=wp.i18n.__,(n=wp.richText).registerFormatType),kt=n.unregisterFormatType,Ot=n.applyFormat,St=n.isCollapsed,jt=wp.htmlEntities.decodeEntities,Lt=wp.url.isURL,Rt="core/link",Et={name:Rt,title:i("Link","all-in-one-seo-pack"),tagName:"a",className:null,attributes:{url:"href",target:"target",rel:"rel"},__unstablePasteRule:function(e,t){var n=t.html;t=t.plainText;return St(e)?e:(t=(n||t).replace(/<[^>]+>/g,"").trim(),Lt(t)?Ot(e,{type:Rt,attributes:{url:jt(t)}}):e)},edit:t};[Et].forEach((function(e){var t=e.name;e=r()(e,mt);t&&(kt("core/link"),wt(t,e))}))}});