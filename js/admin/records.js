function changeTable(){
    window.location.href  = admin_process_url+"/records/"+$("[name='table-selector'] option:selected").text();
}