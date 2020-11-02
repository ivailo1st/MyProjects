import './styles.scss';

$(() => {
  // Main Section Setup: no dots; 5 items to be shown; infinite loop through items; always a centered item;
    $('.sliderv2').slick({
        dots: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        centerMode: true,
        centerPadding: '5rem',
        prevArrow: '.slider-buttons__prev',
        nextArrow: '.slider-buttons__next',
        responsive: [
            {
              // Main Section Setup at 1440px or less: 3 items to be shown;
              breakpoint: 1440,
              settings: {
                centerPadding: '5rem',
                slidesToShow: 3
              }
            },
            {
              // Main Section Setup at 1024px or less: 3 items to be shown;
              breakpoint: 1024,
              settings: {
                centerPadding: '2.5rem',
                slidesToShow: 3
              }
            },
            {
              // Main Section Setup at 480px or less: 1 item to be shown
              breakpoint: 480,
              settings: {
                centerPadding: '1rem',
                slidesToShow: 1
              }
            }
          ]
    });
});