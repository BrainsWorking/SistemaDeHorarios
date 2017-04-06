'use strict'
$(document).ready(function(){

	var wrapper = $(".horarios-turno");
	var button = $(".add-field");
	var x = $('.index').length + 1;

	$(button).click(function(e){
		e.preventDefault();
		$(wrapper).append(`
            <div class="row">
                <div class="col-lg-1 padding-left-0">
                    <label class="index">Aula ` + x + `</label>
                </div>
                <div class="col-lg-5">
                    <div class="form-group col-lg-6">
                        <input type="text" name="horario[` + x + `][inicio]" class="form-control" placeholder="Início" maxlength="5" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" name="horario[` + x + `][fim]" class="form-control" placeholder="Fim" maxlength="5" required>
                    </div>
                </div>
                <div class="col-lg-1 padding-right-0 remove-field">
                    <button type="button" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>
            </div>
        `);
		x++;
	});

	$(wrapper).on("click", ".remove-field", function(e){
		e.preventDefault();
		$(this).parent().remove();

		var labels = $('.index');
		for (var i = 0; i <= x; i++) {
			$(labels[i]).html("Aula " + (i + 1));
		};
		x--;
	});

	$(wrapper).on("change paste keyup keypress keydown", ".form-control", function(){
		var v = $(this).val();
		v = v.replace(/\D/g,"");
		v = v.replace(/(\d{2})(\d)/,"$1:$2");
		$(this).val(v);

	});

});
