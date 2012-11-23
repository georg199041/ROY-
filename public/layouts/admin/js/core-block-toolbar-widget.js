jQuery(document).ready(function(){
	
	/**
	 * BUTTONS DECORATE
	 */
	$("button").addClass("btn");
	$("button[name=add]").addClass("btn-success");
	$("button[name=save]").addClass("btn-success");
	$("button[name=back]").addClass("btn-info");
	$("button[name=delete]").addClass("btn-danger");
	$("button[name=show]").addClass("btn-info");
	$("button[name=hide]").addClass("btn-warning");
	
	/**
	 * 
	 */
	$("button[name=show], button[name=hide], button[name=delete]").click(function(event){
		callAction($(this), '.cbgw-column__ids input:checked');
	});
	
	/**
	 * 
	 */
	$("button[name=add]").click(function(event){
		callAction($(this));
	});
	
	/**
	 * MODAL DIALOG
	 */
	$("button[name=move], button[name=copy]").click(function(event){
		event.preventDefault();
		var checked = " ";
		$(".cbgw-column__ids input:checked").each(function(){
			checked+= " "+ $(this).attr("name");
		});
		$('<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="myModalLabel">' + $(this).html() + '</h3></div><div class="modal-body"><p>' + checked + '</p></div><div class="modal-footer"><button class="btn btn-success">Сохранить</button><button class="btn" data-dismiss="modal" aria-hidden="true">Назад</button></div></div>').modal();
		
	});
	
	
	
});