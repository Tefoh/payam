$(document).ready(function() {
    $('#email-list li > .star > a').on('click', function() {
        $(this).toggleClass('starred');
    });

    $(".has-tooltip").each(function (index, el) {
        $(el).tooltip({
            placement: $(this).data("placement") || 'bottom'
        });
    });

    setHeightEmailContent();

    initEmailScroller();

    $(".clickable-row > div:not(.chbox,.star)").click(function(e) {
        if ((e.target instanceof HTMLAnchorElement) == true) {
            return;
        }

        var href = $(this).parent().data('href');

        if (href != '' && typeof href != 'undefined') {
            window.document.location = href;
        }
    });
});

$(window).smartresize(function(){
    setHeightEmailContent();

    initEmailScroller();
});

function setHeightEmailContent() {
    if ($( document ).width() >= 992) {
        var windowHeight = $(window).height();
        var staticContentH = $('#header-navbar').outerHeight() + $('#email-header').outerHeight();
        staticContentH += ($('#email-box').outerHeight() - $('#email-box').height());

        $('#email-content').css('height', windowHeight - staticContentH);
    }
    else {
        $('#email-content').css('height', '');
    }
}

function initEmailScroller() {
    if ($( document ).width() >= 992) {
        $('#email-navigation').nanoScroller({
            alwaysVisible: false,
            iOSNativeScrolling: false,
            preventPageScrolling: true,
            contentClass: 'email-nav-nano-content'
        });

        $('#email-content').nanoScroller({
            alwaysVisible: false,
            iOSNativeScrolling: false,
            preventPageScrolling: true,
            contentClass: 'email-content-nano-content'
        });
    }
}


$(document).ready(function(){
    $("#email-nav-labels").on("hide.bs.collapse", function(){
        $("#collapsed").addClass('glyphicon-collapse-down').removeClass('glyphicon-collapse-up');
    });
    $("#email-nav-labels").on("show.bs.collapse", function(){
        $("#collapsed").addClass('glyphicon-collapse-up').removeClass('glyphicon-collapse-down');
    });
});

/*===================================*
 SHOW HIDE PASSWORD
*===================================*/

$(".toggle-password").on('click', function () {

    $(this).toggleClass("fa-eye-slash");
    var input = $($(this).attr("data-toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});


/*===================================*
 check or uncheck all of checkboxes
*===================================*/
$(document).ready(function () {
    $('#checkall').click(function () {
        $('#email-list').find('input:checkbox').prop('checked', true);
        $('#check-square').removeClass('fa-square-o').addClass('fa-check-square-o');
    });
});
$(document).ready(function () {
    $('#uncheckall').click(function () {
        $('#email-list').find('input:checkbox').prop('checked', false);
        $('#check-square').removeClass('fa-check-circle-o').addClass('fa-square-o');
    });
});