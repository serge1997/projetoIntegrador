
//botão reponsivo

$(document).ready(function(){
    if($(window).width() <= 790 || $(window).width() <= 900){
        $(document).ready(function(){
            $('.user-picture').click(function(){
                $('.user-setting').toggle('slow')
            })
        })
    }else{
        return false
    }
})

$(document).ready(function(){
    $('.btn-toggle').click(function(){
        $('.user-setting').hide('slow')
    })
})

$(document).ready(function(){
    $('.fa-comment').click(function(){
        $('.saida-comment').toggle(0)
    })
})

$(document).ready(function(){
    $('#showM').click(function(){
        $('#modal').show();
        $('#modal').css('display', 'grid')
    })
})

//Criar modal de edição de perfil do usuario
let modalContent = document.querySelector('.user-setting-button')
let modal = document.createElement('dialog')
modal.setAttribute('id', 'modal')
modal.setAttribute('class', 'user-modal-edit')
//modalContent.appendChild(modal)
document.body.appendChild(modal)

//titulo do modal 
let tituloModal = document.createElement('h3')
tituloModal.textContent = "Editar Seu Perfil"
modal.appendChild(tituloModal)

//formulario de edição
let form = document.createElement('form')
form.setAttribute('enctype', 'multipart/form-data')
form.setAttribute('action', 'user.php')
form.setAttribute('method', 'post')
form.setAttribute('class', 'form-editar')
modal.appendChild(form)

//input entrada para edição
let inpMail = document.createElement('input')
inpMail.setAttribute('type', 'text')
inpMail.setAttribute('name', 'mailEditar')
inpMail.setAttribute('id', 'mailEditar')
inpMail.setAttribute('placeholder', 'Atuliza e-mail...')
form.appendChild(inpMail)

let fac = document.createElement('input')
fac.setAttribute('type', 'text')
fac.setAttribute('name', 'fac')
fac.setAttribute('id', 'fac')
fac.setAttribute('placeholder', 'Nome da Faculdade...')
form.appendChild(fac)

let tituloPerfil = document.createElement('input')
tituloPerfil.setAttribute('type', 'text')
tituloPerfil.setAttribute('name', 'tituloPerfil')
tituloPerfil.setAttribute('id', 'tituloPerfil')
tituloPerfil.setAttribute('placeholder', 'Atualiza titulo do perfil...')
form.appendChild(tituloPerfil)

let cel = document.createElement('input')
cel.setAttribute('type', 'text')
cel.setAttribute('name', 'celula')
cel.setAttribute('id', 'celula')
cel.setAttribute('placeholder', 'Atualiza numero celular...')
form.appendChild(cel)

let pCv = document.createElement('p')
pCv.innerHTML = "Baixar Seu curiculo:";
form.appendChild(pCv);

let cv = document.createElement('input')
cv.setAttribute('type', 'file')
cv.setAttribute('name','cv')
//cv.setAttribute('id','cv')
form.appendChild(cv)


let sobre = document.createElement('textarea')
sobre.setAttribute('name', 'sobreText')
sobre.setAttribute('placeholder', 'Diga algo sobre voce...')
form.appendChild(sobre)

let sub = document.createElement('input')
sub.setAttribute('type', 'submit')
sub.setAttribute('name', 'editar')
sub.setAttribute('value', 'Confirmar')
sub.setAttribute('id', 'submitEdita')
form.appendChild(sub)

let btnClose = document.createElement('button')
btnClose.setAttribute('class', 'bt')
btnClose.textContent = "Cancelar"
form.appendChild(btnClose)

$('.bt').click(function(e){
    e.preventDefault();
    $('#modal').css('display','none');
})


$(document).ready(function(){
    $('.white').click(function(){
        $('.inicio-body').css('background', '#fff')
        $('.user').css('background', '#fff')
        $('.user .user-info, .user-public').css('color', '#333')
        $('.user-about h5,.about-text').css('color', '#333')
        $('.center wrapper .user-setting-button, .bton').css('color', '#333')
        $('.user-resum .nav-link').css('color','#333')
        $('.user-saida-info .user-detalhe').css('border-bottom', '2px solid #d652eb')
    })
})

$(document).ready(function(){
    $('.sombre').click(function(){
        $('.user').css('background', '#1e293b')
        $('.user .user-info, .user-public').css('color', '#fff')
        $('.user-about h5,.about-text').css('color', '#fff')
        $('.center wrapper .user-setting-button, .bton').css('color', '#fff')
        $('.user-resum .nav-link').css('color','#fff')
        $('.user-saida-info .user-detalhe').css('border-bottom', 'none')
    })
})



//Dados formulario Cadastro
$('.d-grid > div').removeClass('spinner-grow');
$('#cadastroForm').submit(function(e){
    e.preventDefault()
    let nome_us = $('#nome').val()
    let sobNome = $('#sobrenome').val()
    let cpf_us = $('#cpf').val()
    let dataNasc = $('#dNasc').val()
    let mail_us = $('#mail').val()
    let pais_us = $('#paises option:selected').attr('value')
    let estado_us = $('#estados option:selected').attr('value')
    let cidade_us = $('#cidades option:selected').attr('value')
    let bairro_us = $('#bairro').val()
    let rua_us = $('#rua').val()
    let numcasa = $('#numerocasa').val()
    let complemente_us = $('#complemente').val()
    let senha_us = $('#senha').val()
    let confSenha = $('#confsenha').val()
        $('.d-grid > div').addClass('spinner-grow')
        setTimeout(function(){
            $('.d-grid > div').addClass('spinner-grow').removeClass('spinner-grow')
         }, 2000);
    $.ajax({
        url: 'http://localhost/pi/php/inserir.php',
        method: 'POST',
        data:{
            nome: nome_us,
            sobrenome: sobNome,
            cpf: cpf_us,
            dNasc: dataNasc,
            mail: mail_us,
            paises: pais_us,
            estados: estado_us,
            cidades: cidade_us,
            bairro: bairro_us,
            rua: rua_us,
            numerocasa: numcasa,
            complemente: complemente_us,
            senha: senha_us,
            confsenha: confSenha
        },
        dataType: 'json',
    }).done(function(inseriDados){
        $('#nome').val('');
        $('#sobrenome').val('');
        $('#cpf').val('');
        $('#dNasc').val('');
        $('#mail').val('');
        $('#bairro').val('');
        $('#rua').val('');
        $('#numerocasa').val('');
        $('#complemente').val('');
        $('#senha').val('');
        $('#confsenha').val('');

        setTimeout(()=>{
            $('#saidaCadastro').text(inseriDados);
            $('#saidaCadastro').css('padding', '5px');
        }, 2000)
        //$('#saidaCadastro').text(inseriDados);
        //$('#saidaCadastro').css('padding', '5px');
    })

});



// Pagina Vaga.php
$('#formAddVaga').hide();
$('#addvaga').click(function(e){
    e.preventDefault()
    $('#formAddVaga').show()
})



//edit user pic form

$('.user-profil-picture > #editImgForm').hide();
$('.btn > .fa-user-pen').click(function(){
    $('.user-profil-picture > #editImgForm').toggle()
})

$('#formComment').submit(function(e){
    e.preventDefault()
    let coment = $('#comment').val()
    let id = $('#idpost').val()
    let idusuario = $('#idus').val()

    $.ajax({
        url: 'http://localhost/pi/php/coment.php',
        method: 'POST',
        data:{
            comment: coment,
            idpost: id,
            idus:idusuario
        },
        dataType: 'json',
    }).done(function(comment){
        $('#comment').val('');
        console.log(comment)
    })
})







