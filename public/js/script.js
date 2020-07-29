$( // if document ready

    function (){
        const BASEURL = 'http://localhost/ayotryout/public';
        $('.tampilModalUbah').on('click', function(){
            $('#judulModal').html('Ubah data');
            $('buttonUbah').html('Ubah');
            
            const id = $(this).data('id');
            $('.modal-body form').attr('action', BASEURL+'/admin/akun/u'); // mengubah isi action dari form yang dituju
            $.ajax({
                url: BASEURL+'/admin/getDetail',
                data: {id: id},
                method: 'post',
                dataType: 'json',
                success: function(data){
                    $('#id_user').val(data.id_user);
                    $('#email').val(data.email);
                    $('#telepon').val(data.telepon);
                    $('#username').val(data.username);
                    $('#password').val(data.password);
                    $('#konfirmasi option[value='+data.konfirmasi+']').attr('selected', 'selected');
                }
            });
        });
        $('#ubahSoal').on('click', function(){
            $('#judulModal').html('Ubah data');
            $('buttonUbah').html('Ubah');
            
            // const id = $(this).data('id');

            // $('.modal-body form').attr('action', BASEURL+'/admin/akun/u'); // mengubah isi action dari form yang dituju
            // $.ajax({
            //     url: BASEURL+'/admin/getDetail',
            //     data: {id: id},
            //     method: 'post',
            //     dataType: 'json',
            //     success: function(data){
            //         $('#id_user').val(data.id_user);
            //         $('#email').val(data.email);
            //         $('#telepon').val(data.telepon);
            //         $('#username').val(data.username);
            //         $('#password').val(data.password);
            //         $('#konfirmasi option[value='+data.konfirmasi+']').attr('selected', 'selected');
            //     }
            // });
        });

        $('.tampilDetailRiwayat').on('click', function(){
            const id_temp = $(this).data('id').split('=');
            const id_user = id_temp[0];
            const token = id_temp[1];
            $.ajax({
                url: BASEURL+'/admin/riwayat/_showDataUser/'+id_user+'/'+token,
                method: 'post',
                dataType: 'html',
                success: function(data){
                    $('#headDetailRiwayat').html(data);
                    // $('#email').val(data.email);
                    // $('#telepon').val(data.telepon);
                    // $('#username').val(data.username);
                    // $('#password').val(data.password);
                    // $('#konfirmasi option[value='+data.konfirmasi+']').attr('selected', 'selected');
                    // console.log(data);
                }
            });
            $.ajax({
                url: BASEURL+'/admin/riwayat/_showDataProgress/'+id_user+'/'+token,
                method: 'post',
                dataType: 'html',
                success: function(data){
                    $('#tabelDetailRiwayatAdmin').html(data);
                    // $('#email').val(data.email);
                    // $('#telepon').val(data.telepon);
                    // $('#username').val(data.username);
                    // $('#password').val(data.password);
                    // $('#konfirmasi option[value='+data.konfirmasi+']').attr('selected', 'selected');
                    // console.log(data);
                }
            });
        });
        // var request = require('request');
        // $('#form_soal').submit(function(event){
        //     event.preventDefault();
        //     if(request){
        //         request.abort();
        //     }

        //     var $form = $(this);

        //     var $input = $form.find("input, select, button, textarea");
        //     var serializedData = $form.serialize();

        //     $input.prop("disabled", true);

        //     request = $.ajax({
        //         url: 'http://localhost/ayotryout/public/user/ujian',
        //         type: 'post',
        //         data: serializedData
        //     });

        //     request.done(function (response, textStatus, jqXHR){
        //         console.log("Data jawaban ditambahkan");
        //     });

        //     request.fail(function (jqXHR, testStatus, errorThrown){
        //         console.error(
        //             textStatus, errorThrown
        //         );
        //     });
        //     request.always(function (){
        //         $input.prop('disabled', false);
        //     });
        // });
    }
);