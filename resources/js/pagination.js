$(function() {
    $('ul.pagination').hide();
    $('.scrolling-pagination').jscroll({
        autoTrigger: true,
        padding: 0,
        nextSelector: ' .pagination li.active + li a',
        contentSelector: '.scrolling-pagination',
        callback: function() {
            $('ul.pagination').remove();
        }
    });
})