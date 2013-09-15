$(document).ready(function()
{
    //when you click on the add button...
    $("#note_form").submit(function()
    {
        //do this when it comes back from the process page
        $.post(
            $(this).attr('action'), 
            $(this).serialize(), 
            function(data)
            {
                //add the note to the container
                $('#my_container').append(data);

                //make it draggable (otherwise this is only done on page load)
                $('.postit').draggable();

                //make it possible to bring it to the front
                $('.postit').on('mousedown', function(event) { 
                    $('.postit').css('z-index','1');
                    $( this ).css('z-index','1000');
                });

                //bind the event listeners to the edit and delete buttons.

                $(".note_edit").submit(function() {
                    $.post(
                        $(this).attr('action'), 
                        $(this).serialize(), 
                        function(data)
                        {
                            $(this).html(data);
                        }, 
                    "json"
                    );
                    return false;
                });
                
                $(".note_delete").submit(function() {
                    $(this).parent().hide();
                      $.post(
                        $(this).attr('action'), 
                        $(this).serialize(), 
                        function(data)
                        {
                            $(this).html(data);
                        }, 
                    "json"
                    );
                    return false;
                });
            }, 
        "json"
        );
        //blank out the note form for the next note to add.
        this.reset();
        return false;
    });

    //this is what json does when you edit a note
    $(".note_edit").submit(function() {
        $.post(
            $(this).attr('action'), 
            $(this).serialize(), 
            function(data)
            {
                $(this).html(data);
            }, 
        "json"
        );
        return false;
    });

    //this is what json does when you delete a note
    $(".note_delete").submit(function() {
        $(this).parent().hide();
          $.post(
            $(this).attr('action'), 
            $(this).serialize(), 
            function(data)
            {
            
            }, 
        "json"
        );
        return false;
        });
                

    //on document ready make the postits draggable and come to front when clicked.
    $(function() {
    	$(".postit").draggable();
    });

    $('.postit').on('mousedown', function(event) { 
    	$('.postit').css('z-index','1');
    	$( this ).css('z-index','1000');
    });

});