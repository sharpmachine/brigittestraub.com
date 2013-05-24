com={
	tabClass:'com', // class to trigger tabbing
	listClass:'tabs', // class of the menus
	activeClass:'active', // class of current link
	contentElements:'div', // elements to loop through
	backToLinks:/#top/, // pattern to check "back to top" links
	printID:'domtabprintview', // id of the print all link
	showAllLinkText:'show all content', // text for the print all link
	prevNextIndicator:'doprevnext', // class to trigger prev and next links
	prevNextClass:'prevnext', // class of the prev and next list
	prevLabel:'previous', // HTML content of the prev link
	nextLabel:'next', // HTML content of the next link
	prevClass:'prev', // class for the prev link
	nextClass:'next', // class for the next link
	init:function(){
		var temp;
		if(!document.getElementById || !document.createTextNode){return;}
		var tempelm=document.getElementsByTagName('div');		
		for(var i=0;i<tempelm.length;i++){
			if(!com.cssjs('check',tempelm[i],com.tabClass)){continue;}
			com.initTabMenu(tempelm[i]);
			com.removeBackLinks(tempelm[i]);
			if(com.cssjs('check',tempelm[i],com.prevNextIndicator)){
				com.addPrevNext(tempelm[i]);
			}
			com.checkURL();
		}
		if(document.getElementById(com.printID) 
		   && !document.getElementById(com.printID).getElementsByTagName('a')[0]){
			var newlink=document.createElement('a');
			newlink.setAttribute('href','#');
			com.addEvent(newlink,'click',com.showAll,false);
			newlink.onclick=function(){return false;} // safari hack
			newlink.appendChild(document.createTextNode(com.showAllLinkText));
			document.getElementById(com.printID).appendChild(newlink);
		}
	},
	checkURL:function(){
		var id;
		var loc=window.location.toString();
		loc=/#/.test(loc)?loc.match(/#(\w.+)/)[1]:'';
		if(loc==''){return;}
		var elm=document.getElementById(loc);
		if(!elm){return;}
		var parentMenu=elm.parentNode.parentNode.parentNode;
		parentMenu.currentSection=loc;
		parentMenu.getElementsByTagName(com.contentElements)[0].style.display='none';
		com.cssjs('remove',parentMenu.getElementsByTagName('a')[0].parentNode,com.activeClass);
		var links=parentMenu.getElementsByTagName('a');
		for(i=0;i<links.length;i++){
			if(!links[i].getAttribute('href')){continue;}
			if(!/#/.test(links[i].getAttribute('href').toString())){continue;}
			id=links[i].href.match(/#(\w.+)/)[1];
			if(id==loc){
				var cur=links[i].parentNode.parentNode;
				com.cssjs('add',links[i].parentNode,com.activeClass);
				break;
			}
		}
		com.changeTab(elm,1);
		elm.focus();
		cur.currentLink=links[i];
		cur.currentSection=loc;
	},
	showAll:function(e){
		document.getElementById(com.printID).parentNode.removeChild(document.getElementById(com.printID));
		var tempelm=document.getElementsByTagName('div');		
		for(var i=0;i<tempelm.length;i++){
			if(!com.cssjs('check',tempelm[i],com.tabClass)){continue;}
			var sec=tempelm[i].getElementsByTagName(com.contentElements);
			for(var j=0;j<sec.length;j++){
				sec[j].style.display='block';
			}
		}
		var tempelm=document.getElementsByTagName('ul');		
		for(i=0;i<tempelm.length;i++){
			if(!com.cssjs('check',tempelm[i],com.prevNextClass)){continue;}
			tempelm[i].parentNode.removeChild(tempelm[i]);
			i--;
		}
		com.cancelClick(e);
	},
	addPrevNext:function(menu){
		var temp;
		var sections=menu.getElementsByTagName(com.contentElements);
		for(var i=0;i<sections.length;i++){
			temp=com.createPrevNext();
			if(i==0){
				temp.removeChild(temp.getElementsByTagName('li')[0]);
			}
			if(i==sections.length-1){
				temp.removeChild(temp.getElementsByTagName('li')[1]);
			}
			temp.i=i; // h4xx0r!
			temp.menu=menu;
			sections[i].appendChild(temp);
		}
	},
	removeBackLinks:function(menu){
		var links=menu.getElementsByTagName('a');
		for(var i=0;i<links.length;i++){
			if(!com.backToLinks.test(links[i].href)){continue;}
			links[i].parentNode.removeChild(links[i]);
			i--;
		}
	},
	initTabMenu:function(menu){
		var id;
		var lists=menu.getElementsByTagName('ul');
		for(var i=0;i<lists.length;i++){
			if(com.cssjs('check',lists[i],com.listClass)){
				var thismenu=lists[i];
				break;
			}
		}
		if(!thismenu){return;}
		thismenu.currentSection='';
		thismenu.currentLink='';
		var links=thismenu.getElementsByTagName('a');
		for(i=0;i<links.length;i++){
			if(!/#/.test(links[i].getAttribute('href').toString())){continue;}
			id=links[i].href.match(/#(\w.+)/)[1];
			if(document.getElementById(id)){
				com.addEvent(links[i],'click',com.showTab,false);
				links[i].onclick=function(){return false;} // safari hack
				com.changeTab(document.getElementById(id),0);
			}
		}
		id=links[0].href.match(/#(\w.+)/)[1];
		if(document.getElementById(id)){
			com.changeTab(document.getElementById(id),1);
			thismenu.currentSection=id;
			thismenu.currentLink=links[0];
			com.cssjs('add',links[0].parentNode,com.activeClass);
		}
	},
	createPrevNext:function(){
		// this would be so much easier with innerHTML, darn you standards fetish!
		var temp=document.createElement('ul');
		temp.className=com.prevNextClass;
		temp.appendChild(document.createElement('li'));
		temp.getElementsByTagName('li')[0].appendChild(document.createElement('a'));
		temp.getElementsByTagName('a')[0].setAttribute('href','#');
		temp.getElementsByTagName('a')[0].innerHTML=com.prevLabel;
		temp.getElementsByTagName('li')[0].className=com.prevClass;
		temp.appendChild(document.createElement('li'));
		temp.getElementsByTagName('li')[1].appendChild(document.createElement('a'));
		temp.getElementsByTagName('a')[1].setAttribute('href','#');
		temp.getElementsByTagName('a')[1].innerHTML=com.nextLabel;
		temp.getElementsByTagName('li')[1].className=com.nextClass;
		com.addEvent(temp.getElementsByTagName('a')[0],'click',com.navTabs,false);
		com.addEvent(temp.getElementsByTagName('a')[1],'click',com.navTabs,false);
		// safari fix
		temp.getElementsByTagName('a')[0].onclick=function(){return false;}
		temp.getElementsByTagName('a')[1].onclick=function(){return false;}
		return temp;
	},
	navTabs:function(e){
		var li=com.getTarget(e);
		var menu=li.parentNode.parentNode.menu;
		var count=li.parentNode.parentNode.i;
		var section=menu.getElementsByTagName(com.contentElements);
		var links=menu.getElementsByTagName('a');
		var othercount=(li.parentNode.className==com.prevClass)?count-1:count+1;
		section[count].style.display='none';
		com.cssjs('remove',links[count].parentNode,com.activeClass);
		section[othercount].style.display='block';
		com.cssjs('add',links[othercount].parentNode,com.activeClass);
		var parent=links[count].parentNode.parentNode;
		parent.currentLink=links[othercount];
		parent.currentSection=links[othercount].href.match(/#(\w.+)/)[1];
		com.cancelClick(e);
	},
	changeTab:function(elm,state){
		do{
			elm=elm.parentNode;
		} while(elm.nodeName.toLowerCase()!=com.contentElements)
		elm.style.display=state==0?'none':'block';
	},
	showTab:function(e){
		var o=com.getTarget(e);
		if(o.parentNode.parentNode.currentSection!=''){
			com.changeTab(document.getElementById(o.parentNode.parentNode.currentSection),0);
			com.cssjs('remove',o.parentNode.parentNode.currentLink.parentNode,com.activeClass);
		}
		var id=o.href.match(/#(\w.+)/)[1];
		o.parentNode.parentNode.currentSection=id;
		o.parentNode.parentNode.currentLink=o;
		com.cssjs('add',o.parentNode,com.activeClass);
		com.changeTab(document.getElementById(id),1);
		document.getElementById(id).focus();
		com.cancelClick(e);
	},
/* helper methods */
	getTarget:function(e){
		var target = window.event ? window.event.srcElement : e ? e.target : null;
		if (!target){return false;}
		if (target.nodeName.toLowerCase() != 'a'){target = target.parentNode;}
		return target;
	},
	cancelClick:function(e){
		if (window.event){
			window.event.cancelBubble = true;
			window.event.returnValue = false;
			return;
		}
		if (e){
			e.stopPropagation();
			e.preventDefault();
		}
	},
	addEvent: function(elm, evType, fn, useCapture){
		if (elm.addEventListener) 
		{
			elm.addEventListener(evType, fn, useCapture);
			return true;
		} else if (elm.attachEvent) {
			var r = elm.attachEvent('on' + evType, fn);
			return r;
		} else {
			elm['on' + evType] = fn;
		}
	},
	cssjs:function(a,o,c1,c2){
		switch (a){
			case 'swap':
				o.className=!com.cssjs('check',o,c1)?o.className.replace(c2,c1):o.className.replace(c1,c2);
			break;
			case 'add':
				if(!com.cssjs('check',o,c1)){o.className+=o.className?' '+c1:c1;}
			break;
			case 'remove':
				var rep=o.className.match(' '+c1)?' '+c1:c1;
				o.className=o.className.replace(rep,'');
			break;
			case 'check':
				var found=false;
				var temparray=o.className.split(' ');
				for(var i=0;i<temparray.length;i++){
					if(temparray[i]==c1){found=true;}
				}
				return found;
			break;
		}
	}
}
com.addEvent(window, 'load', com.init, false);
	
