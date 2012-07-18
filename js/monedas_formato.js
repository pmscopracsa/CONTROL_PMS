function formatNumber(num,prefix)
{
    num = Math.round(parseFloat(num)*Math.pow(10,2))/Math.pow(10,2)
    prefix = prefix || '';
    num += '';
    var splitStr = num.split('.');
    var splitLeft = splitStr[0];
    var splitRight = splitStr.length > 1 ? '.' + splitStr[1] : '.00';
    splitRight = splitRight + '00';
    splitRight = splitRight.substr(0,3);
    var regx = /(\d+)(\d{3})/;
    
    while (regx.test(splitLeft)) {
        splitLeft = splitLeft.replace(regx, '$1' + ',' + '$2');
    }
return prefix + splitLeft + splitRight;
}