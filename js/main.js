$(document).ready(function() {
    $('#commentForm').on('submit', function(e) {
        e.preventDefault();
        var comment = $('#comment').val();
        var rating = $('#rating').val();

        $.ajax({
            url: 'submit_comment.php',
            type: 'POST',
            data: {comment: comment, rating: rating},
            success: function(response) {
                alert('Comment submitted successfully!');
                // Reload comments
            },
            error: function() {
                alert('Failed to submit comment.');
            }
        });
    });

    // Load comments dynamically
    function loadComments() {
        $.ajax({
            url: 'fetch_comments.php',
            type: 'GET',
            success: function(data) {
                $('#comments').html(data);
            }
        });
    }

    loadComments();
});