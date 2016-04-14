$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

    window.loadMore = function(element, event) {
        event.preventDefault();
        event.stopPropagation();

        var pointer = parseInt($(element).attr('data-pointer')), currentPointer, $parent = $(element).parent();

        $(element).remove();

        $parent.find('li').each(function(index) {

            currentPointer = parseInt($(this).attr('data-pointer'));

            if(currentPointer > pointer && currentPointer < (pointer + 11)) {
                $(this).css('display', 'block');
            }
        });

    };
    $('ul.dropdown-menu').each(function(index) {
        var $li = $(this).find('li'),
            length = $li.length,
            restriction = 10;

        if(length > restriction) {

            $(this).css({
                'maxHeight': '320px',
                'overflow': 'auto'
            });

            var pointer = 0,
                pointerLoad = 0, extraCss = 'background: #f6f6f6;cursor:pointer;';
            for(var i = length - 1; i >= 0; i --) {
                if(pointer != 0 && !(pointer % restriction)) {

                    if(pointerLoad > 1) {
                        extraCss += 'display:none';
                    }

                    $($li[pointer]).after('<li onclick="loadMore(this, event)" data-pointer="' + pointer + '" data-load="'+ pointerLoad +'" style="'+ extraCss +'">> Load More</li>');
                }

                if(pointer > restriction) {
                    $($li[pointer]).css('display', 'none');
                    $($li[pointer]).attr('data-load-pos', pointerLoad);
                }

                if(pointer != 0 && !((pointer - 1) % restriction)) {
                    pointerLoad++;
                }

                $($li[pointer]).attr('data-pointer', pointer);

                pointer++;
            }
        }
    });
})