const tlInfinity = new TimelineMax({ repeat: -1 });
const tl = new TimelineMax();
const tm = TweenMax;
const bg = document.querySelector('#hero_section');
const price = document.querySelectorAll('.hero__price');
const heroBurguer = document.querySelectorAll('.hero__burguer');
const rightSideGal = document.querySelectorAll('.gallery__right_side > a');
const links = document.querySelectorAll('.navbar__navLinks > li');
var showingMenu = false;

const gallery_tl = new TimelineMax({
    scrollTrigger: {
        trigger: '.gallery__left_side_container',
        scrub: 1,
        //markers: true,
        start: 'top bottom',
        end: 'top top'
    }
});

tlInfinity.to(bg, 25, {
    backgroundPosition: "-2247px 0px"
});


gallery_tl.from('.gallery__left_side_container',1,{
    x:-850,
    opacity: '0',
    ease: Power4.easeOut
},'gallery').
staggerFrom([rightSideGal[0],rightSideGal[1]], 1, {
    x:150,
    opacity: '0',
    ease: Power4.easeOut
},.2, 'gallery')


window.onresize = ()=>{
    if(window.innerWidth <= 1024){
        tm.set('.navbar__navLinks', {
            x:"-100vh"
        });
        tm.set(links, {
            x:"-100vh"
        });
    }

    if(window.innerWidth > 1024){
        tm.set('.navbar__navLinks', {
            x:0
        });

        tm.set(links, {
            x:0
        });
    }
}




function showMenu(){
    showingMenu = !showingMenu;

    if(showingMenu){
        tl.to('.navbar__navLinks', .8, {
            x:0,
            opacity:100,
            ease: Elastic.easeOut
        }).
        staggerTo(links, 1 , {
            x:0,
            opacity:100,
            ease: Power4.easeOut
        },.05, delay ="-=.8")
    }else{
        tl.staggerTo([links, '.navbar__navLinks'] , 1 , {
            x:'-100vh',
            ease: Power4.easeOut
        },.05)
    }

}



