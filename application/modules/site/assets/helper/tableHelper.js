function elementTextAlignment(tableName,element,alignment,ClassName){
    $('#'+tableName+' '+element).each(function(){
        $('#'+tableName+' thead th').removeClass(ClassName);
        var idx = $(this).index();
        $('tbody tr').each(function(){ $(this).children('.'+ClassName).css("text-align",alignment);})
   });
}

function tableEditInput(){
    $('body').on('keyup','.tabledit-input',function(event){
        if(event.which >= 37 && event.which <= 40) return;
        if(this.value.charAt(0) == '.'){
            this.value = this.value.replace(/\.(.*?)(\.+)/, function(match, g1, g2){
                return '.' + g1;
            })
        }
        if(this.value.split('.').length > 2){
            this.value = this.value.replace(/([\d,]+)([\.]+.+)/, '$1') 
                + '.' + this.value.replace(/([\d,]+)([\.]+.+)/, '$2').replace(/\./g,'')
            return;
        }
        $(this).val( function(index, value) {
            value = value.replace(/[^0-9.]+/g,'')
            let parts = value.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        });
    });
}