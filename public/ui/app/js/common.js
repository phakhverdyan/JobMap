$(function() {

    //Menu

    $("div.form-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.form-tab>div.form-tab-content").removeClass("active");
        $("div.form-tab>div.form-tab-content").eq(index).addClass("active");
    });

    //Sidebar

    $(".profile-switcher").tooltip();

    //Select

    $(".custom-select").each(function() {
      var classes = $(this).attr("class"),
          id      = $(this).attr("id"),
          name    = $(this).attr("name");
      var template =  '<div class="' + classes + '">';
          template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
          template += '<div class="custom-options">';
          $(this).find("option").each(function() {
            template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
          });
      template += '</div></div>';

      $(this).wrap('<div class="custom-select-wrapper"></div>');
      $(this).hide();
      $(this).after(template);
    });
    $(".custom-option:first-of-type").hover(function() {
      $(this).parents(".custom-options").addClass("option-hover");
    }, function() {
      $(this).parents(".custom-options").removeClass("option-hover");
    });
    $(".custom-select-trigger").on("click", function() {
      $('html').one('click',function() {
        $(".custom-select").removeClass("opened");
      });
      $(this).parents(".custom-select").toggleClass("opened");
      event.stopPropagation();
    });
    $(".custom-option").on("click", function() {
      $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
      $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
      $(this).addClass("selection");
      $(this).parents(".custom-select").removeClass("opened");
      $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
    });

    $('.cell .control-indicator').on("click",function() {
      var element = $(this).parent().parent()
      if (element.hasClass('active-cell')) {
        element.removeClass('active-cell')
      } else {
        element.addClass('active-cell')
      }
    })

    $('#switch-filter').on('click',function() {
      $('.filters-content').slideToggle()
    })

    $('.info-icon-wrapper').on('mouseover',function(){
      $('.tooltip-info').css('display','block')
    })

    $('.info-icon-wrapper').on('mouseout',function(){
      $('.tooltip-info').css('display','none')
    })

    $('.info-icon').on('touchstart',function(){
      $('.tooltip-info').css('display','block')
    })

    $('.info-icon').on('touchend',function(){
      $('.tooltip-info').css('display','none')
    })

});

$("#active-table .cell").on('click',function(){
  var element = $(this)
  if (element.hasClass('active-cell')) {
    element.removeClass('active-cell')
  } else {
    element.addClass('active-cell')
  }
})

$('#close_msg_aside').on('click',function(){
  var element = $('.page-aside')
  if (!element.hasClass('close_aside')) {
    element.addClass('close_aside')
  }
})

$('#open_msg_aside').on('click',function(){
  var element = $('.page-aside')
  if (element.hasClass('close_aside')) {
    element.removeClass('close_aside')
  } else {
    element.addClass('close_aside')
  }
})

$('#params_msg_button').on('click',function(){
  $('.search-list').slideToggle()
})

// $('.last-item').hide();
// $('.arrow-switch-icon.left').hide();
// $('.arrow-switch-icon').on('click',function(){
//   var isLeftArrow = $(this).hasClass('left');
//   var leftArrow = $('.arrow-switch-icon.left');
//   var rightArrow = $('.arrow-switch-icon.right');
//   var leftSide  = $('.first-item');
//   var rightSide = $('.last-item').hide();
//   if (isLeftArrow) {
//     rightSide.fadeOut();
//     leftSide.fadeIn();
//     leftArrow.fadeOut();
//     rightArrow.fadeIn();
//   } else {
//     leftSide.fadeOut();
//     rightSide.fadeIn();
//     rightArrow.fadeOut();
//     leftArrow.fadeIn();
//   }
// })

$('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
    $(this).toggleClass('open');
});

/*Modal Popup*/

//add login/signup modal

$modal   = $('.modal-frame');
$overlay = $('.modal-overlay');

$modal_sign_in = $('.modal_sign_in');
$modal_sign_up = $('.modal_sign_up');
$modal_reset_password = $('.modal_reset_password');
$modal_contact_form = $('.modal_contact_form');
$pseudo_input_title = $('.pseudo-input-title');
$referal_modal_authenticated = $('.referal_modal_authenticated');
$referal_modal = $('.referal_modal');


$modal_sign_in.hide();
$modal_sign_up.hide();
$modal_contact_form.hide();
$modal_reset_password.hide();
$pseudo_input_title.hide();
$referal_modal_authenticated.hide();
$referal_modal.hide();

/* Need this to clear out the keyframe classes so they dont clash with each other between ener/leave. Cheers. */
$modal.bind('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (e) {
    if ($modal.hasClass('state-leave')) {
        $modal.removeClass('state-leave');
    }
});

function showModal () {
   $overlay.addClass('state-show');
   $modal.removeClass('state-leave').addClass('state-appear');
}

function hideModal () {
  $overlay.removeClass('state-show');
  $modal.removeClass('state-appear').addClass('state-leave');
}

function hideAll () {
  $modal_sign_in.hide();
  $modal_sign_up.hide();
  $modal_contact_form.hide();
  $modal_reset_password.hide();
  $referal_modal_authenticated.hide();
  $referal_modal.hide();
}

$("#show-sign-in").on('click', function () {
  if(!$modal_sign_up.is(":visible")) {
    showModal();
  } else {
    hideAll();
  }
  $modal_sign_in.show();
});

$(".show-sign-up").on('click', function () {
  if(!$modal_sign_in.is(":visible")) {
    showModal();
  } else {
    hideAll();
  }
  $modal_sign_up.show();
});

$(".show-reset-password").on('click',function () {
  if(!$modal_sign_in.is(":visible")) {
    showModal();
  } else {
    hideAll();
  }
  $modal_reset_password.fadeIn();
});

$(".show-contact-form").on('click', function () {
  if(!$modal_sign_in.is(":visible")) {
    showModal();
  } else {
    hideAll();
  }
  $modal_contact_form.show();
});

$("#referal_modal_authenticated").on('click', function () {
  if(!$modal_sign_in.is(":visible")) {
    showModal();
  } else {
    hideAll();
  }
  $referal_modal_authenticated.show();
});

$("#referal_modal").on('click', function () {
  if(!$modal_sign_in.is(":visible")) {
    showModal();
  } else {
    hideAll();
  }
  $referal_modal.show();
});


$('.close-modal').on('click', function () {
  hideModal();
  hideAll();
});

$('#show-modal').on('click', function () {
  showModal ();
});

/* End Modal */

setTimeout(function () {
  $pseudo_input_title.fadeIn()
  $('.pseudo-input').removeClass('hide-pseudo-input')
},1500)

//Map
function initialize() {
  var $latitude = 51.51891,
      $longitude = -0.11905,
      $image = './../img/company-marker.png',
      $mapZoom = 14;


  var myLatlng = new google.maps.LatLng($latitude,$longitude);
  var mapOptions = {
    zoom: $mapZoom,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var image = $image;

  var marker = new google.maps.Marker({
      position: myLatlng,
      icon: image,
      map: map,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      title: 'Mishcon De Reya'
  });

var contentString = '<div class="map-popup">'+
	'<div class="map-popup-header">'+
    '<div class="company-logo">'+
        '<img src="./../img/company-popup-logo.png" />'+
        '<p class="title">Ford Company</p>'+
		'</div>'+
	'</div>'+
	'<div class="map-popup-content">'+
		'<p>'+
			'<img alt="education" src="./img/case-active.png" />23 Jobs'+
		'</p>'+
		'<p>'+
			'<img alt="education" src="./img/marker-active.png" /><span>73823 Saint Laurent Ouest ST. UT, QC, Canada</span>'+
		'</p>'+
	'</div>'+
  '<div class="map-popup-footer">'+
    '<a class="map-popup-button"> more info</a>'+
  '</div>'+
'</div>';

var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

 // open tooltip on load
infowindow.open(map, marker);

 // open tooltip  on click on the marker
 google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });

   // *
  // START INFOWINDOW CUSTOMIZE.
  // The google.maps.event.addListener() event expects
  // the creation of the infowindow HTML structure 'domready'
  // and before the opening of the infowindow, defined styles are applied.
  // *
  google.maps.event.addListener(infowindow, 'domready', function() {

        // Reference to the DIV that wraps the bottom of infowindow
        var iwOuter = $('.gm-style-iw');

        /* Since this div is in a position prior to .gm-div style-iw.
         * We use jQuery and create a iwBackground variable,
         * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
        */
        var iwBackground = iwOuter.prev();

        // Removes background shadow DIV
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});

        // Removes white background DIV
        iwBackground.children(':nth-child(4)').css({'display' : 'none'});

        // Moves the infowindow 115px to the right.
        iwOuter.parent().parent().css({left: '115px'});

        // Moves the shadow of the arrow 76px to the left margin.
        iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

        // Moves the arrow 76px to the left margin.
        iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

        // Changes the desired tail shadow color.
        iwBackground.children(':nth-child(3)').find('div').children().css({'display' : 'none'});

        // Reference to the div that groups the close button elements.
        var iwCloseBtn = iwOuter.next();

        // Apply the desired effect to the close button
        iwCloseBtn.css({'display': 'none'});

        // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
        if($('.iw-content').height() < 140){
          $('.iw-bottom-gradient').css({display: 'none'});
        }

        // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
        iwCloseBtn.mouseout(function(){
          $(this).css({opacity: '1'});
        });
      })
}

google.maps.event.addDomListener(window, 'load', initialize);
