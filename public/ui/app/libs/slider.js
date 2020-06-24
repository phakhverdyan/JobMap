function collision($div1, $div2) {
      var x1 = $div1.offset().left;
      var w1 = 40;
      var r1 = x1 + w1;
      var x2 = $div2.offset().left;
      var w2 = 40;
      var r2 = x2 + w2;

      if (r1 < x2 || x1 > r2) return false;
      return true;
}

// // slider call

$('#salary-slider').slider({
	range: true,
	min: 0,
	max: 500,
	values: [ 75, 300 ],
	slide: function(event, ui) {

		$('#salary-slider .ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[ 0 ]);
		$('#salary-slider .ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[ 1 ]);
		$('#salary-slider .price-range-both').html('<i>$' + ui.values[ 0 ] + ' - </i>$' + ui.values[ 1 ] );

		//

    if ( ui.values[0] == ui.values[1] ) {
      $('#salary-slider .price-range-both i').css('display', 'none');
    } else {
      $('#salary-slider .price-range-both i').css('display', 'inline');
    }

    //

		if (collision($('#salary-slider .price-range-min'), $('#salary-slider .price-range-max')) == true) {
			$('#salary-slider .price-range-min, .price-range-max').css('opacity', '0');
			$('#salary-slider .price-range-both').css('display', 'block');
		} else {
			$('#salary-slider .price-range-min, .price-range-max').css('opacity', '1');
			$('#salary-slider .price-range-both').css('display', 'none');
		}

	}
});

$('#hours-slider').slider({
	range: true,
	min: 0,
	max: 500,
	values: [ 75, 300 ],
	slide: function(event, ui) {

		$('#hours-slider .ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[ 0 ]);
		$('#hours-slider .ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[ 1 ]);
		$('#hours-slider .price-range-both').html('<i>$' + ui.values[ 0 ] + ' - </i>$' + ui.values[ 1 ] );

		//

    if ( ui.values[0] == ui.values[1] ) {
      $('#hours-slider .price-range-both i').css('display', 'none');
    } else {
      $('#hours-slider .price-range-both i').css('display', 'inline');
    }

    //

		if (collision($('#hours-slider .price-range-min'), $('#hours-slider .price-range-max')) == true) {
			$('.price-range-min, .price-range-max').css('opacity', '0');
			$('.price-range-both').css('display', 'block');
		} else {
			$('.price-range-min, .price-range-max').css('opacity', '1');
			$('.price-range-both').css('display', 'none');
		}

	}
});


$( ".skills-slider" ).slider({
  range: "min",
  animate: "fast",
  value: 0,
  min: 0,
  max: 9,
  slide: function( event, ui ) {
  // Update value during slide
    $( ".number-1" ).html( ui.value );
  }
});


// $('.skills-slider .ui-slider-range').append(
// 	'<span class="price-range-both value"><i>$' + $('.skills-slider').slider('values', 0 ) + ' - </i>' + $('.skills-slider').slider('values', 1 ) + '</span>'
// );
// $('.skills-slider .ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + $('.skills-slider').slider('values', 0 ) + '</span>');
// $('.skills-slider .ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + $('.skills-slider').slider('values', 1 ) + '</span>');
//


$('#salary-slider .ui-slider-range').append(
	'<span class="price-range-both value"><i>$' + $('#salary-slider').slider('values', 0 ) + ' - </i>' + $('#salary-slider').slider('values', 1 ) + '</span>'
);
$('#salary-slider .ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + $('#salary-slider').slider('values', 0 ) + '</span>');
$('#salary-slider .ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + $('#salary-slider').slider('values', 1 ) + '</span>');

//test

$('#hours-slider .ui-slider-range').append(
	'<span class="price-range-both value"><i>$' + $('#hours-slider').slider('values', 0 ) + ' - </i>' + $('#hours-slider').slider('values', 1 ) + '</span>'
);
$('#hours-slider .ui-slider-handle:eq(0)').append('<span class="price-range-min value">h' + $('#hours-slider').slider('values', 0 ) + '</span>');
$('#hours-slider .ui-slider-handle:eq(1)').append('<span class="price-range-max value">h' + $('#hours-slider').slider('values', 1 ) + '</span>');
