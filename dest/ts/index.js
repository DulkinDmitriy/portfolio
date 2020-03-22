for(var SlideBase=function(){function e(e){this.elem=e}return e.prototype.element=function(){return this.elem},e.prototype.show=function(){this.elem.classList.remove("hide")},e.prototype.hide=function(){this.elem.classList.add("hide")},e}(),AnimatedSlide=function(){function e(e){this.elem=e}return e.prototype.element=function(){return this.elem.element()},e.prototype.show=function(){this.elem.element().classList.add("fade"),this.elem.show()},e.prototype.hide=function(){var e=this;this.elem.element().classList.remove("fade"),this.elem.element().classList.add("bloom"),setTimeout(function(){e.elem.hide(),e.elem.element().classList.remove("bloom")},300)},e}(),CollapsedSlide=function(){function e(e,t){this.elem=e,this.showMoreButton=t}return e.prototype.element=function(){return this.elem.element()},e.prototype.show=function(){this.elem.show()},e.prototype.hide=function(){this.showMoreButton.hideContent(),this.elem.hide()},e}(),SlideshowPanelBase=function(){function e(e,t){this.slides=e,this.dots=t,this.current=0}return e.prototype.showSlide=function(e){var t=this;if(e==this.slides.length)e=0;else if(e<0)e=this.slides.length-1;else if(e==this.current)return;this.slides[this.current].hide(),this.dots[this.current].deactivate();Date.now();setTimeout(function(){t.slides[e].show(),t.dots[e].activate(),t.current=e},300)},e.prototype.nextSlide=function(){this.showSlide(this.current+1)},e.prototype.prevSlide=function(){this.showSlide(this.current-1)},e}(),SwipedSlideshowPanel=function(){function e(e,t){var i=this;this.slideShowPanel=e,t.addEventListener("touchstart",function(e){try{i.start(e)}catch(e){}},!0),t.addEventListener("touchend",function(e){i.end(e.changedTouches[0].screenX)},!0)}return e.prototype.showSlide=function(e){this.slideShowPanel.showSlide(e)},e.prototype.nextSlide=function(){this.slideShowPanel.nextSlide()},e.prototype.prevSlide=function(){this.slideShowPanel.prevSlide()},e.prototype.start=function(s){var n=this;s.path.find(function(e,t,i){try{if(e.classList.contains("slide"))return n.x=s.touches[0].screenX}catch(e){}})},e.prototype.end=function(e){this.x<e?this.nextSlide():this.x>e&&this.prevSlide()},e}(),Dot=function(){function e(e){this.elem=e}return e.prototype.activate=function(){this.elem.classList.add("active")},e.prototype.deactivate=function(){this.elem.classList.remove("active")},e}(),ShowMore=function(){function e(e,t,i){var s=this;this.container=e,this.content=t,this.button=i,this.button.onclick=function(){s.showContent()}}return e.prototype.showContent=function(){this.button.classList.add("hide"),this.container.classList.add("expand"),this.content.classList.remove("hide")},e.prototype.hideContent=function(){this.content.classList.add("hide"),this.container.classList.remove("expand"),this.button.classList.remove("hide")},e}(),docTechSlider=document.getElementsByClassName("slider tech")[0],docEduSlider=document.getElementsByClassName("slider edu")[0],docTechSlides=docTechSlider.getElementsByClassName("slide"),docTechDots=document.getElementsByClassName("dots tech")[0].getElementsByClassName("dot"),docEduSlides=docEduSlider.getElementsByClassName("slide"),docEduDots=document.getElementsByClassName("dots edu")[0].getElementsByClassName("dot"),techSlides=[],techDots=[],eduSlides=[],eduDots=[],index=0;index<docTechSlides.length;index++)techSlides.push(new AnimatedSlide(new SlideBase(docTechSlides[index]))),techDots.push(new Dot(docTechDots[index]));for(index=0;index<docEduSlides.length;index++){var docSlideElement=docEduSlides[index],slide=void 0;slide=0<docSlideElement.getElementsByClassName("show").length?new CollapsedSlide(new AnimatedSlide(new SlideBase(docSlideElement)),new ShowMore(docSlideElement.getElementsByClassName("slide-body")[0],docSlideElement.getElementsByClassName("more")[0],docSlideElement.getElementsByClassName("show")[0])):new AnimatedSlide(new SlideBase(docSlideElement)),eduSlides.push(slide),eduDots.push(new Dot(docEduDots[index]))}var techSlider=new SwipedSlideshowPanel(new SlideshowPanelBase(techSlides,techDots),docTechSlider),eduSlider=new SwipedSlideshowPanel(new SlideshowPanelBase(eduSlides,eduDots),docEduSlider);