
const slider = document.getElementById('splideMain');
if(slider){
	new Splide( '#splideMain', {
		type   : 'loop',
		perPage: 3,
		perMove: 1,
		width: '814px',
		focus: 'center',
		fixedWidth: '260px',
		gap: '17px',
		arrowPath: "M41.2,17.8c-9.8,0-17.8-8-17.8-17.8h-2c0,7.8,4.6,14.6,11.2,17.8H0v2h32.6C26,23,21.4,29.7,21.4,37.5h2 c0-9.8,8-17.8,17.8-17.8L41.2,17.8L41.2,17.8z",
		classes: {
			// Add classes for arrows.
			arrows: 'splide__arrows splideArrows',
			arrow : 'splide__arrow splideArrow',
			prev  : 'splide__arrow--prev splideArrowPrev',
			next  : 'splide__arrow--next splideArrowNext',
			
			// Add classes for pagination.
			pagination: 'splide__pagination your-class-pagination', // container
			page      : 'splide__pagination__page your-class-page', // each button
		},
	} ).mount();
}