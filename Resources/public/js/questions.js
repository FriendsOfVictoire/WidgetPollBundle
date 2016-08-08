$vic(document).on('click', '.widget_poll_form_add_question', function(e){
    e.preventDefault();
    var collection = $vic(this).parent().children('.widget_poll_form_questions_collection');
    var index = collection.data('index');
    var prototype = collection.data('prototype').replace(/__name__/g, index);
    collection.append(prototype);
    collection.data('index', index + 1);
});
$vic(document).on('click', '.widget_poll_form_remove_question', function(e){
    e.preventDefault();
    $vic(this).parent('li').remove();
});