(function($){
	$(function(){
		var iOS = false,
		    p = navigator.platform;

		if( p === 'iPad' || p === 'iPhone' || p === 'iPod' || p === 'iPhone Simulator'){
		    iOS = true;
		}
		if(iOS){
			// parse xml data
				$.ajax({
				  type: "GET",
				  // url: pluginPath+"/xml/test.xml",
				  url: pluginPath+"/xml/"+filename,
				  dataType: "xml",
				  success: parseXml
				});
		}
		function k (o){
			console.log(o);
		};
		function hexToRgb(hex, a) {
		    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		    if(result){
		    	r = parseInt(result[1], 16);
		    	g = parseInt(result[2], 16);
		    	b = parseInt(result[3], 16);
		    	return "("+ r +","+ g +"," + b +","+ a +")";
		    }
		};

		//
		function parseXml(xml){

			var $baseDef = $(xml).find('baseDef'),
			    pics = $(xml).find('pic'),
				picsNum = pics.length,
				picArray = [],
				currentTab = 0,
				changeInfo = function (num){
					$('.slider-info-title').text(picArray[num]['FindMoreText']);
					$('.slider-info-content').text(picArray[num]['FindMoreSText']);
					$('.slider-viewmore').text('►' + picArray[num]['FindMoreName']);
					$('.slider-viewmore').attr('href', picArray[num]['url']);
					$('.slider-viewmore').attr('target', picArray[num]['target']);
					$('#dazake .slider-info').css({
						'background': 'rgba'+hexToRgb(picArray[num]['FindMoreColorBack'], picArray[num]['FindMoreAlpha']),
						'color'     : picArray[num]['FindMoreColorText']
					});
					$('#dazake .slider-viewmore').css({
						'background': picArray[num]['FindMoreButtonColor'],
						'color'     : picArray[num]['FindMoreButtonTextColor']
					});

				},

			//main slider config
			// convert to hex
			toHex = function(color){
				return color.replace('0x', '#');
			};

			var config = {
				'autoSlideTime'     : $baseDef.attr('autoSlideTime')*1000,
				'gradientColor1'    : toHex($baseDef.attr('gradientColor1')),
				'gradientColor2'    : toHex($baseDef.attr('gradientColor2')),
				'showPlay'          : $baseDef.attr('showPlay'),
				'menuColor'         : toHex($baseDef.attr('menuColor')),
				'menuOverColor'     : toHex($baseDef.attr('menuOverColor')),
				'menuTextColor'     : toHex($baseDef.attr('menuTextColor')),
				'menuOverTextColor' : toHex($baseDef.attr('menuOverTextColor')),
				'transitionTime'    : $baseDef.attr('transitionTime'),
				'menutransition'    : $baseDef.attr('menutransition'),
				'boxwidth'          : $baseDef.attr('boxwidth'),
				'boxheight'         : $baseDef.attr('boxheight'),
				'infoFontSizeBig'   : $baseDef.attr('infoFontSizeBig'),
				'infoFontSizeSmall' : $baseDef.attr('infoFontSizeSmall'),
				'menuFontSize'      : $baseDef.attr('menuFontSize'),
				'transform'         : $baseDef.attr('transform'),
				'cornerRadius'      : $baseDef.attr('cornerRadius'),
				'menuScrollSpeed'   : $baseDef.attr('menuScrollSpeed'),
				'descbox_visible'   : $baseDef.attr('description_box_visible'),
				'box_x'   : $baseDef.attr('box_x'),
				'box_y'   : $baseDef.attr('box_y')
			};	

			for(var i = 0; i < picsNum; i++){
				picArray[i] = pics[i];
				$thisPic = $(picArray[i]);
				picArray[i] = {
					'url'                     : $thisPic.attr('url'),
					'target'                  : $thisPic.attr('target'),
					'FindMoreColorBack'       : toHex($thisPic.attr('FindMoreColorBack')),
					'FindMoreColorText'       : toHex($thisPic.attr('FindMoreColorText')),
					'FindMoreAlpha'           : $thisPic.attr('FindMoreAlpha'),
					'FindMoreButtonColor'     : toHex($thisPic.attr('FindMoreButtonColor')),
					'FindMoreButtonTextColor' : toHex($thisPic.attr('FindMoreButtonTextColor')),
					'pic'                     : $thisPic.attr('pic'),
					'FindMoreName'            : $thisPic.find('FindMoreName').text(),
					'FindMoreText'            : $thisPic.find('FindMoreText').text(),
					'FindMoreSText'           : $thisPic.find('FindMoreSText').text(),
					'menuText'                : $thisPic.find('menuText').text()
				}
			}


			//dynamic style
			var gradientColor = function(el, from, to){
					return 	el+"{background-color:"+from+";background-image:-webkit-gradient(linear,left top,left bottom,from("+from+"),to("+to+"));background-image:-webkit-linear-gradient(top,"+from+","+to+");background-image:-moz-linear-gradient(top,"+from+","+to+");background-image:-ms-linear-gradient(top,"+from+","+to+");background-image:-o-linear-gradient(top,"+from+","+to+");background-image:linear-gradient(top,"+from+","+to+");filter:progid:DXImageTransform.Microsoft.gradient(startColorStr='"+from+"',EndColorStr='"+to+"');}";
				},
				addStyle = function (el, key, value){
					return el+"{"+key+":"+value+";}";
				},
				transitionTime = function(el, time){
					return el+"{-webkit-transition:all "+time+"s ease-out;-moz-transition:all "+time+"s ease-out;-ms-transition:all "+time+"s ease-out;-o-transition:all "+time+"s ease-out;transition:all "+time+"s ease-out}";
				};

			var stylesheet = 
			"<style>"
				+gradientColor(".slidershow", config.gradientColor1, config.gradientColor2)
				+transitionTime("#dazake .slider-tab", config.menutransition)
				// menu
				+addStyle("#dazake .slider-tab", "background", config.menuColor)
				+addStyle("#dazake .slider-tab:hover", "background", config.menuOverColor)
				+addStyle("#dazake .tab-active", "background", config.menuOverColor)
				+addStyle("#dazake .slider-tab", "color", config.menuTextColor)
				+addStyle("#dazake .slider-tab:hover", "color", config.menuOverTextColor)
				// slider info
				+addStyle("#dazake .slider-info", "left", config.box_x+"px")
				+addStyle("#dazake .slider-info", "top", config.box_y+"px")
				+addStyle("#dazake .slider-info-title", "font-size", config.infoFontSizeBig+"px")
				+addStyle("#dazake .slider-info-content", "font-size", config.infoFontSizeSmall+"px")
				// slider-tab
				+addStyle("#dazake .slider-tab", "font-size", config.menuFontSize+"px")
				+addStyle("#dazake .slider-tab", "width", (flashvars.maxwidth-10)+"px")
				+addStyle("#dazake .tab-active", "color", config.menuOverTextColor)
				// globle
				+addStyle("#dazake", "width", flashvars.maxwidth+"px")
				+addStyle("#dazake", "height", flashvars.maxheight+"px")
				+addStyle("#dazake .sliderInner", "width", (flashvars.maxwidth-20)+"px")
				+addStyle("#dazake .sliderInner", "height", (flashvars.maxheight-20)+"px")
				+addStyle("#dazake", "border-radius", config.cornerRadius+"px")
				+addStyle("#dazake .sliderInner", "border-radius", config.cornerRadius+"px")
				+addStyle("#dazake .imgbox img", "border-top-left-radius", config.cornerRadius+"px")
				+addStyle("#dazake .imgbox", "border-top-left-radius", config.cornerRadius+"px")
				+addStyle("#dazake .imgbox", "border-bottom-left-radius", config.cornerRadius+"px")
				+addStyle("#dazake .imgbox img", "width", flashvars.imagewidth+"px")
			+"</style>";


			//sldieshow html structure
			var tpl = 
					'<div class="slidershow" id="dazake">'
						+'<div class="sliderInner">'
							+'<div class="slider-left">'
				                +'<div class="slider-info">'
				                	+'<h1 class="slider-info-title"></h1>'
				                	+'<p class="slider-info-content"></p>'
				                	+'<a href="" class="slider-viewmore">► View More</a>'
				                +'</div>'
								+'<div class="imgbox">'
								+'</div>'
							+'</div>'
							+'<div class="slider-right">'
								+'<ul class="slider-tabs">'
								+'</ul>'
							+'</div>'
						+'</div>'
					+'</div>';

			// Slider function
			var autoSlide = function(){
				t = false;
				$sliderTop = ($('.slider-right').offset().top) + 64;

				$('.slider-tab').bind({
					click: function(){
						clearInterval(t);
						currentTab = $(this).data('num');
						$('.img-active').hide();
						$($('.imgbox img')[currentTab]).fadeIn(1000).addClass('img-active');
						changeInfo(currentTab);
						$(this).addClass('tab-active').siblings('.slider-tab').removeClass('tab-active');
					},

					mouseover: function(){
						if(t){
							clearInterval(t);
						}
					},
					mouseout: function(){
						t = setInterval(tabChange, config.autoSlideTime);
					}
				});

				tabChange = function(){
					nextTab = (currentTab == picsNum-1) ? 0 : currentTab+1;
					thisImg = $('.imgbox img')[currentTab];
					nextImg = $('.imgbox img')[nextTab];
					thisTab = $('.slider-tabs li')[currentTab];
					nextTab = $('.slider-tabs li')[nextTab];

					$(thisImg).hide().removeClass('img-active');
					$(nextImg).fadeIn(1000).addClass('img-active');					
					$(thisTab).removeClass('tab-active');
					$(nextTab).addClass('tab-active');
					$currentMargin = parseInt($('.slider-tabs').css('margin-top'));
					if(currentTab == picsNum-1){
						$('.slider-tabs').animate({
							'margin-top': 0
						});
					}else{
						$currentTabTop = $(nextTab).offset().top;
						$diff = $currentTabTop - $sliderTop;
						if($diff > 0){
							$('.slider-tabs').animate({
								'margin-top': 0-($diff+48)+$currentMargin
							});
						}
					}

					currentTab = (currentTab == picsNum-1) ? 0 : currentTab+1;
					changeInfo(currentTab);
				};

				// k();
				if(config.showPlay == '1'){
					t = setInterval(tabChange, config.autoSlideTime);
				}
				

			};

			// page load start
			var dazakeStart = function(){
				$('head').append('<link rel="stylesheet" type="text/css" href="'+pluginPath+'/css/jquery.homepage.slider.css" media="all">');
				$('head').append(stylesheet);

				var el = $('#homepageSlideshow');
					el.empty();
				el.append(tpl);
				k(config.descbox_visible);
				if(config.descbox_visible == 'false'){
					$('.slider-info').hide();
				}
				changeInfo(0);         //setup info
				for(var i = 0; i < picsNum; i++){
					$('.imgbox').append('<img src='+picArray[i]['pic']+' id="slider-img'+i+'" style="display:none" alt='+i+'>');
					$('.slider-tabs').append('<li class="slider-tab" id="slider-tab'+i+'" data-num="'+i+'"><span></span>'+picArray[i]['menuText']+'</li>');
				}
				$('#slider-tab0').addClass('tab-active');
				$('.imgbox img:first-child').show();
				autoSlide();
			};

			dazakeStart();
			var swipeOptions = {
				triggerOnTouchEnd : true,	
				swipeStatus : swipeStatus,
				allowPageScroll:"horizontal",
				threshold:75
			}

			function swipeStatus(event, phase, direction, distance)
			{
				//If we are moving before swipe, and we are going Lor R in X mode, or U or D in Y mode then drag.
				if( phase=="move" && (direction=="up" || direction=="down") )
				{
					var duration=0,
						firstLimit = $('.slider-right').offset().top,
						lastLimit = firstLimit+200,
						firstSliderTop = $('.slider-tabs li:first-child').offset().top,
						lastSliderBottom = ($('.slider-tabs li:last-child').offset().top) + 50;
					
					if(direction == "up"){
						if(lastSliderBottom > lastLimit){
							$('.slider-tabs').animate({
								'margin-top': '-=3'
							}, duration);
						}
					}else if(direction == "down"){
						if(firstSliderTop < firstLimit){
							$('.slider-tabs').animate({
								'margin-top': '+=3'
							}, duration);
						}
						
					}					
				}
				
			
			}
			$(".slider-tabs").swipe( swipeOptions );
		}

	});
})(jQuery);