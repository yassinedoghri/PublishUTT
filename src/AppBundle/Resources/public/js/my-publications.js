$('.block').click(function () {
    $(this).children('.my-publication-off').addClass("my-publication-on").removeClass('my-publication-off');
    $(this).parent('.grid-item').children('.my-publication-close').css('display', 'block');
    $(this).children('.my-publication').children('.my-publication-edit').children('.my-publication-edit-icon').css('display', 'table-cell');
});
$('.my-publication-close').click(function () {
    $('.my-publication').removeClass('my-publication-on');
    $(this).css('display', 'none');
});
$(document).mouseup(function (e) {
    var container = $(".my-publication-on");
    if ((!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0)) // ... nor a descendant of the container
    {
        container.toggleClass('my-publication-off').toggleClass('my-publication-on');
        $('.my-publication-close').css('display', 'none');
        $('.my-publication-edit-icon').css('display', 'none');
    }
});

// init Isotope
var $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'fitRows',
});

// bind filter button click
$('#filters').on('click', 'button', function () {
    var filterValue = $(this).attr('data-filter');
    $grid.isotope({filter: filterValue});
});

// change is-checked class on buttons
$('.button-group').each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on('click', 'button', function () {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $(this).addClass('is-checked');
    });
});