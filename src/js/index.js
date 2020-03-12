var currentTechSlide = 0;
var currentEduSlide = 0;

function nextTechSlide () {
    showTechSlide(currentTechSlide + 1)
}

function prevTechSlide() {
    showTechSlide(currentTechSlide - 1);
}

function nextEduSlide () {
    showEduSlide(currentEduSlide + 1)
}

function prevEduSlide() {
    showEduSlide(currentEduSlide - 1);
}

function showEduSlide(target) {
    currentEduSlide = showSlide(currentEduSlide, 'edu', target);
}

function showTechSlide(target) {
    currentTechSlide = showSlide(currentTechSlide, 'tech', target);
}

function showSlide(currentSlide, classKey, target) {
    console.log(currentSlide);
    let slider = document.getElementsByClassName(`slider ${classKey}`);
    let slides = slider[0].getElementsByClassName('slide');
    let current = slides[currentSlide];
    let dots = document.getElementsByClassName(`dot ${classKey}`);

    if (target == slides.length) {
        target = 0;
    } else if (target < 0) {
        target = slides.length - 1;
    } else if (target == currentSlide) {
        return;
    }

    let more = current.getElementsByClassName('more');
    let body = current.getElementsByClassName('slide-body');
    if(more.length > 0 
        && !more[0].classList.contains('hide') 
        && body[0].classList.contains('expand')) {
       more[0].classList.add('hide');
       body[0].classList.remove('expand');
       current.getElementsByClassName('show')[0].classList.remove('hide');
    }

    current.classList.remove('fade');
    current.classList.add('bloom');
    
    setTimeout(() => {
        current.classList.add('hide');
        current.classList.remove('bloom');
        current.classList.add('fade');

        slides[target].classList.remove('hide');
    
        dots[target].classList.add('active');
        dots[currentSlide].classList.remove('active');
    }, 200);

    return target;
}

function showMore(buttonId, contentId, containerId) {
    let btn = document.getElementById(buttonId);
    let content = document.getElementById(contentId);
    let container = document.getElementById(containerId);

    btn.classList.add('hide');
    content.classList.remove('hide');
    container.classList.add('expand');
}
