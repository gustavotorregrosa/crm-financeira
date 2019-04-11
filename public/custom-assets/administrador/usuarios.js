tbody = $("tbody");

$(document).ready(function () {
    init();
   

});


function init(){
    tabelaPrincipal = listar();
    
    
}



tbody.on("click", "button.btn-reativar", function(){
    let dados = tabelaPrincipal.row($(this).parents("tr")).data();
    $("#spn-usr-reat").html(dados.name);
    $('#mdl-reativa-usuario').data("id-reat", dados.id);
    $('#mdl-reativa-usuario').modal("show");

});


tbody.on("click", "button.btn-inativar", function(){
    let dados = tabelaPrincipal.row($(this).parents("tr")).data();
    $("#spn-usr-inat").html(dados.name);
    $('#mdl-inativa-usuario').data("id-inat", dados.id);
    $('#mdl-inativa-usuario').modal("show");

});


tbody.on("click", "button.btn-deletar", function(){


    let dados = tabelaPrincipal.row($(this).parents("tr")).data();
    $("#spn-usr-del").html(dados.name);
    $('#mdl-deleta-usuario').data("id-del", dados.id);
    $('#mdl-deleta-usuario').modal("show");

});








 function listar(){
 
    var tabela = $("#dt_usuarios").DataTable({
        // "responsive": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "/administrador/usuariosjson"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {"data": "perfil_usuario.nome"},
            // {"data": "supervisor.name"}
            {"data": function(usuario){
              if(usuario.supervisor){
                return usuario.supervisor.name;
              }
              else{
                  return "";
              }
            }},
            {"data": function(usuario, type, row, meta){
                let ativo = usuario.active;
                if(ativo){
                    // return "ativo";
                    return "<button type='button' class='btn-editar btn btn-primary btn-sm'>Editar</button>&nbsp;&nbsp;<button type='button' class='btn-deletar btn btn-danger btn-sm'>Deletar</button>&nbsp;&nbsp;<button type='button' class='btn-inativar btn btn-outline-danger btn-sm'>Inativar</button>";
                }else{
                    // return "nao ativo";
                    return "<button type='button' class='btn-editar btn btn-primary btn-sm'>Editar</button>&nbsp;&nbsp;<button type='button' class='btn-deletar btn btn-danger btn-sm'>Deletar</button>&nbsp;&nbsp;<button type='button' class='btn-reativar btn btn-outline-primary btn-sm'>Reativar</button>";
                }
            }}
            // {"defaultContent": "<button type='button' class='btn-editar btn btn-primary btn-sm'>Editar</button>&nbsp;&nbsp;<button type='button' class='btn-deletar btn btn-danger btn-sm'>Deletar</button>"}
            
        ],
        "createdRow": function( row, usuario, dataIndex ) {
            if ( !usuario.active) {
              $(row).addClass('text-danger');
            }
          }

    });

    return tabela;
    
  
    // pega_dados_edicao(tbody, tabela);
    // pega_dados_delecao(tbody, tabela);
    // pega_dados_inativar(tbody, tabela);



}


// var pega_dados_delecao = function(tbody, tabela){
//     $(tbody).on("click", "button.btn-deletar", function(){
//         // var dados = tabela.row($(this).parents("tr")).data();
//         // $("#spn-usr-del").html(dados.name);
//         // $('#mdl-deleta-usuario').data("id-del", dados.id);
//         // $('#mdl-deleta-usuario').modal("show");
        
//     });
// }


// var pega_dados_edicao = function(tbody, tabela){
//     $(tbody).on("click", "button.btn-editar", function(){
//         // var dados = tabela.row($(this).parents("tr")).data();
        
//     });
// }


// var pega_dados_inativar = function(tbody, tabela){
//     $(tbody).on("click", "button.btn-inativar", function(){
//         console.log($(this));
        
//         let dados = tabela.row($(this).parents("tr")).data();
//         console.log(dados);
//         $("#spn-usr-inat").html(dados.name);
//         $('#mdl-inativa-usuario').data("id-inat", dados.id);
//         $('#mdl-inativa-usuario').modal("show");
        
//     });
// }


$("#btn-del-usr").on("click", function(){
    let id = $('#mdl-deleta-usuario').data("id-del");
    
    $.ajax({
        type: "POST",
        url: '/deleta-usuario',
        data: {
            id: id
        },
        async: false,
        success: function(data){
            $.notify("Usuário deletado", "success");
        },
        error: function(data){
            $.notify("Não foi possível deletar o usuário", "error");
        }
     
      });

      
    $('#mdl-deleta-usuario').modal("hide");
    init();
});


$("#btn-reat-usr").on("click", function(){
    let id = $('#mdl-reativa-usuario').data("id-reat");
    
    $.ajax({
        type: "POST",
        url: '/reativa-usuario',
        data: {
            id: id
        },
        async: false,
        success: function(data){
            $.notify("Usuário reativado", "success");
        },
        error: function(data){
            $.notify("Não foi possível reativar o usuário", "error");
        }
     
      });

      
    $('#mdl-reativa-usuario').modal("hide");
    init();
});


$("#btn-inat-usr").on("click", function(){
    let id = $('#mdl-inativa-usuario').data("id-inat");
    
    $.ajax({
        type: "POST",
        url: '/inativa-usuario',
        data: {
            id: id
        },
        async: false,
        success: function(data){
            $.notify("Usuário inativado", "success");
        },
        error: function(data){
            $.notify("Não foi possível inativar o usuário", "error");
        }
     
      });
    $('#mdl-inativa-usuario').modal("hide");
    init();
});



$("#btn-am-add-user").on("click", function(){
    $("#mdl-cria-usuario").modal("show");
});


function verificaPerfil(perfil){
    let perfis = $("#precisa-sup").val().split(",");
    let isNecessitaSup = perfis.includes(perfil);
    if(isNecessitaSup){
        $("#grp-supervisor").show("slow");
    }else{
        $("#grp-supervisor").hide("slow");
    }


}


function populaSupervisores(){
    $.ajax({
        type: "POST",
        url: '/pega-supervisores',
        data: {
            
        },
        async: false,
        success: function(data){
            // console.log(data);
            let supervisores = JSON.parse(data);
            
            $("#user-supervisor option").remove();
            let padrao = new Option('Escolha um supervisor', '');
            $(padrao).prop('defaultSelected', true);
            $(padrao).prop('disabled', true);
            $("#user-supervisor").append($(padrao));

            $.each(supervisores, function(index, sup){
                $("#user-supervisor").append($(new Option(sup.name, sup.id)));
            });


            // let option1 = new Option('ola mundo 2', 123);           
            // $("#user-supervisor").append($(option1));

            // let option2 = new Option('ola mundo 3', 123);           
            // $("#user-supervisor").append($(option2));



        }
     
      });
}