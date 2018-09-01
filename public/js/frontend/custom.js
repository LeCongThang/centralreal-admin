
$(".scroll").click(function() {
	var to = $(this).data('to');
	$('html, body').animate({
		scrollTop: $("#"+to).offset().top
	}, 1000);
});


$(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
        $('.filter-button').removeClass('active');
        $(this).addClass('active');
    });

});


$(function(){
    $('#btn-navbar-toggle').on('click', function(){
        $('#bs-example-navbar-collapse-1').toggleClass('navbar-inverse-open');
        $(this).toggleClass('active');
    })
    $('[data-toggle="tooltip"]').tooltip(); 
    $('#top').click(function() {            // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                   // Scroll to top of body
    }, 500);
});
});