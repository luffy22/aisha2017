/* jce - 2.6.11 | 2017-04-12 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2017 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(tinymce){var Dispatcher=tinymce.util.Dispatcher,Storage=window.localStorage;Storage&&(tinymce._beforeUnloadHandler=function(){var msg;return tinymce.each(tinymce.editors,function(editor){editor.plugins.autosave&&editor.plugins.autosave.storeDraft(),!msg&&editor.isDirty()&&editor.getParam("autosave_ask_before_unload",!0)&&(msg=editor.translate("You have unsaved changes are you sure you want to navigate away?"))}),msg},tinymce.create("tinymce.plugins.AutosavePlugin",{init:function(ed){function parseTime(time,defaultTime){var multipels={s:1e3,m:6e4};return time=/^(\d+)([ms]?)$/.exec(""+(time||defaultTime)),(time[2]?multipels[time[2]]:1)*parseInt(time,10)}function hasDraft(){var time=parseInt(Storage.getItem(prefix+"time"),10)||0;return!((new Date).getTime()-time>settings.autosave_retention)||(removeDraft(!1),!1)}function removeDraft(fire){var content=Storage.getItem(prefix+"draft");Storage.removeItem(prefix+"draft"),Storage.removeItem(prefix+"time"),fire!==!1&&content&&self.onRemoveDraft.dispatch(self,{content:content})}function storeDraft(){if(!isEmpty()&&ed.isDirty()){var content=ed.getContent({format:"raw",no_events:!0}),expires=(new Date).getTime();Storage.setItem(prefix+"draft",content),Storage.setItem(prefix+"time",expires),self.onStoreDraft.dispatch(self,{expires:expires,content:content})}}function restoreDraft(){if(hasDraft()){var content=Storage.getItem(prefix+"draft");ed.setContent(content,{format:"raw"}),self.onRestoreDraft.dispatch(self,{content:content})}}function startStoreDraft(){started||(setInterval(function(){ed.removed||storeDraft()},settings.autosave_interval),started=!0)}function restoreLastDraft(){ed.undoManager.beforeChange(),restoreDraft(),removeDraft(),ed.undoManager.add(),ed.nodeChanged()}function isEmpty(html){var forcedRootBlockName=ed.settings.forced_root_block;return html=tinymce.trim("undefined"==typeof html?ed.getBody().innerHTML:html),""===html||new RegExp("^<"+forcedRootBlockName+"[^>]*>(( |&nbsp;|[ \t]|<br[^>]*>)+?|)</"+forcedRootBlockName+">|<br>$","i").test(html)}var prefix,started,self=this,settings=ed.settings;self.onStoreDraft=new Dispatcher(self),self.onRestoreDraft=new Dispatcher(self),self.onRemoveDraft=new Dispatcher(self),prefix=settings.autosave_prefix||"tinymce-autosave-{path}{query}-{id}-",prefix=prefix.replace(/\{path\}/g,document.location.pathname),prefix=prefix.replace(/\{query\}/g,document.location.search),prefix=prefix.replace(/\{id\}/g,ed.id),settings.autosave_interval=parseTime(settings.autosave_interval,"30s"),settings.autosave_retention=parseTime(settings.autosave_retention,"20m"),ed.addButton("autosave",{title:"autosave.restore_content",onclick:restoreLastDraft}),ed.onNodeChange.add(function(){var controlManager=ed.controlManager;controlManager.get("autosave")&&controlManager.setDisabled("autosave",!hasDraft())}),ed.onInit.add(function(){ed.controlManager.get("autosave")&&startStoreDraft()}),ed.settings.autosave_restore_when_empty!==!1&&(ed.onInit.add(function(){hasDraft()&&isEmpty()&&restoreDraft()}),ed.onSaveContent.add(function(){removeDraft()})),self.storeDraft=storeDraft,window.onbeforeunload=tinymce._beforeUnloadHandler}}),tinymce.PluginManager.add("autosave",tinymce.plugins.AutosavePlugin))}(tinymce);