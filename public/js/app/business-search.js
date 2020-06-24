$('form#career-page-search-brand').on('submit', function(e){
    e.preventDefault();
    searchJobs();
});
$(document).on('change','form#career-page-search-brand select[name="status"]',function(e) {
    e.preventDefault();
    searchJobs();
});
$(document).on('change','form#career-page-search-brand select[name="type"]',function(e) {
    e.preventDefault();
    searchJobs();
});
$(document).on('change','form#career-page-search-brand select[name="sort"]',function(e) {
    e.preventDefault();
    searchJobs();
});

function searchJobs()
{
    var form = $('form#career-page-search-brand');

    var status = form.find('select[name="status"]').val();
    var types = form.find('select[name="type"]').val();
    var sort = form.find('select[name="sort"]').val();

    window.location = window.location.origin + window.location.pathname + '?' + form.serialize();
}
