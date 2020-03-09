// theme directory name
var themeDirName = 'shortlist-wordpress';
 
// path to ajax file
var homeURL = window.location.protocol + "//" + window.location.host + "/",
    filePath = homeURL + 'wp-content/themes/' + themeDirName + '/includes/';

var shortlistNavItem = $('.navbar li a[href$="/shortlist/"]'),
    listCount = $('body').data('count');
 
shortlistNavItem.append('&nbsp;(<span class="shortlist-count">0</span>)');
 
$('.shortlist-count').html(listCount);

function getItemTotal() {
    var counter = $('.shortlist-count'),
        clearAll = $('.shortlist-clear a');
 
    $.ajax({
        type: 'GET',
        url: filePath + 'shortlist-total.php',
        success: function(data) {
            counter.text(data);
        },
        error: function() {
            console.log('error with getItemTotal function');
        }          
    });
};

function shortlistActions(button) {
 
    $(button).on('click', function(e) {
 
        var target      = $(this),
            item        = target.closest('.item'),
            itemID      = item.attr('id'),
            itemAction  = target.data('action');
 
        $.ajax({
            type: 'GET',
            url: filePath + 'shortlist-actions.php',
            data: 'action=' + itemAction + '&id=' + itemID,
            success: function() {
                getItemTotal();
                console.log(itemAction + ' item ' + itemID);
            },
            error: function() {
                console.log('error with shortlistActions function');
            }
        });
 
        if (itemAction === 'remove') {
            item.removeClass('selected');
        } else {
            item.addClass('selected');
        }
 
        e.preventDefault();
    });
 
};

shortlistActions( $('.item .action:not(.page-template-shortlist-php .item .action)') );

function shortlistPageActions() {
 
    var shortlistPage       = $('.page-template-shortlist-php'),
        shortlistPageItem   = shortlistPage.find('.item'),
        removeItem          = shortlistPageItem.find('.action');
 
    removeItem.on('click', function(e) {
 
        var target = $(this),
            itemID = target.closest('.item').attr('id');
 
        $.ajax({
            type: 'GET',
            url: filePath + 'shortlist-actions.php',
            data: 'action=remove&id=' + itemID,
            success: function() {
                getItemTotal();
                console.log('removed item ' + itemID);
            },
            error: function() {
                console.log('error with removeItem action');
            }
        });
 
        target.closest('.item').remove();
 
        e.preventDefault();
    });
 
};
 
// call immediately
shortlistPageActions();



function clearAll() {
     
    $('.shortlist-clear a').on('click', function(e) {
 
        $.ajax({
            type: 'GET',
            url: filePath + 'shortlist-actions.php',
            data: 'action=empty',
            success: function() {
                getItemTotal();
            },
            error: function() {
                console.log('error with clearAll action');
            }
        });
 
        e.preventDefault();    
    });
} // end
 
clearAll();


\