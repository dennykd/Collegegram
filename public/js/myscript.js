function getUpdate(category_id, identity, location = identity) {
    $.ajax({
        type: 'get',
        url: '/get-update',
        data: {
            'category_id': category_id
        },
        success: function (data) {
            $('#loader-wrapper-'+identity).addClass('hidden');
            $(`#update-${location}-area`).html(data.html);
         },
    });
}

function getNotif(identity) {
    $.ajax({
        type: 'get',
        url: '/get-notif',
        success: function (data) {
            $('#loader-wrapper-'+identity).addClass('hidden');
            $('#notif-here').html(data.html);
         },
    });
}

function loadMoreData(page){
    $.ajax({
        url: "?page=" + page,
        type: "GET",
        beforeSend: function() {
            $('#loading-paginate').removeClass('hidden');
        },
        success: function(data) {
            //  console.log(data);
            $('#loading-paginate').addClass('hidden');
            if (data.data_count == 1) {

            } else {
                $("#post-parent").append(data.html);
            }
        }
    });
}

function getComments(post_id, isMenfess) {
    // let isMenfess = $('#is-menfess').val();
    // console.log(isMenfess);
    $.ajax({
        type: 'get',
        url: '/get-comments',
        data: {
            post_id: post_id,
            is_menfess: isMenfess
        },
        beforeSend: function () {
            $('#loading-comments').removeClass('hidden');
        },
        success: function (data) {
            // console.log(data);
            $('#comment-section').append(data.html);
            $('#loading-comments').addClass('hidden');
         },
    });
}

 function doComment(my_id, his_id, post_id) {
     let comment = $('#comment').val();
     let token = $('#csrf_token').val();
     let isMenfess = $('#is-menfess').val();
    //  console.log(token);
    $.ajax({
        type: 'post',
        url: '/do-comment',
        data: {
            _token: token,
            notif_trigger_user_id: his_id,
            user_id: my_id,
            post_id: post_id,
            content: comment,
            is_menfess: isMenfess
        },
        beforeSend: function () {
            $('#submit-comment').text('Loading...');
        },
        success: function (data) {
             let comment_count = '';
               if (data.comment_count > 1000) {
                  comment_count = (data.comment_count / 1000).toFixed(1) + 'k';
               } else {
                  comment_count = data.comment_count;
               }
            // console.log(data);
            $('#comment-section').prepend(data.html);
            $('#submit-comment').text('Comment');
            // console.log(data);
            $('#comment').val('');
            $('#comment-count').text(comment_count);
        },
        error: function () {
            $('#submit-comment').text('Comment');
            alert("Comment failed!!");
         }
    });
}
 function doReply(my_id, his_id, post_id, parent_id, current_comment) {
     let reply = $('#reply-'+current_comment).val();
     let token = $('#csrf_token').val();
     let isMenfess = $('#is-menfess').val();
    //  console.log(parent_id);
    //  console.log(post_id);
    //  console.log(token);
    $.ajax({
        type: 'post',
        url: '/do-reply',
        data: {
            _token: token,
            notif_trigger_user_id: his_id,
            user_id: my_id,
            post_id: post_id,
            parent_id: parent_id,
            reply: reply,
            is_menfess: isMenfess,
            current_comment: current_comment
        },
        beforeSend: function () {
            $('#submit-reply-'+current_comment).text('Loading...');
        },
        success: function (data) {
            // console.log(data);
            $('#reply-section-'+data.parent_id).append(data.html);
            $('#submit-reply-'+data.current_comment).text('Reply');
            // console.log(data);
            $('#reply-'+data.current_comment).val('');
         },
         error: function () {
             $('#submit-reply-'+current_comment).text('Reply');
             alert("Reply failed!!");
         }
    });
}
