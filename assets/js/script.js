$(function(){
    $('.p_new_image').click(function(e){
        e.preventDefault()

        $('.products_files_area').append('<input type="file" name="images[]" />')
    })

    $('.p_image a').click(function(){
        $(this).parent().remove()
    })
})