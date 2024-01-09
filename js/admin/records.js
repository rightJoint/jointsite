function changeTable(){
    window.location.href  = "/admin/records?table="+$("[name='table-selector'] option:selected").text();
}