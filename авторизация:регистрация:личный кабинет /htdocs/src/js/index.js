$("#btn").click(function() {
    event.preventDefault();

   let data = $('#form').serializeArray();

    $.ajax({
        type: "POST",
        url:"auth/func.php",
        dataType: "json",
        data:data,
        success:function(data){
            $('#form').trigger("reset");
            $('.messages').html(data.result);
            switch ($('.messages').text()) {
                case 'Вы успешно зарегистрированы!': 
                    $('#form').hide();
                break;
                case '': 
                location.href="lk/index.php"; 
                break;
            };
        },
        error:function(){
            alert('Ошибка отправки данных')
        },
    });
});

