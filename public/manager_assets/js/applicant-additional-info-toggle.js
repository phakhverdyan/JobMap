$(".applicant-open-more-info").click(function(){
  	$(".applicant__additional-information").addClass("active");
  	$(".applicant__additional-information").removeClass("non-active");
});

$(".applicant-close-more-info").click(function(){
  	$(".applicant__additional-information").addClass("non-active");
  	$(".applicant__additional-information").removeClass("active");
});

