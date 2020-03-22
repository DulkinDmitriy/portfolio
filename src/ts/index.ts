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

class CollapsedSlide implements Slide {
    private readonly elem: Slide;
    private readonly showMoreButton: ShowMore;

    constructor(element: Slide, showMoreButton: ShowMore) {
        this.elem = element;
        this.showMoreButton = showMoreButton;
    }

    element() {
        return this.elem.element();
    }
    show(): void {
        this.elem.show();
    }
    hide(): void {
        this.showMoreButton.hideContent();
        this.elem.hide();
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

        let start = Date.now();
        setTimeout(() => {
            this.slides[target].show();
            this.dots[target].activate();

            this.current = target;
        }, 300);
    }

    nextSlide() {
        this.showSlide(this.current + 1);
    }

    prevSlide() {
        this.showSlide(this.current - 1);
    }
}

class SwipedSlideshowPanel implements SlideshowPanel {
    private readonly slideShowPanel: SlideshowPanel;
    private x: number;

    constructor(slideShowPanel: SlideshowPanel, slider: any) {
        this.slideShowPanel = slideShowPanel;

        slider.addEventListener('touchstart',
            (ev: any) => {
                try {
                    this.start(ev);
                }
                catch (erorr) {

                }
            }, true);

        slider.addEventListener('touchend', (ev: any) => {
            this.end(ev.changedTouches[0].screenX);
        }, true);
    }

    showSlide(target: number): void {
        this.slideShowPanel.showSlide(target);
    }
    nextSlide(): void {
        this.slideShowPanel.nextSlide();
    }
    prevSlide(): void {
        this.slideShowPanel.prevSlide();
    }

    private start(event: any) {
        event.path.find(
            (elem: any, index: any, array: any) => {
                try {
                    if (elem.classList.contains('slide')) {
                        return this.x = event.touches[0].screenX;
                    }
                } catch (error) {

                }
            }
        );
    }

    private end(x: number) {
        if (this.x > x) {
            this.nextSlide();
        }
        else if (this.x < x) {
            this.prevSlide();
        }
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

class ShowMore {
    private readonly container: any;
    private readonly content: any;
    private readonly button: any;

    constructor(container: any, content: any, button: any) {
        this.container = container;
        this.content = content;
        this.button = button;
        this.button.onclick = () => {
            this.showContent()
        };
    }

    showContent() {
        this.button.classList.add('hide');
        this.container.classList.add('expand');
        this.content.classList.remove('hide');
    }

    hideContent() {
        this.content.classList.add('hide');
        this.container.classList.remove('expand');
        this.button.classList.remove('hide');
    }
}

let docTechSlider = document.getElementsByClassName('slider tech')[0];
let docEduSlider = document.getElementsByClassName('slider edu')[0];

let docTechSlides = docTechSlider.getElementsByClassName('slide');
let docTechDots = document.getElementsByClassName('dots tech')[0].getElementsByClassName('dot');
let docEduSlides = docEduSlider.getElementsByClassName('slide');
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
    let docSlideElement = docEduSlides[index];
    let slide;

    if (docSlideElement.getElementsByClassName('show').length > 0) {
        slide = new CollapsedSlide(
            new AnimatedSlide(
                new SlideBase(docSlideElement)),
            new ShowMore(
                docSlideElement.getElementsByClassName('slide-body')[0],
                docSlideElement.getElementsByClassName('more')[0],
                docSlideElement.getElementsByClassName('show')[0]));
    }
    else {
        slide = new AnimatedSlide(new SlideBase(docSlideElement));
    }

    eduSlides.push(slide);
    eduDots.push(new Dot(docEduDots[index]))
}

let techSlider = new SwipedSlideshowPanel(new SlideshowPanelBase(techSlides, techDots), docTechSlider);
let eduSlider = new SwipedSlideshowPanel(new SlideshowPanelBase(eduSlides, eduDots), docEduSlider);
