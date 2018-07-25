$(document).ready(function() {
    // Dropify
    $('.dropify').dropify({
        messages: {
            'default': 'Перетащите файл сюда или кликните',
            'replace': 'Перетащите файл сюда или кликните для замены',
            'remove':  'Удалить',
            'error':   'Упс, что то пошло не так.'
        }
    });

    $('#discount_package_id').change(function() {
        var value = $('#discount_package_id').val();
        if(value === '') {
            $('.projects-list').slideDown(500);
        } else {
            $('.projects-list').slideUp(500);
        }
    })
});