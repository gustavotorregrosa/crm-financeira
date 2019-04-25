var estadosPossiveis;
var cidadesPorEstado;
tbody = $("tbody");
function init(){    
    tabelaPrincipal = listar();
    // populaSupervisores();
    
}



$("#btn-edita-cliente").on("click", function (e) {
    e.preventDefault();
    let elemContatos = $("#quadro-edita-contatos .contato");
    let contatos = [];
    $.each(elemContatos, function (index, elemContato) {
        let contato = {
            tipo: elemContato.firstChild.value,
            id: $(elemContato).find('.id-contato').val(),
            numero: $(elemContato).find(".telefone").val()
        };
        contatos.push(contato);
    });





    let dadosCliente = {
        id: $("#frm-edita-cliente #id-edita-cliente").val(),
        nome: $("#frm-edita-cliente #nome-edita-cliente").val(),
        cpf: $("#frm-edita-cliente #cpf-edita-cliente").val(),
        empresa: $("#frm-edita-cliente #empresa-edita-cliente").val(),
        orgao: $("#frm-edita-cliente #orgao-edita-cliente").val(),
        beneficio: $("#frm-edita-cliente #beneficio-edita-cliente").val(),
        salario: $("#frm-edita-cliente #salario-edita-cliente").val().split('.').join('').replace(',', '.'),
        uf: $("#frm-edita-cliente #uf-edita-cliente").val(),
        cidade: $("#frm-edita-cliente #cidade-edita-cliente").val(),
        contatos: contatos

    }


    $.ajax({
        type: "POST",
        url: '/altera-cliente',
        data: dadosCliente,
        async: false,
        success: function (data) {
            $.notify("Cliente editado", "success");
            $('#mdl-edita-cliente').modal("hide");
            $("#frm-edita-cliente")[0].reset();
            init();
        },
        error: function (data) {
            $.notify("Não foi possível criar o cliente", "error");
            $('#mdl-edita-cliente').modal("hide");
            $("#frm-edita-cliente")[0].reset();
            init();
        }

    });




});

$(document).on("click", "button.deleta-item-contato", function(e){
    e.preventDefault();
    let contatoDiv = $(this).parent().remove();
    // console.log(contatoDiv);
    // alert("del contato");

});



tbody.on("click", "button.btn-editar", function(){
    let cliente = tabelaPrincipal.row($(this).parents("tr")).data();
    console.log(cliente);
    $("#id-edita-cliente").val(cliente.id);
    $("#nome-edita-cliente").val(cliente.nome);
    $("#cpf-edita-cliente").val(cliente.cpf);
    $("#empresa-edita-cliente").val(cliente.empresa.id);
    $("#orgao-edita-cliente").val(cliente.orgao);
    $("#beneficio-edita-cliente").val(cliente.beneficio);
    $("#salario-edita-cliente").val(cliente.salario);
    $("#uf-edita-cliente").val(cliente.uf);

    estadoEscolhido = cliente.uf;
    // let cidadePossiveis = [];
    $("#cidade-edita-cliente option").remove();
    let cidPadraoEdita = new Option('Escolha uma cidade', '');
    $(cidPadraoEdita).prop('defaultSelected', true);
    $(cidPadraoEdita).prop('disabled', true);
    $("#cidade-edita-cliente").append($(cidPadraoEdita));

    $.each(cidadesPorEstado, function (index, municipio) {
        if (estadoEscolhido == municipio.estado) {
            $("#cidade-edita-cliente").append($(new Option(municipio.cidade, municipio.cidade)));
        }


    });

     $("#cidade-edita-cliente").val(cliente.cidade);
     $("#quadro-edita-contatos div").remove();
     $.each(cliente.contatos, function(index, contato){
        let contatoTemp = "<div id='contato-"+contato.id+"' class='contato form-inline'><select class='form-control'><option value='' selected disabled>Tipo contato</option><option value='celular'>Celular</option><option value='residencial'>Residencial</option><option value='comercial'>Comercial</option></select><input class='id-contato' type='hidden' value='" + contato.id + "'><input type='text' class='form-control telefone'>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger deleta-item-contato btn-sm'>Remover</button></div>";
        
        $("#quadro-edita-contatos").append(contatoTemp);
        $("#quadro-edita-contatos #contato-"+contato.id+" select").val(contato.tipo).change();
        $("#quadro-edita-contatos #contato-"+contato.id+" .telefone").val(contato.telefone).change();

     });

    
 
    $("#mdl-edita-cliente").modal("show");  

});


$(document).ready(function () {
    $('.cpf').mask('000.000.000-00', { reverse: true });
    $('.dinheiro').mask("#.##0,00", { reverse: true });
    $.ajax({
        type: "POST",
        url: '/pega-cidades',
        data: {},
        async: false,
        success: function (data) {
            data = JSON.parse(data);
            estadosPossiveis = data.estados;
            // console.log(estadosPossiveis);
            cidadesPorEstado = data.cidades;
            // console.log(cidadesPorEstado);

        },

    });

    $("#uf-cliente option").remove();
    let padrao = new Option('Escolha um Estado', '');
    $(padrao).prop('defaultSelected', true);
    $(padrao).prop('disabled', true);
    $("#uf-cliente").append($(padrao));

    $.each(estadosPossiveis, function (index, estado) {
        $("#uf-cliente").append($(new Option(estado, estado)));
    });
    

    $("#uf-edita-cliente option").remove();
    let padraoEdit = new Option('Escolha um Estado', '');
    $(padraoEdit).prop('defaultSelected', true);
    $(padraoEdit).prop('disabled', true);
    $("#uf-edita-cliente").append($(padraoEdit));

    $.each(estadosPossiveis, function (index, estado) {
        $("#uf-edita-cliente").append($(new Option(estado, estado)));
    });

    init();


});


function listar() {

    var tabela = $("#dt_clientes").DataTable({
        // "responsive": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "/administrador/clientesjson"
        },
        "columns": [
            { "data": "nome" },
            {
                "data": function (cliente) {
                    return cliente.empresa.nomeinterno;
                }
            },
            { "data": "uf" },
            { "data": "cidade" },

            {
                "data": function (cliente, type, row, meta) {
                    return "<button type='button' class='btn-editar btn btn-primary btn-sm'>Editar</button>&nbsp;&nbsp;<button type='button' class='btn-deletar btn btn-danger btn-sm'>Deletar</button>";
                }
            }
         
        ],
        

    });

    return tabela;





}


$("#uf-cliente").on("change", function () {
    estadoEscolhido = $("#uf-cliente").val();
    let cidadePossiveis = [];
    $("#cidade-cliente option").remove();
    let cidPadrao = new Option('Escolha uma cidade', '');
    $(cidPadrao).prop('defaultSelected', true);
    $(cidPadrao).prop('disabled', true);
    $("#cidade-cliente").append($(cidPadrao));

    $.each(cidadesPorEstado, function (index, municipio) {
        if (estadoEscolhido == municipio.estado) {
            $("#cidade-cliente").append($(new Option(municipio.cidade, municipio.cidade)));
        }


    });

});



$("#uf-edita-cliente").on("change", function () {
    estadoEscolhido = $("#uf-edita-cliente").val();
    // let cidadePossiveis = [];
    $("#cidade-edita-cliente option").remove();
    let cidPadraoEdita = new Option('Escolha uma cidade', '');
    $(cidPadraoEdita).prop('defaultSelected', true);
    $(cidPadraoEdita).prop('disabled', true);
    $("#cidade-edita-cliente").append($(cidPadraoEdita));

    $.each(cidadesPorEstado, function (index, municipio) {
        if (estadoEscolhido == municipio.estado) {
            $("#cidade-edita-cliente").append($(new Option(municipio.cidade, municipio.cidade)));
        }


    });

});

$("#btn-am-add-cliente").on("click", function () {
    $("#mdl-add-cliente").modal("show");
});


$("#add-edita-contato").on("click", function (e) {
    e.preventDefault();
    let contatoTemp = "<div class='contato form-inline'><select class='form-control'><option value='' selected disabled>Tipo contato</option><option value='celular'>Celular</option><option value='residencial'>Residencial</option><option value='comercial'>Comercial</option></select><input class='id-contato' type='hidden' value='0'><input type='text' class='form-control telefone'>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger deleta-item-contato btn-sm'>Remover</button></div>";
        
    $("#quadro-edita-contatos").append(contatoTemp);
   });


$("#add-contato").on("click", function (e) {
    e.preventDefault();
    $("#quadro-contatos").append("<div class='contato form-inline'><select class='form-control'><option value='' selected disabled>Tipo contato</option><option value='celular'>Celular</option><option value='residencial'>Residencial</option><option value='comercial'>Comercial</option></select><input type='text' class='form-control telefone'>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger deleta-item-contato btn-sm'>Remover</button></div>");
});


$("#btn-add-cliente").on("click", function (e) {
    e.preventDefault();
    let elemContatos = $("#quadro-contatos .contato");
    let contatos = [];
    $.each(elemContatos, function (index, elemContato) {
        let contato = {
            tipo: elemContato.firstChild.value,
            numero: $(elemContato).find(".telefone").val()

        };
        contatos.push(contato);
    });





    let dadosCliente = {
        nome: $("#frm-add-cliente #nome-cliente").val(),
        cpf: $("#frm-add-cliente #cpf-cliente").val(),
        empresa: $("#frm-add-cliente #empresa-cliente").val(),
        orgao: $("#frm-add-cliente #orgao-cliente").val(),
        beneficio: $("#frm-add-cliente #beneficio-cliente").val(),
        salario: $("#frm-add-cliente #salario-cliente").val().split('.').join('').replace(',', '.'),
        uf: $("#frm-add-cliente #uf-cliente").val(),
        cidade: $("#frm-add-cliente #cidade-cliente").val(),
        contatos: contatos

    }


    $.ajax({
        type: "POST",
        url: '/cria-cliente',
        data: dadosCliente,
        async: false,
        success: function (data) {
            $.notify("Cliente criado", "success");
            $('#mdl-add-cliente').modal("hide");
            $("#frm-add-cliente")[0].reset();
            init();
        },
        error: function (data) {
            $.notify("Não foi possível criar o cliente", "error");
            $('#mdl-add-cliente').modal("hide");
            $("#frm-add-cliente")[0].reset();
            init();
        }

    });




});
