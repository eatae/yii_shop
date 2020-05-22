
/*
    LEFT MENU CATEGORY
    ==================
*/

var sidebar = $('div.sidebar');
var ajax_container = $('#ajax_container');

var parent_buttons = sidebar.find('ul.nav-pills > li');
var current_parent = sidebar.find('ul.nav-pills > li.active');

var child_blocks = sidebar.find('ul.inline');
var child_buttons = child_blocks.find('li > a');


/* show child block */
current_parent.find('ul.inline').show();


/**
 * CLick Left Menu (parent category)
 */
parent_buttons.on('click', function(e) {
    e.preventDefault();
    var self = $(this);
    var child = self.find('ul.inline');
    if ( self.hasClass('active') ) {
        self.removeClass('active');
        child.hide('400');
    }
    else {
        self.addClass('active');
        child.show('400');
    }
});


/**
 * CLick Left Menu (child category)
 */
child_buttons.on('click', function(e) {
    e.stopPropagation();
    e.preventDefault();

    var self = $(this);
    var href = self.attr('href');
    //var height = ajax_container.height();

    if (self.hasClass('active')) { return }
    history.pushState('', '', href);

    child_buttons.removeClass('active');
    self.addClass('active');
    ajax_container.parent().css('min-height', 600);
    var hide_content = $.when(ajax_container.fadeOut());

    /* send ajax */
    $.ajax({
        type: 'GET',
        url: href,
        success: function (response) {
            hide_content.done(function(){
                ajax_container.html(response);
                ajax_container.slideDown();
            });

        }
    });
});



/**
 * CLick Pagination
 */
ajax_container.on('click', 'ul.pagination > li', function(e) {
    e.preventDefault();
    var self = $(this);
    var href = self.find('a').attr('href');
    //var height = ajax_container.height();

    if (self.hasClass('active')) { return }
    history.pushState('', '', href);

    ajax_container.parent().css('min-height', 600);
    var hide_content = $.when(ajax_container.fadeOut());
    $("html, body").animate({ scrollTop: 0 }, 800, "swing", function() { });
    /* send ajax */
    $.ajax({
        type: 'GET',
        url: href,
        success: function (response) {
            hide_content.done( function() {
                ajax_container.html(response);
                ajax_container.fadeIn();
            });

        }
    });
});
