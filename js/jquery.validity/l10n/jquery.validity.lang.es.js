$.extend($.validity.messages, {
    require:"#{field} elemento requerido.",
    // Format validators:
    match:"#{field} esta en un formato no valido.",
    integer:"#{field} debe ser positivo.",
    date:"#{field} debe tener el formato de fecha.",
    email:"#{field} debe tener el formato de correo electronico.",
    usd:"#{field} debe tener el formato de la moneda dolar americano.",
    url:"#{field} debe tener el formato de una direccion web.",
    number:"#{field} debe tener el formato de numero.",
    zip:"#{field} debe tener el formato zip ##### o #####-####.",
    phone:"#{field} debe tener el formato de un numero telefonico ###-###-####.",
    guid:"#{field} debe tener el formato del GUID {3F2504E0-4F89-11D3-9A0C-0305E82C3301}.",
    time24:"#{field} debe tener el formato de hora 24 (eg: 23:00).",
    time12:"#{field} debe tener el formato de hora 12 (eg:12:00 AM/PM)",

    // Value range messages:
    lessThan:"#{field} debe ser menor que #{max}.",
    lessThanOrEqualTo:"#{field} debe ser menor a o igual a#{max}.",
    greaterThan:"#{field} debe ser mayor a #{min}.",
    greaterThanOrEqualTo:"#{field} debe ser mayor o igual a#{min}.",
    range:"#{field} debe ser un valor entre #{min} y #{max}.",

    // Value length messages:
    tooLong:"#{field} no puede ser mayor a  #{max} caracteres.",
    tooShort:"#{field} no puede ser menor a #{min} caracteres.",

    // Composition validators:
    nonHtml:"#{field} no debe contener caracteres especiales (html).",
    alphabet:"#{field} contiene caracteres no permitidos.",

    minCharClass:"#{field} no puede tener mas de #{min} #{charClass} caracteres.",
    maxCharClass:"#{field} no puede tener menos de #{min} #{charClass} caracteres.",
    
    // Aggregate validator messages:
    equal:"Los valores no coinciden.",
    distinct:"Un valor esta repetido.",
    sum:"Los valoresa no suman #{sum}.",
    sumMax:"La suma de los valores debe ser menor a #{max}.",
    sumMin:"La suma de los valores debe ser mayor a #{min}.",

    // Radio validator messages:
    radioChecked:"La valeur s�lectionn�e est invalide.",
    
    generic:"Invalido."
});

$.validity.setup({ defaultFieldName:"Ce champ", });