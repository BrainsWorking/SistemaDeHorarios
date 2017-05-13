$(document).ready(function(){
    var i = 2;

    $('.modulos').on("click", ".add-field", function(){
        var index = $(this).closest('.disciplinas').attr('id');
        $(this).closest('.disciplinas').append(`
         <div class="disciplina">
            <div class="control-group form-group col-sm-5">
                <input name="disciplinas[nome][]" type="text" class="form-control" required>
            </div>
            <div class="control-group form-group col-sm-2">                     
                <input name="disciplinas[sigla][]" type="text" class="form-control" required maxlength="5">
            </div>
            <div class="control-group form-group col-sm-2">                     
                <select class="form-control" name="disciplinas[tipo_sala][]">
                    <option>Sala Comum</option>
                    <option>Laboratório de Informática</option>
                </select>
            </div>              
            <div class="control-group form-group col-sm-2">
                <input name="disciplinas[aulas_semanais][]" type="text" class="form-control" required>
            </div>
            <div class="col-sm-1 remove-field">
                <button type="button" class="btn btn-danger btn-sm right">
                <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div> 
         </div>`);
    });

    $('.modulos').on("click", ".remove-field", function(){
        $(this).parent().remove();
    });

    $(".modulos").on('click', '#add-semestre', function(){
        $('.active').removeClass('in active');
        $("#last").before(`
         <li class="active"><a data-toggle='pill' href='#semestre`+ i +`'>` + i + `° Semestre</a></li>
         `);

        $('.tab-content').append(`
            <div id="semestre`+ i +`" class="disciplinas tab-pane fade in active">
                <div class="control-group" style="margin-left: 15px;">
                    <button type="button" class="btn btn-success add-field">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar outras disciplinas
                    </button>
                </div>
                <div class="disciplina">
                    <div class="control-group form-group col-sm-5">
                        <label for='nome' class='control-label'>Nome</label>
                        <input name="disciplinas[nome][]" type="text" class="form-control" required>
                    </div>
                    <div class="control-group form-group col-sm-2">
                        <label for='sigla' class='control-label'>Sigla</label>
                        <input name="disciplinas[sigla][]" type="text" class="form-control" required maxlength="5">
                    </div>
                    <div class="control-group form-group col-sm-2">
                        <label for='tipoSala' class='control-label'>Tipo Sala</label>
                        <select class="form-control" name="disciplinas[tipo_sala][]">
                            <option>Sala Comum</option>
                            <option>Laboratório de Informática</option>
                        </select>
                    </div>              
                    <div class="control-group form-group col-sm-2">
                        <label for='aulasSemanais' class='control-label'>Aulas/Semana</label>
                        <input name="disciplinas[aulas_semanais][]" type="text" class="form-control" required>
                    </div>
                </div>
            </div>
        `);
        
        i++;
    });
    
    $('.modulos').on("click", "#remove-semestre", function(){
        var referencia = $('#last').prev('li').children().attr('href');
        $('#last').prev('li').remove();
        $(referencia).remove();

        referencia = '#semestre' + (i-2);

        if ($('#last').prev('li').length >= 1) {
            $('.active').removeClass('in active');
            $('#last').prev('li').addClass('active');
            $(referencia).addClass('active in');
        }else{
            $('.active').removeClass('in active');
            $('#last').addClass('active');
            $('#dp').addClass('active in'); 
        }
        if (i > 1) {
            i--;
        };  
    });

});