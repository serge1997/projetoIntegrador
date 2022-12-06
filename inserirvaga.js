
$('#formAddVaga').submit(function(e){
    e.preventDefault()
    let titulV = $('#tituloVaga').val()
    let localV = $('#localVaga').val()
    let detailV = $('#detalheVaga').val()
    let sessionV = $('#sessionVaga').val()

    $.ajax({
        url: 'http://localhost/pi/php/inserirvaga.php',
        method: 'POST',
        data:{
            tituloVaga: titulV,
            localVaga: localV,
            detalheVaga: detailV,
            sessionVaga:sessionV
        },
        dataType: 'json',
    }).done(function(result){
        $('#tituloVaga').val('');
        $('#localVaga').val('');
        $('#detalheVaga').val('');
        $('#formAddVaga > .resultvagaPublicada').text(result)
    })
})