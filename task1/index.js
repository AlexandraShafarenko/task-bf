$(function (){
    $('#marka').change(function(){
        let code = $(this).val();
        $.post('index.php', {code: code}, function(data){
            $('#model').empty();
            $('#model').append(data);
            $('.model-select').fadeIn('slow');
        });
    });
});
$(function (){
    $('#model').change(function (){
        $('.type-select').fadeIn('slow');
    })
});
$(function (){
    $('#type').change(function (){
        $('.name-input').fadeIn('slow');
    })
});
$(function (){
    $("#phone").mask("8(999) 999-99-99");
});

