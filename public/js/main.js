document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });

if( document.getElementById('logout')){
	document.getElementById("logout").addEventListener("click", function() {
	    document.getElementById('logout-form').submit();
	}, false);
}



function delClick(val){
	if (window.confirm("削除をしますか？")){
        const del = document.getElementById('delete');
        del.target_dir.value=val;
		del.submit();
	}
}