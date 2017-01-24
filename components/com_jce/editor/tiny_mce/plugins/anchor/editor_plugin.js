/* jce - 2.6.7.1 | 2017-01-18 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2017 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){var DOM=tinymce.DOM,each=(tinymce.dom.Event,tinymce.is,tinymce.each),VK=(tinymce.html.Node,tinymce.VK);VK.BACKSPACE,VK.DELETE;tinymce.create("tinymce.plugins.AnchorPlugin",{init:function(ed,url){function isAnchor(n){return ed.dom.getParent(n,"a.mceItemAnchor")}this.editor=ed,this.url=url;var self=this;ed.settings.allow_html_in_named_anchor=!0,ed.addCommand("mceInsertAnchor",function(ui,value){return self._insertAnchor(value)}),ed.onNodeChange.add(function(ed,cm,n,co){var s=isAnchor(n);ed.dom.removeClass(ed.dom.select(".mceItemAnchor.mceItemSelected"),"mceItemSelected"),cm.setActive("anchor",s),s&&ed.dom.addClass(ed.dom.select(".mceItemAnchor"),"mceItemSelected")}),ed.onKeyDown.add(function(ed,e){e.keyCode!==VK.BACKSPACE&&e.keyCode!==VK.DELETE||self._removeAnchor(e)}),ed.onInit.add(function(){ed.theme&&ed.theme.onResolveName&&ed.theme.onResolveName.add(function(theme,o){var v,n=o.node,href=n.href;"a"!==o.name||href&&"#"!=href.charAt(0)||!n.name&&!n.id||(v=n.name||n.id),v&&(o.name="a#"+v)}),ed.settings.compress.css||ed.dom.loadCSS(url+"/css/content.css")}),ed.onPreInit.add(function(){ed.parser.addNodeFilter("a",function(nodes){for(var i=0,len=nodes.length;i<len;i++){var node=nodes[i],href=node.attr("href"),cls=node.attr("class")||"",name=node.attr("name")||node.attr("id");href&&"#"!=href.charAt(0)||!name||cls&&/mceItemAnchor/.test(cls)!==!1||(cls+=" mceItemAnchor",node.attr("class",tinymce.trim(cls)))}})}),ed.onBeforeSetContent.add(function(ed,o){o.content=o.content.replace(/<a id="([^"]+)"><\/a>/gi,'<a id="$1">\ufeff</a>')})},_removeAnchor:function(e){var ed=this.editor,s=ed.selection,n=s.getNode();!s.isCollapsed()&&ed.dom.getParent(n,"a.mceItemAnchor")&&(ed.undoManager.add(),ed.formatter.remove("link"),e&&e.preventDefault())},_getAnchor:function(){var v,ed=this.editor,n=ed.selection.getNode();return n=ed.dom.getParent(n,"a.mceItemAnchor"),v=ed.dom.getAttrib(n,"name")||ed.dom.getAttrib(n,"id")},_insertAnchor:function(v){var attrib,ed=this.editor;if(!v)return ed.windowManager.alert("anchor.invalid"),!1;if(!/^[a-z][a-z0-9\-\_:\.]*$/i.test(v))return ed.windowManager.alert("anchor.invalid"),!1;attrib="name","html4"!==ed.settings.schema&&(attrib="id");var n=ed.selection.getNode(),at={class:"mceItemAnchor"};if(n=ed.dom.getParent(n,"A"))at[attrib]=v,ed.dom.setAttribs(n,at);else{if(ed.dom.select("a["+attrib+'="'+v+'"], img[data-mce-name="'+v+'"], img[id="'+v+'"]',ed.getBody()).length)return ed.windowManager.alert("anchor.exists"),!1;ed.selection.isCollapsed()?(at[attrib]=v,ed.execCommand("mceInsertContent",0,ed.dom.createHTML("a",{id:"__mce_tmp"},"\ufeff")),n=ed.dom.get("__mce_tmp"),at.id=at.id||null,ed.dom.setAttribs(n,at),ed.selection.select(n)):(at[attrib]=v,ed.execCommand("mceInsertLink",!1,"#mce_temp_url#",{skip_undo:1}),at.href=at["data-mce-href"]=null,each(ed.dom.select('a[href="#mce_temp_url#"]'),function(link){ed.dom.setAttribs(link,at)}))}return ed.execCommand("mceEndUndoLevel"),ed.nodeChanged(),!0},createControl:function(n,cm){var self=this,ed=this.editor;switch(n){case"anchor":var content=DOM.create("div");DOM.add(content,"h4",{},ed.getLang("anchor.desc","Insert / Edit Anchor"));var input=DOM.add(content,"input",{type:"text",id:ed.id+"_input_anchor"}),c=new tinymce.ui.ButtonDialog(cm.prefix+"anchor",{title:ed.getLang("anchor.desc","Inserts an Anchor"),class:"mce_anchor",content:content.innerHTML,width:250,buttons:[{title:ed.getLang("insert","Insert"),id:"insert",click:function(e){return input=DOM.get(ed.id+"_input_anchor"),self._insertAnchor(input.value)},classes:"mceDialogButtonPrimary",scope:self},{title:ed.getLang("anchor.remove","Remove"),id:"remove",click:function(e){return DOM.hasClass(e.target,"disabled")||self._removeAnchor(),!0},scope:self}]},ed);return c.onShowDialog.add(function(){input=DOM.get(ed.id+"_input_anchor"),input.value="";var label=ed.getLang("insert","Insert"),v=self._getAnchor();v&&(input.value=v,label=ed.getLang("update","Update")),c.setActive(!!v),c.setButtonDisabled("remove",!v),c.setButtonLabel("insert",label),input.focus()}),c.onHideDialog.add(function(){input.value=""}),ed.onRemove.add(function(){c.destroy()}),cm.add(c)}return null}}),tinymce.PluginManager.add("anchor",tinymce.plugins.AnchorPlugin)}();