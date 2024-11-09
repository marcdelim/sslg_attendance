function validateMaxVal(){
    let flag = true;
    inputs = $('#create-form').find('input[number]')
    let maxVal = 999999999999999
    let parts = maxVal.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    let maxValDisplay = parts.join(".")

    inputs.map( (index, el) => { 
        roundedVal = $(el).val().replaceAll(',', '').split('.')
        newVal = roundedVal[0];
        if(roundedVal.length > 1) {
            newVal = +newVal + Math.ceil(+('.' + roundedVal[1]))
        }
        $(el).on('keyup', function(){
            $(el).siblings('.err').remove();
        })
        if(newVal > maxVal){
            if(! $(el).siblings('.err').length){
                $(el).after(`<label class="err" style="color:red; font-size:13px">Please enter a value less than or equal to ${maxValDisplay}</label>`)
            }
            flag = false;
        }
    })
    return flag;
}