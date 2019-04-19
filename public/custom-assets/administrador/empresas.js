tbody = $("tbody");

$(document).ready(function () {
    init();
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
   

});


function init(){    
    tabelaPrincipal = listar();
    // populaSupervisores();
    
    
}



tbody.on("click", "button.btn-reativar", function(){
    let dados = tabelaPrincipal.row($(this).parents("tr")).data();
    $("#spn-empr-reat").html(dados.nomeinterno);
    $('#mdl-reativa-empresa').data("id-reat", dados.id);
    $('#mdl-reativa-empresa').modal("show");

});


tbody.on("click", "button.btn-inativar", function(){
    let dados = tabelaPrincipal.row($(this).parents("tr")).data();
    $("#spn-empr-inat").html(dados.nomeinterno);
    $('#mdl-inativa-empresa').data("id-inat", dados.id);
    $('#mdl-inativa-empresa').modal("show");

});


// tbody.on("click", "button.btn-deletar", function(){


//     let dados = tabelaPrincipal.row($(this).parents("tr")).data();
//     $("#spn-usr-del").html(dados.name);
//     $('#mdl-deleta-usuario').data("id-del", dados.id);
//     $('#mdl-deleta-usuario').modal("show");

// });








 function listar(){
 
    var tabela = $("#dt_empresas").DataTable({
        // "responsive": true,
        "destroy": true,
        "ajax": {
            "method": "POST",
            "url": "/administrador/empresasjson"
        },
        "columns": [
            {"data": "nomeinterno"},
            {"data": "nomefantasia"},
            {"data": "cidade"},
            // {"data": "supervisor.name"}
            // {"data": function(usuario){
            //   if(usuario.supervisor){
            //     return usuario.supervisor.name;
            //   }
            //   else{
            //       return "";
            //   }
            // }},
            {"data": function(empresa, type, row, meta){
                let ativa = empresa.ativa;
                if(ativa){
                    // return "ativo";
                    return "<button type='button' class='btn-editar btn btn-primary btn-sm'>Editar</button>&nbsp;&nbsp;<button type='button' class='btn-deletar btn btn-danger btn-sm'>Deletar</button>&nbsp;&nbsp;<button type='button' class='btn-inativar btn btn-outline-danger btn-sm'>Inativar</button>";
                }else{
                    // return "nao ativo";
                    return "<button type='button' class='btn-editar btn btn-primary btn-sm'>Editar</button>&nbsp;&nbsp;<button type='button' class='btn-deletar btn btn-danger btn-sm'>Deletar</button>&nbsp;&nbsp;<button type='button' class='btn-reativar btn btn-outline-primary btn-sm'>Reativar</button>";
                }
            }}
            // {"defaultContent": "<button type='button' class='btn-editar btn btn-primary btn-sm'>Editar</button>&nbsp;&nbsp;<button type='button' class='btn-deletar btn btn-danger btn-sm'>Deletar</button>"}
            
        ],
        "createdRow": function( row, empresa, dataIndex ) {
            if ( !empresa.ativa) {
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


// $("#btn-del-usr").on("click", function(){
//     let id = $('#mdl-deleta-usuario').data("id-del");
    
//     $.ajax({
//         type: "POST",
//         url: '/deleta-usuario',
//         data: {
//             id: id
//         },
//         async: false,
//         success: function(data){
//             $.notify("Usuário deletado", "success");
//         },
//         error: function(data){
//             $.notify("Não foi possível deletar o usuário", "error");
//         }
     
//       });

      
//     $('#mdl-deleta-usuario').modal("hide");
//     init();
// });


$("#btn-reat-empresa").on("click", function(){
    let id = $('#mdl-reativa-empresa').data("id-reat");
    
    $.ajax({
        type: "POST",
        url: '/reativa-empresa',
        data: {
            id: id
        },
        async: false,
        success: function(data){
            $.notify("Empresa reativada", "success");
        },
        error: function(data){
            $.notify("Não foi possível reativar a empresa", "error");
        }
     
      });

      
    $('#mdl-reativa-empresa').modal("hide");
    init();
});


$("#btn-inat-empr").on("click", function(){
    let id = $('#mdl-inativa-empresa').data("id-inat");
    
    $.ajax({
        type: "POST",
        url: '/inativa-empresa',
        data: {
            id: id
        },
        async: false,
        success: function(data){
            $.notify("Empresa inativada", "success");
        },
        error: function(data){
            $.notify("Não foi possível inativar a empresa", "error");
        }
     
      });
    $('#mdl-inativa-empresa').modal("hide");
    init();
});



$("#btn-am-add-empresa").on("click", function(){
    $("#mdl-cria-empresa").modal("show");
});


// function verificaPerfil(perfil){
//     let perfis = $("#precisa-sup").val().split(",");
//     let isNecessitaSup = perfis.includes(perfil);
//     if(isNecessitaSup){
//         $("#grp-supervisor").show("slow");
//     }else{
//         $("#grp-supervisor").hide("slow");
//     }


// }



// function verificaPerfilEdit(perfil){
//     let perfis = $("#precisa-sup-edit").val().split(",");
//     let isNecessitaSup = perfis.includes(perfil);
//     if(isNecessitaSup){
//         $("#grp-supervisor-edit").show("slow");
//     }else{
//         $("#grp-supervisor-edit").hide("slow");
//     }


// }


// function populaSupervisores(){
//     $.ajax({
//         type: "POST",
//         url: '/pega-supervisores',
//         data: {
            
//         },
//         async: false,
//         success: function(data){
//             // console.log(data);
//             let supervisores = JSON.parse(data);
            
//             $("#user-supervisor option").remove();
//             let padrao = new Option('Escolha um supervisor', '');
//             $(padrao).prop('defaultSelected', true);
//             $(padrao).prop('disabled', true);
//             $("#user-supervisor").append($(padrao));

//             $.each(supervisores, function(index, sup){
//                 $("#user-supervisor").append($(new Option(sup.name, sup.id)));
//             });

//             $("#user-supervisor-edit option").remove();
//             let padrao2 = new Option('Sem supervisor', '');
//             $(padrao2).prop('disabled', false);
//             $("#user-supervisor-edit").append($(padrao2));
//             $.each(supervisores, function(index, sup){
//                 $("#user-supervisor-edit").append($(new Option(sup.name, sup.id)));
//             });

          


//         }
     
//       });
// }

$("#btn-criar-empr").on("click", function(e){
    e.preventDefault(); 
    let dadosNovaEmpresa = {
        nomeinterno: $("#frm-criar-empresa #empresa-nomeinterno").val(),
        nomefantasia: $("#frm-criar-empresa #empresa-nomefantasia").val(),
        razaosocial: $("#frm-criar-empresa #empresa-razaosocial").val(),
        cnpj: $("#frm-criar-empresa #empresa-cnpj").val(),
        cidade: $("#frm-criar-empresa #empresa-cidade").val(),
        ativa: function(){
            if( $("#frm-criar-empresa #empresa-ativa")[0].checked){
                return 1;
            }
            return 0;
        } 
        
        
       

    } 

    $.ajax({
        type: "POST",
        url: '/cria-empresa',
        data: dadosNovaEmpresa,
        async: false,
        success: function(data){
            $.notify("Empresa criada", "success");
            $('#mdl-cria-empresa').modal("hide");
            $("#frm-criar-empresa")[0].reset();
            init();
        },
        error: function(data){
            $.notify("Não foi possível criar a empresa", "error");
            $('#mdl-cria-empresa').modal("hide");
            $("#frm-criar-empresa")[0].reset();
            init();
        }
     
      });




});






tbody.on("click", "button.btn-editar", function(){
    let empresa = tabelaPrincipal.row($(this).parents("tr")).data();
    $("#frm-edita-empresa #empresa-id-edit").val(empresa.id);
    $("#frm-edita-empresa #empresa-nomeinterno-edit").val(empresa.nomeinterno);
    $("#frm-edita-empresa #empresa-nomefantasia-edit").val(empresa.nomefantasia);
    $("#frm-edita-empresa #empresa-razaosocial-edit").val(empresa.razaosocial);
    $("#frm-edita-empresa #empresa-cnpj-edit").val(empresa.cnpj);
    $("#frm-edita-empresa #empresa-cidade-edit").val(empresa.cidade);
    $("#frm-edita-empresa #empresa-ativa-edit").attr('checked', false);
    if(empresa.ativa){
        $("#frm-edita-empresa #empresa-ativa-edit").attr('checked', true);
    }

    $("#mdl-edita-empresa").modal("show");

});



$("#btn-edit-empr").on("click", function(e){
    e.preventDefault(); 
    let dadosEmpresa = {
        id: $("#frm-edita-empresa #empresa-id-edit").val(),
        nomeinterno: $("#frm-edita-empresa #empresa-nomeinterno-edit").val(),
        nomefantasia:  $("#frm-edita-empresa #empresa-nomefantasia-edit").val(),
        razaosocial:  $("#frm-edita-empresa #empresa-razaosocial-edit").val(),
        cnpj:  $("#frm-edita-empresa #empresa-cnpj-edit").val(),
        cidade:  $("#frm-edita-empresa #empresa-cidade-edit").val(),
        ativa: function(){
            if($("#frm-edita-empresa #empresa-ativa-edit")[0].checked){
                return 1;
            }
            return 0;
        } 
        
        

    } 

    $.ajax({
        type: "POST",
        url: '/edita-empresa',
        data: dadosEmpresa,
        async: false,
        success: function(data){
            $.notify("Empresa editada", "success");
            $('#mdl-edita-empresa').modal("hide");
            $("#frm-edita-empresa")[0].reset();
            init();
        },
        error: function(data){
            $.notify("Não foi possível editar a empresa", "error");
            $('#mdl-edita-empresa').modal("hide");
            $("#frm-edita-empresa")[0].reset();
            init();
        }
     
      });




});