interface Slide {
    element(): any;
    show(): void;
    hide(): void;
}

class SlideBase implements Slide {
    private readonly elem: any;

    constructor(element: any) {
        this.elem = element;
    }

    element() {
        return this.elem;
    }

    show() {
        this.elem.classList.remove('hide');
    }

    hide() {
        this.elem.classList.add('hide');
    }
}

class AnimatedSlide implements Slide {
    private readonly elem: Slide;

    constructor(element: Slide) {
        this.elem = element;
    }

    element() {
        return this.elem.element();
    }

    show() {
        this.elem.element().classList.add('fade');
        this.elem.show();
    }

    hide() {
        this.elem.element().classList.remove('fade');
        this.elem.element().classList.add('bloom')
        setTimeout(() => {
            this.elem.hide();
            this.elem.element().classList.remove('bloom');
        }, 300);
    }
}

interface SlideshowPanel {
    showSlide(target: number): void;
    nextSlide(): void;
    prevSlide(): void;
}

class SlideshowPanelBase implements SlideshowPanel {
    private readonly dots: Dot[];
    private readonly slides: Slide[];
    private current: number;

    constructor(slides: Slide[], dots: Dot[]) {
        this.slides = slides;
        this.dots = dots;
        this.current = 0;
    }

    showSlide(target: number) {
        if (target == this.slides.length) {
            target = 0;
        }
        else if (target < 0) {
            target = this.slides.length - 1;
        }
        else if (target == this.current) {
            return;
        }

        this.slides[this.current].hide();
        this.dots[this.current].deactivate();

        setTimeout(() => {
            this.slides[target].show();
            this.dots[target].activate();

            this.current = target;
        }, 301);
    }

    nextSlide() {
        this.showSlide(this.current + 1);
    }

    prevSlide() {
        this.showSlide(this.current - 1);
    }
}

class Dot {
    private readonly elem: any;

    constructor(element: any) {
        this.elem = element;
    }

    activate() {
        this.elem.classList.add('active');
    }

    deactivate() {
        this.elem.classList.remove('active');
    }
}

let docTechSlides = document.getElementsByClassName('slider tech')[0].getElementsByClassName('slide');
let docTechDots = document.getElementsByClassName('dots tech')[0].getElementsByClassName('dot');
let docEduSlides = document.getElementsByClassName('slider edu')[0].getElementsByClassName('slide');
let docEduDots = document.getElementsByClassName('dots edu')[0].getElementsByClassName('dot');

let techSlides = [];
let techDots = [];
let eduSlides = [];
let eduDots = [];

for (let index = 0; index < docTechSlides.length; index++) {
    techSlides.push(new AnimatedSlide(new SlideBase(docTechSlides[index])));
    techDots.push(new Dot(docTechDots[index]))
}

for (let index = 0; index < docEduSlides.length; index++) {
    eduSlides.push(new AnimatedSlide(new SlideBase(docEduSlides[index])));
    eduDots.push(new Dot(docEduDots[index]))
}

let techSlider = new SlideshowPanelBase(techSlides, techDots);
let eduSlider = new SlideshowPanelBase(eduSlides, eduDots);
